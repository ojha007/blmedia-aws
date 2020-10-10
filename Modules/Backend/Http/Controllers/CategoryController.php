<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\CategoryPositions;
use Modules\Backend\Http\Requests\NewsCategoryRequest;
use Modules\Backend\Http\Responses\Response;
use Modules\Backend\Repositories\NewsCategoryRepository;

class CategoryController extends Controller
{

    protected $routePrefix = 'news-category';
    protected $viewPath = 'backend::news-category.';
    protected $model;
    /**
     * @var NewsCategoryRepository
     */
    protected $repository;

    public function __construct(Category $category)
    {

        $this->model = $category;
        $this->middleware('auth');
        $this->middleware(['permission:news-category-view|news-category-create|news-category-edit|news-category-delete'], ['only' => ['index', 'show']]);
        $this->middleware(['permission:news-category-create'], ['only' => ['create', 'store', 'show']]);
        $this->middleware(['permission:news-category-edit'], ['only' => ['edit', 'update', 'show']]);
        $this->middleware(['permission:news-category-delete'], ['only' => ['destroy']]);
        $this->repository = new NewsCategoryRepository($category);
    }

    public function index()
    {
        $categories = Category::with('childCategories')
            ->whereNull('parent_id')
            ->get();
        return new Response($this->viewPath . 'index', ['categories' => $categories]);
    }

    public function create()
    {
        $viewPath = $this->viewPath . 'create';
        $attributes = [
            'category' => $this->model,
        ];
        $attributes = array_merge($attributes, $this->repository->getViewData());
        return new Response($viewPath, $attributes);
    }

    public function edit(Category $category)
    {
        $data = [
            'category' => $category,
        ];
        $attributes = array_merge($data, $this->repository->getViewData($category));
        return new Response($this->viewPath . 'edit', $attributes);
    }

    public function update(NewsCategoryRequest $request, $id)
    {
        $attributes = $request->only((new Category())->getFillable());
        $attributes['slug'] = Str::slug($request->get('slug'));
        $baseRoute = getBaseRouteByUrl($request);
        try {
            DB::beginTransaction();
            $category = $this->repository->update($id, $attributes);
            $this->updateOrCreateRelations($category, $request);
            DB::commit();
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'News Category updated SuccessFully');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            DB::rollBack();
            return redirect()->back()->withInput()
                ->with('failed', 'Failed to update News Category');
        }
    }

    protected function updateOrCreateRelations($category, $request): void
    {
        if (array_filter($request->get('position'))) {
            $attributes = array_merge(['category_id' => $category->id], $request->get('position'));
            $this->makeNullToCommon($attributes);
            $category->position()
                ->updateOrCreate(
                    ['category_id' => $category->id], $request->get('position')
                );
        }
        if (array_filter($request->get('meta'))) {
            DB::table('category_meta_tags')
                ->updateOrInsert(['category_id' => $category->id], $request->get('meta'));
        }
    }

    protected function makeNullToCommon($attributes): void
    {
        $a = CategoryPositions::where('front_header_position', $attributes['front_header_position'])->get();
        $b = CategoryPositions::where('front_body_position', $attributes['front_body_position'])->get();
        $c = CategoryPositions::where('detail_header_position', $attributes['detail_header_position'])->get();
        $d = CategoryPositions::where('detail_body_position', $attributes['detail_body_position'])->get();
//        $collections = $a->concat($b)->concat($c)->concat($d);
//        dd($collections);
        if (!$a->isEmpty()) {
            foreach ($a as $aa) {
                $aa->front_header_position = null;
                $aa->save();
            }
        }
        if (!$b->isEmpty()) {
            foreach ($b as $aa) {
                $aa->front_body_position = null;
                $aa->save();
            }
        }
        if (!$c->isEmpty()) {
            foreach ($c as $aa) {
                $aa->detail_header_position = null;
                $aa->save();
            }
        }
        if (!$d->isEmpty()) {
            foreach ($d as $aa) {
                $aa->detail_body_position = null;
                $aa->save();
            }
        }
    }

    public function store(NewsCategoryRequest $request)
    {
        $attributes = $request->only((new Category())->getFillable());
        $attributes['slug'] = Str::slug($request->get('slug'));
        $baseRoute = getBaseRouteByUrl($request);
        try {
            DB::beginTransaction();
            $category = $this->repository->create($attributes);
            $this->updateOrCreateRelations($category, $request);
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

    public function destroy(Request $request, $id)
    {
        $baseRoute = getBaseRouteByUrl($request);
        try {
            $this->repository->delete($id);
            return redirect()->route($baseRoute . '.index')
                ->with('success', 'News Category deleted  SuccessFully');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back()->withInput()
                ->with('failed', 'Failed to delete News Category');
        }
    }
}
