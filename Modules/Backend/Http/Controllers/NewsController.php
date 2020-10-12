<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\Guest;
use Modules\Backend\Entities\News;
use Modules\Backend\Entities\Reporter;
use Modules\Backend\Http\Requests\NewsRequest;
use Modules\Backend\Http\Responses\Response;
use Modules\Backend\Repositories\ContactRepository;
use Modules\Backend\Repositories\NewsRepository;
use Modules\Frontend\Repositories\CategoryRepository;

class NewsController extends Controller
{

    protected $baseRoute = 'news';
    protected $viewPath = 'backend::news.';
    /**
     * @var News
     */
    private $model;
    /**
     * @var NewsRepository
     */
    private $repository;

    public function __construct(News $news)
    {

        $this->model = $news;
        $this->middleware('auth');
        $this->middleware(['permission:news-view|news-create|news-edit|news-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:news-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:news-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:news-delete'], ['only' => ['destroy']]);
        $this->repository = new NewsRepository($news);
    }


    public function index()
    {
        $is_special = \request()->get('is_special');
        $is_anchor = \request()->get('is_anchor');
        $category_id = \request()->get('category');
        $reporter_id = \request()->get('reporter');
        $guest_id = \request()->get('guests');
        $selectGuests = (new ContactRepository(new Guest()))->getAll()->pluck('name', 'id')->toArray();
        $selectReporters = (new ContactRepository(new Reporter()))->getAll()->pluck('name', 'id')->toArray();
        $q = \request()->get('q');
        $selectCategories = (new CategoryRepository(new Category()))->getAll()
            ->where('is_active', true)
            ->pluck('name', 'id');
        $news = News::with(['categories', 'reporter', 'guest', 'createdBy', 'updatedBy', 'tags'])
            ->orderByDesc('news.publish_date')
            ->when($is_special, function ($a) use ($is_special) {
                $a->where('is_special', $is_special);
            })
            ->when($reporter_id, function ($a) use ($reporter_id) {
                $a->where('reporter_id', $reporter_id);
            })
            ->when($guest_id, function ($a) use ($guest_id) {
                $a->where('guest_id', $guest_id);
            })
            ->when($is_anchor, function ($a) use ($is_anchor) {
                $a->where('is_anchor', $is_anchor);
            })->when($category_id, function ($a) use ($category_id) {
                $a->whereHas('categories', function ($b) use ($category_id) {
                    $b->where('categories.id', $category_id);
                });
            })->when($q, function ($a) use ($q) {
                $a->where('title', 'like', '%' . $q . '%')
                    ->orWhere('sub_title', 'like', '%' . $q . '%')
                    ->orWhere('short_description', 'like', '%' . $q . '%');
            })
            ->paginate(20);
        return new Response($this->viewPath . 'index',
            ['allNews' => $news,
                'selectGuests' => $selectGuests,
                'selectReporters' => $selectReporters,
                'selectCategories' => $selectCategories]);
    }

    public function create()
    {
        $viewPath = $this->viewPath . 'create';
        $viewData = $this->repository->getViewData();
        return new Response($viewPath, $viewData);
    }

    public function edit(News $news)
    {
        $viewPath = $this->viewPath . 'edit';
        $viewData = $this->repository->getViewData();
        $newsTags = $news->tagList ?? [];
        if ($newsTags) {
            $newsTags = explode(',', $newsTags);
        }
        $attributes = [
            'news' => $news,
            'news_tags' => is_array($newsTags) ? $newsTags : []
        ];
        $attributes = array_merge($attributes, $viewData);
        return new Response($viewPath, $attributes);
    }

    public function update(NewsRequest $request, $id)
    {
        $attributes = $request->validated();
        $baseRoute = getBaseRouteByUrl($request);
        try {
            DB::beginTransaction();
            if (is_null($attributes['slug'])) {
                $attributes['slug'] = $request->get('title');
            }
            $attributes['slug'] = Str::slug($attributes['slug']);
            $baseUrl = 'https://breaknlinks.s3.amazonaws.com/';
            if (!Str::contains($attributes['image'], $baseUrl)) {
                if (!Str::contains($attributes['image'], 'http')
                    || !Str::contains($attributes['image'], 'https')) {
                    $attributes['image'] = $baseUrl . $attributes['image'];
                }
            }
            $news = $this->repository->update($id, $attributes);
            $news->categories()->sync($request->get('category_id'));
            if ($request->get('tags'))
                $news->retag($request->get('tags'));
            $this->flushOldNewsCache($news);
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'News Updated SuccessFully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            DB::rollBack();
            return redirect()->back()->withInput()
                ->with('failed', 'Failed to Update News');
        }

    }


    protected function flushOldNewsCache($news)
    {
        $categories = $news->categories;
        foreach ($categories as $category) {
            if ($category->position) {
                $position = $category->position;
                if ($position->front_body_position) {
                    $a = getNumberInWords();
                    $isExists = array_key_exists($position->front_body_position, $a);
                    if ($isExists) {
                        $words = $a[$position->front_body_position];
                        if (Cache::has('_' . $words . 'PositionNews')) {
                            Cache::forget('_' . $words . 'PositionNews');
                        }
                    }
                }
                if ($position->detail_body_position) {
                    $a = getNumberInWords();
                    $isExists = array_key_exists($position->detail_body_position, $a);
                    if ($isExists) {
                        $words = $a[$position->detail_body_position];
                        if (Cache::has('_detailPage' . ucwords($words) . 'PositionNews')) {
                            Cache::forget('_detailPage' . ucwords($words) . 'PositionNews');
                        }
                    }
                }
            }
        }
    }

    public function store(NewsRequest $request)
    {
        $attributes = $request->validated();
        $baseRoute = getBaseRouteByUrl($request);
        try {
            DB::beginTransaction();
            if (is_null($attributes['slug'])) {
                $attributes['slug'] = $request->get('title');
            }
            $attributes['slug'] = Str::slug($attributes['slug']);
            $baseUrl = 'https://breaknlinks.s3.amazonaws.com/';
            if (!Str::contains($attributes['image'], $baseUrl)) {
                if (!Str::contains($attributes['image'], 'http')
                    || !Str::contains($attributes['image'], 'https')) {
                    $attributes['image'] = $baseUrl . $attributes['image'];
                }
            }
            $news = $this->repository->create($attributes);
            $news->categories()->sync($request->get('category_id'));
            if ($request->get('tags'))
                $news->tag($request->get('tags'));
            $this->flushOldNewsCache($news);
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'News Created SuccessFully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            DB::rollBack();
            return redirect()->back()->withInput()
                ->with('failed', 'Failed to create News');
        }
    }

    public function show(News $news)
    {
        return new Response($this->viewPath . 'show', ['news' => $news]);
    }

    public function destroy(Request $request, News $news)
    {
        $baseRoute = getBaseRouteByUrl($request);

        try {
            DB::beginTransaction();
            $news->delete();
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'News Deleted SuccessFully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route($baseRoute . '.index')
                ->with('failed', 'Failed to delete news.');
        }

    }
}
