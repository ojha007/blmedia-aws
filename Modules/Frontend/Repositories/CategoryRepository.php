<?php


namespace Modules\Frontend\Repositories;


use App\Repositories\Repository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\CategoryPositions;

class CategoryRepository extends Repository
{
    /**
     * @var Category
     */
    private $category;

    /**
     * CategoryRepository constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->model = $category;
    }


    public function getDetailPageHeaderCategoriesByPosition($limit = 10)
    {

        return Cache::remember('_detailPageHeaderCategoriesByPosition', 46000, function () use ($limit) {
            return $this->getNavbarCategoriesByPositionAndPlacement(CategoryPositions::DETAIL_HEADER_POSITION, 10);
        });

    }

    protected function getNavbarCategoriesByPositionAndPlacement($placement, $limit)
    {
        return DB::table('categories')
            ->select('categories.name', 'categories.slug')
            ->where('parent_id', null)
            ->where('is_active', true)
            ->join('category_positions', 'categories.id', '=', 'category_positions.category_id')
            ->whereNotNull('category_positions.' . $placement)
            ->orderBy('category_positions.' . $placement, 'ASC')
            ->limit($limit)
            ->get();
    }

    public function getFrontPageHeaderCategoriesByPosition($limit = 10)
    {
        return Cache::remember('_frontPageHeaderCategoriesByPosition', 10000, function () use ($limit) {
            return $this->getNavbarCategoriesByPositionAndPlacement(CategoryPositions::FRONT_HEADER_POSITION, 10);
        });
    }

    public function getChildCategory($slug, int $limit)
    {
        return DB::table('categories as c1')
            ->select('c2.name', 'c2.slug')
            ->join('categories as c2', 'c1.id', '=', 'c2.parent_id')
            ->whereNotNull('c2.parent_id')
            ->where('c2.is_active', true)
            ->whereNull('c2.deleted_at')
            ->where('c1.slug', '=', $slug)
            ->limit($limit)
            ->get();
    }

    public function getSimilarNewsByCategorySlug($slug, $except = null, $limit = 9)
    {

        $slug = is_array($slug) ? $slug : [$slug];
        return DB::table('news')
            ->selectRaw('SELECT distinct news.id')
            ->select('news.title', 'news.description',
                'news.id as news_slug', 'news.publish_date', 'news.image',
                'news.date_line',
                'news.image_description', 'news.image_alt')
            ->join('news_categories', 'news_categories.news_id', 'news.id')
            ->join('categories', 'categories.id', '=', 'news_categories.category_id')
            ->leftJoin('guests', 'news.guest_id', '=', 'guests.id')
            ->leftJoin('reporters', 'news.reporter_id', '=', 'reporters.id')
            ->selectRaw('IFNULL(reporters.name,guests.name) as author_name')
            ->selectRaw('IF(reporters.name IS NOT  NULL,"reporters","guests") as author_type')
            ->selectRaw('IFNULL(reporters.slug,guests.slug) as author_slug')
            ->whereIn('categories.slug', $slug)
            ->orderBy('news.created_at', 'DESC')
            ->where('news.is_active', '=', 1)
            ->whereNull('news.deleted_at')
            ->where('news.slug', '!=', $except)
            ->inRandomOrder('news.id')
            ->orderByDesc('news.id')
            ->groupBy('news.id')
            ->limit($limit)
            ->get();
    }

    public function getCategorySlugByPosition($column, $position): string
    {
        $a = DB::table('categories as c')
            ->join('category_positions as cp', 'c.id', '=', 'cp.category_id')
            ->where($column, $position)
            ->first();
        if ($a) return $a->slug;
        return '';
    }
}
