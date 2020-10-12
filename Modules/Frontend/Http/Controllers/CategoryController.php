<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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

    public function getNewsByCategorySlug($slug, $perPage = 15)
    {
        $category = DB::table('categories')
            ->select('id', 'name')
            ->where('slug', $slug)
            ->first();
        if (!$category) return redirect('/');
        $childCategories = DB::table('categories')
            ->select('id')
            ->where('parent_id', '=', $category->id)
            ->get()->map(function ($cat) {
                return $cat->id;
            })->toArray();

        $isExtraCategory = $slug == 'anchor' || $slug == 'bl-special';
        return DB::table('news')
            ->select('news.sub_title', 'news.id as news_slug', 'news.title', 'news.short_description',
                'news.description', 'news.publish_date', 'news.image', 'news.image_alt', 'news.image_description',
                'news.date_line'
            )
            ->selectRaw('IFNULL(reporters.name,guests.name) as author_name')
            ->selectRaw('IF(reporters.name IS NOT  NULL,"reporters","guests") as author_type')
            ->selectRaw('IFNULL(reporters.slug,guests.slug) as author_slug')
            ->leftJoin('reporters', 'reporters.id', '=', 'news.reporter_id')
            ->leftJoin('guests', 'guests.id', '=', 'news.guest_id')
            ->when($isExtraCategory, function ($a) use ($slug) {
                $category_slug = $slug == 'anchor' ? 'anchor' : 'bl-special';
                $category = trans('messages.' . $category_slug);
                $column = $slug == 'anchor' ? 'is_anchor' : 'is_special';
                $a->selectRaw("'$category' as categories")
                    ->selectRaw("'$category_slug' as category_slug")
                    ->where('news.' . $column, '=', true);
            })->when($isExtraCategory == false, function ($a) use ($slug, $childCategories, $category) {
                $a->selectRaw("'$slug'as category_slug")
                    ->selectRaw("'$category->name'as categories")
                    ->join('news_categories', 'news.id', '=', 'news_categories.news_id')
                    ->join('categories', 'news_categories.category_id', '=', 'categories.id')
                    ->where('categories.slug', '=', $slug)
                    ->orWhereIn('categories.id', $childCategories);

            })
            ->where('news.is_active', '=', 1)
            ->whereNull('news.deleted_at')
            ->orderByDesc('news.publish_date')
            ->distinct(true)
            ->paginate($perPage);

    }

    public function getChildCategoryNews($slug, $limit)
    {
        $category = DB::table('categories as c1')
            ->join('categories as c2', 'c2.parent_id', '=', 'c1.id')
            ->select('c2.id as c2_id', 'c2.name as name', 'c2.slug as slug')
            ->where('c1.slug', $slug)
            ->where('c2.is_active', true);

        return DB::table('news')
            ->selectRaw(DB::raw('SELECT distinct(news.id)'))
            ->join('news_categories', 'news.id', '=', 'news_categories.news_id')
            ->joinSub($category, 'cat', function ($query) {
                $query->on('news_categories.category_id', '=', 'cat.c2_id')
                    ->groupBy('cat.cat2_id');
            })
            ->select('news.sub_title', 'news.id as news_slug', 'news.title',
                'news.short_description',
                'news.description', 'news.publish_date',
                'news.date_line',
                'news.image', 'news.image_alt', 'news.image_description',
                'cat.slug as category_slug', 'cat.name as categories', 'cat.c2_id'
            )
            ->selectRaw('IFNULL(reporters.name,guests.name) as author_name')
            ->selectRaw('IF(reporters.name IS NOT  NULL,"reporters","guests") as author_type')
            ->selectRaw('IFNULL(reporters.slug,guests.slug) as author_slug')
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
