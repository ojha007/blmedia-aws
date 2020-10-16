<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Backend\Entities\Advertisement;
use Modules\Backend\Repositories\AdvertisementRepository;
use Modules\Frontend\Entities\Category;
use Modules\Frontend\Repositories\CategoryRepository;
use Modules\Frontend\Repositories\NewsRepository;


class CategoryController extends Controller
{

    /**
     * @var string
     */
    protected $module = 'fronted';
    /**
     * @var string
     */
    protected $viewPath = 'frontend::components.';
    /**
     * @var Category
     */
    protected $model;
    /**
     * @var CategoryRepository
     */
    protected $repository;
    /**
     * @var AdvertisementRepository
     */
    private $adsRepository;
    private $newsRepository;

    public function __construct(Category $category)
    {
        $this->model = $category;
        $this->repository = new CategoryRepository($category);
        $this->adsRepository = new AdvertisementRepository(new Advertisement());
        $this->newsRepository = new NewsRepository();
    }

    public function showNewsByCategory($slug)
    {
        $newsByCategory = $this->getNewsByCategorySlug($slug);
        $advertisements = $this->adsRepository->getAllAdvertisements('category_page');
        $breadcrumbs = $this->repository->getChildCategory($slug, 7);
        $childCategoriesNews = $this->getChildCategoryNews($slug, 5);
        return view($this->viewPath . '.newsByCategory',
            compact('newsByCategory', 'breadcrumbs',
                'childCategoriesNews'
            ))
            ->with($this->newsRepository->getDetailPageCommonData())
            ->with($advertisements);
    }

    public function getNewsByCategorySlug($slug, $perPage = 25)
    {

        if ($slug == 'anchor' || $slug == 'bl-special') {
            return $this->getAnchorOrSpecialNews($slug, $perPage);
        }
        try {
            $category = DB::table('categories')
                ->select('id', 'name', 'slug')
                ->where('slug', '=', $slug)
                ->first();
            if ($slug == 'trending') {
                return [];
//                return (new NewsRepository())->getTrendingNews(30);
            }
            $childCategoriesId = [];
            if ($category) {
                $childCategoriesId = $this->getAllChildCategoriesId($category->id);
            }
            return DB::table('news')
                ->select('news.sub_title',
                    'news.id as news_slug',
                    'news.title',
                    'news.short_description',
                    'news.description',
                    'news.publish_date',
                    'news.image',
                    'news.image_alt',
                    'news.is_active',
                    'guests.name as guest_name',
                    'guests.slug as guest_slug',
                    'guests.image as guest_image',
                    'reporters.name as reporter_name',
                    'reporters.image as reporter_image',
                    'reporters.slug as reporter_slug',
                    'news.image_description',
                    'news.date_line'
                )
                ->leftJoin('reporters', 'reporters.id', '=', 'news.reporter_id')
                ->leftJoin('guests', 'guests.id', '=', 'news.guest_id')
                ->selectRaw("'$slug'as category_slug")
                ->selectRaw("'$category->name'as categories")
                ->join('news_categories', 'news.id', '=', 'news_categories.news_id')
                ->join('categories', 'news_categories.category_id', '=', 'categories.id')
                ->where('categories.id', '=', $category->id)
                ->when(count($childCategoriesId), function ($a) use ($childCategoriesId) {
                    $a->orWhereIn('categories.id', $childCategoriesId);
                })
                ->where('news.is_active', '=', 1)
                ->whereNull('news.deleted_at')
                ->orderByDesc('news.publish_date')
                ->paginate($perPage);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
        }

    }

    public function getAnchorOrSpecialNews($category, $perPage)
    {
        try {
            $category_slug = $category == 'anchor' ? 'anchor' : 'bl-special';
            $display_name = trans('messages.' . $category_slug);
            $column = $category == 'anchor' ? 'is_anchor' : 'is_special';
            return DB::table('news')
                ->select('news.sub_title',
                    'news.id as news_slug',
                    'news.title',
                    'news.short_description',
                    'news.description',
                    'news.publish_date',
                    'news.image',
                    'news.image_alt',
                    'news.is_active',
                    'guests.name as guest_name',
                    'guests.slug as guest_slug',
                    'guests.image as guest_image',
                    'reporters.name as reporter_name',
                    'reporters.image as reporter_image',
                    'reporters.slug as reporter_slug',
                    'news.image_description',
                    'news.date_line'
                )
                ->leftJoin('reporters', 'reporters.id', '=', 'news.reporter_id')
                ->leftJoin('guests', 'guests.id', '=', 'news.guest_id')
                ->selectRaw("'$display_name' as categories")
                ->selectRaw("'$category_slug' as category_slug")
                ->where('news.' . $column, '=', true)
                ->where('news.is_active', '=', 1)
                ->whereNull('news.deleted_at')
                ->orderByDesc('news.publish_date')
                ->paginate($perPage);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back();
        }

    }

    public function getAllChildCategoriesId($parent_id)
    {
        return DB::table('categories')
            ->select('id')
            ->where('parent_id', '=', $parent_id)
            ->get()->map(function ($cat) {
                return $cat->id;
            })->toArray();
    }

    public function getChildCategoryNews($slug, $limit)
    {
        $category = DB::table('categories as c1')
            ->join('categories as c2', 'c2.parent_id', '=', 'c1.id')
            ->select('c2.id as c2_id', 'c2.name as name', 'c2.slug as slug')
            ->where('c1.slug', $slug)
            ->where('c2.is_active', true);

        return DB::table('news')
            ->join('news_categories', 'news.id', '=', 'news_categories.news_id')
            ->joinSub($category, 'cat', function ($query) {
                $query->on('news_categories.category_id', '=', 'cat.c2_id')
                    ->groupBy('cat.cat2_id');
            })
            ->select('news.sub_title',
                'news.id as news_slug',
                'news.title',
                'news.short_description',
                'news.description',
                'news.publish_date',
                'news.date_line',
                'guests.name as guest_name',
                'guests.slug as guest_slug',
                'guests.image as guest_image',
                'reporters.name as reporter_name',
                'reporters.image as reporter_image',
                'reporters.slug as reporter_slug',
                'news.image', 'news.image_alt',
                'news.image_description',
                'cat.slug as category_slug',
                'cat.name as categories', 'cat.c2_id'
            )
            ->leftJoin('reporters', 'reporters.id', '=', 'news.reporter_id')
            ->leftJoin('guests', 'guests.id', '=', 'news.guest_id')
            ->where('news.is_active', true)
            ->whereNull('news.deleted_at')
            ->orderByDesc('news.publish_date')
            ->get()
            ->groupBy('c2_id')
            ->map(function ($news) use ($limit) {
                return $news->take($limit);
            });


    }

}
