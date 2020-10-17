<?php


namespace Modules\Frontend\Repositories;


use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Backend\Entities\CategoryPositions;
use Modules\Frontend\Entities\Category;

class NewsRepository extends Repository
{
    protected $module = 'fronted';
    protected $model;
    /**
     * @var CategoryRepository
     */
    private $categoryRepo;

    public function __construct()
    {
        $this->categoryRepo = new CategoryRepository(new Category());
    }

    public function getNewsByCategory($category_id, $limit)
    {

        try {
            return DB::table('news')
//                ->selectRaw(DB::raw('SELECT distinct(news.id)'))
                ->select('news.title',
                    'news.description',
                    'guests.name as guest_name',
                    'news.date_line',
                    'reporter_slug as reporter_slug',
                    'guests.slug as guest_slug',
                    'reporters.name as reporter_name',
                    'news.id',
                    'categories.is_video')
                ->join('news_categories_pivot', 'news_id', '=', 'news_category_id')
                ->join('news_categories', 'news_categories.id', 'news_categories_pivot.news_category_id')
                ->leftJoin('guests', 'news.guest_id', '=', 'guests.id')
                ->leftJoin('reporters', 'news.reporter_id', '=', 'reporters.id')
                ->where('news_category_id', '=', $category_id)
                ->where('news.is_active', true)
                ->whereNull('news.deleted_at')
                ->orderByDesc('news.publish_date')
                ->limit($limit);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->route('/');
        }


    }

    public function getNewsByPosition(int $position, int $limit)
    {

        return DB::table('news')
//            ->selectRaw('SELECT DISTINCT (news.slug) ')
            ->select('news.title',
                'news.sub_title',
                'news.short_description',
                'categories.name as categories',
                'news.id as news_slug',
                'news.publish_date',
                'categories.slug as category_slug',
                'news.image',
                'news.date_line',
                'reporter_slug as reporter_slug',
                'guests.slug as guest_slug',
                'reporters.image as reporter_image',
                'guests.image as guest_image',
                'news.image_description',
                'news.image_alt',
                'categories.is_video')
            ->join('news_categories', 'news_categories.news_id', '=', 'news.id')
            ->join('categories', 'categories.id', '=', 'news_categories.category_id')
            ->join('category_positions', 'categories.id', '=', 'category_positions.category_id')
            ->leftJoin('guests', 'news.guest_id', '=', 'guests.id')
            ->leftJoin('reporters', 'news.reporter_id', '=', 'reporters.id')
            ->where('category_positions.front_body_position', $position)
            ->orderByDesc('news.publish_date')
            ->where('news.is_active', true)
            ->whereNull('news.deleted_at')
            ->limit($limit)
            ->get();
    }

    public function getDetailNewsByPosition(int $position, int $limit)
    {

        return DB::table('news')
            ->select('news.title',
                'news.sub_title',
                'news.short_description',
                'categories.name as categories',
                'news.id as news_slug',
                'news.publish_date',
                'categories.slug as category_slug',
                'news.image',
                'news.date_line',
                'reporters.image as reporter_image',
                'guests.image as guest_image',
                'news.image_description', 'news.image_alt', 'categories.is_video')
            ->selectRaw('SELECT DISTINCT news.id')
            ->join('news_categories', 'news_categories.news_id', '=', 'news.id')
            ->join('categories', 'categories.id', '=', 'news_categories.category_id')
            ->join('category_positions', 'categories.id', '=', 'category_positions.category_id')
            ->leftJoin('guests', 'news.guest_id', '=', 'guests.id')
            ->leftJoin('reporters', 'news.reporter_id', '=', 'reporters.id')
            ->where('category_positions.detail_body_position', $position)
            ->orderByDesc('news.publish_date')
            ->where('news.is_active', true)
            ->whereNull('news.deleted_at')
            ->distinct(true)
            ->limit($limit)
            ->get();
    }

    public function getCategoryDoesntExitsInDetailPage()
    {

        return DB::table('categories')
            ->select('categories.slug as category_slug', 'categories.is_video')
            ->join('category_positions', 'categories.id', '=', 'category_positions.category_id')
            ->whereNull('category_positions.detail_body_position')
            ->whereNull('category_positions.front_body_position')
            ->where('is_active', true)
            ->limit(10)
            ->get()
            ->pluck('slug');
    }


    public function getNewsByExtraColumn(int $position, int $limit, $extra_column)
    {
        $category = $extra_column == 'is_anchor' ? 'anchor' : 'bl_special';
        return DB::table('news')
            ->select('news.title',
                'news.sub_title',
                'news.short_description',
                'categories.name as categories',
                'news.slug as news_slug',
                'news.publish_date',
                'categories.slug as category_slug',
                'news.image',
                'news.date_line',
                'reporters.image as reporter_image',
                'guests.image as guest_image',
                'reporters.name as reporter_name',
                'reporters.slug as reporter_slug',
                'guests.slug as guest_slug',
                'guests.name as guest_name',
                'news.image_description',
                'news.image_alt',
                'categories.is_video')
            ->join('news_categories', 'news_categories.news_id', '=', 'news.id')
            ->join('categories', 'categories.id', '=', 'news_categories.category_id')
            ->where('categories.slug', '=', $category)
            ->join('category_positions', 'categories.id', '=', 'category_positions.category_id')
            ->leftJoin('guests', 'news.guest_id', '=', 'guests.id')
            ->leftJoin('reporters', 'news.reporter_id', '=', 'reporters.id')
            ->where('category_positions.front_body_position', $position)
            ->where('news.' . $extra_column, '=', 1)
            ->orderByDesc('news.publish_date')
            ->where('news.is_active', true)
            ->whereNull('news.deleted_at')
            ->limit($limit)
            ->get();
    }

    public function getDetailPageCommonData()
    {
        $headerCategories = $this->categoryRepo->getDetailPageHeaderCategoriesByPosition();
        $blSpecialNews = $this->getCacheNewsByExtraColumn('is_special', 5);
//        $trendingNews = [];
        $trendingNews = (new NewsRepository())->getTrendingNews(5);
        $detailPageSecondPositionNews = $this->getCacheNews(2, CategoryPositions::DETAIL_BODY_POSITION, 4, 'detailPageSecondPositionNews');
        $detailPageThirdPositionNews = $this->getCacheNews(3, CategoryPositions::DETAIL_BODY_POSITION, 4, 'detailPageThirdPositionNews');
        return [
            'headerCategories' => $headerCategories,
            'blSpecialNews' => $blSpecialNews,
            'trendingNews' => $trendingNews,
            'detailPageSecondPositionNews' => $detailPageSecondPositionNews,
            'detailPageThirdPositionNews' => $detailPageThirdPositionNews
        ];
    }

    public function getCacheNewsByExtraColumn($column, $limit)
    {
        $category = ($column == 'is_special' ? trans('messages.bl_special') : trans('messages.anchor'));
        $category_slug = ($column == 'is_special' ? 'bl-special' : 'anchor');
//        return Cache::remember($column . '_news', 45500, function () use ($column, $limit, $category, $category_slug) {
        return DB::table('news')
            ->select('news.title',
                'news.id as news_slug',
                'news.image as image',
                'news.' . $column,
                'news.publish_date',
                'news.short_description',
                'news.date_line',
                'news.sub_title',
                'reporters.image as reporter_image',
                'reporters.name as reporter_name',
                'reporters.slug as reporter_slug',
                'guests.name as guest_name',
                'guests.image as guest_image',
                'guests.slug as guest_slug',
                'news.image_alt',
                'news.image_description')
            ->selectRaw("'$category' as categories")
            ->selectRaw("'$category_slug' as category_slug")
            ->leftJoin('guests', 'news.guest_id', '=', 'guests.id')
            ->leftJoin('reporters', 'news.reporter_id', '=', 'reporters.id')
            ->where('news.is_active', true)
            ->where('news.' . $column, '=', 1)
            ->orderByDesc('news.publish_date')
            ->limit($limit)
            ->get();
//        });
    }

    public function getTrendingNews($limit)
    {
        $trending = trans('messages.trending');
        $slug = 'trending';
        return DB::table('news')
            ->select(
                'news.title',
                'news.sub_title',
                'news.short_description',
                'news.description',
                'reporters.name as reporter_name',
                'reporters.image as reporter_image',
                'reporters.slug as reporter_slug',
                'guests.slug as guest_slug',
                'guests.name as guest_name',
                'guests.image as guest_image',
                'news.image_description',
                'news.external_url',
                'news.video_url',
                'news.date_line',
                'news.is_active',
                'news.publish_date',
                'news.id as news_slug',
                'news.image',
                'news.view_count',
                'news.image_alt'
            )
            ->selectRaw("'$trending' as categories")
            ->selectRaw("'$slug' as category_slug")
            ->selectRaw("'0' as is_video")
            ->leftJoin('guests', 'news.guest_id', '=', 'guests.id')
            ->leftJoin('reporters', 'news.reporter_id', '=', 'reporters.id')
            ->where('news.is_active', '=', true)
            ->whereNull('news.deleted_at')
//            ->orderByDesc('news.publish_date')
            ->orderByDesc('news.view_count')
            ->paginate($limit);


    }

    public function getCacheNews(int $position, $placement, $limit, $cacheName)
    {
//        return Cache::remember('_' . $cacheName, 4800, function () use ($position, $placement, $limit) {
        return $this->getNewsByPositionAndPlacement($position, $placement, $limit);
//        });

    }

    public function getNewsByPositionAndPlacement(int $position, $placement, int $limit)
    {
        $category = DB::table('categories')
            ->select(
                'categories.id',
                'categories.slug',
                'categories.name')
            ->join('category_positions', 'categories.id', '=', 'category_positions.category_id')
            ->where('category_positions.' . $placement, '=', $position)
            ->first();
        if ($category) {
            if ($position == 5) {
                return $this->blBreakNews($category, $limit);
            }
            if ($position == 8) {
                return $this->getSamacharNews($category, $limit);

            }
            return $this->newsByPosition($category, $limit);
        }

        return [];
    }

    protected function blBreakNews($category, $limit)
    {
        if ($category->slug == 'break') {
            $break = trans('messages.break');
            $breakSlug = 'break';
            return DB::table('news')
                ->select(
                    'news.title',
                    'news.sub_title',
                    'news.short_description',
                    'news.id as news_slug',
                    'reporters.image as reporter_image',
                    'reporters.name as reporter_name',
                    'reporters.slug as reporter_slug',
                    'guests.name as guest_name',
                    'guests.image as guest_image',
                    'guests.slug as guest_slug',
                    'news.publish_date',
                    'news.date_line',
                    'news.image',
                    'news.image_description',
                    'news.image_alt'
                )
                ->selectRaw('"' . $break . '" as  categories ,"' . $breakSlug . '" as category_slug,0 as is_video')
                ->leftJoin('guests', 'news.guest_id', '=', 'guests.id')
                ->leftJoin('reporters', 'news.reporter_id', '=', 'reporters.id')
                ->where('news.is_active', true)
                ->whereNull('news.deleted_at')
                ->orderByDesc('publish_date')
//                ->distinct(true)
                ->limit($limit)
                ->get();
        } else {
            return $this->newsByPosition($category, $limit);
        }
    }

    protected function newsByPosition($category, $limit)
    {
        $category_name = $category->name;
        $category_slug = $category->slug;
        $childCategories = [];
        if ($category) {
            $childCategories = DB::table('categories')
                ->select('id')
                ->where('parent_id', '=', $category->id)
                ->get()->map(function ($cat) {
                    return $cat->id;
                })->toArray();
        }
        return DB::table('news')
            ->select(
                'news.title',
                'news.sub_title',
                'news.id as news_slug',
                'news.short_description',
                'reporters.image as reporter_image',
                'reporters.name as reporter_name',
                'reporters.slug as reporter_slug',
                'guests.name as guest_name',
                'guests.image as guest_image',
                'guests.slug as guest_slug',
                'news.publish_date',
                'news.date_line',
                'categories.is_video',
                'news.image',
                'news.image_description',
                'news.image_alt'
            )
            ->join('news_categories', 'news_categories.news_id', '=', 'news.id')
            ->join('categories', 'categories.id', '=', 'news_categories.category_id')
            ->leftJoin('guests', 'news.guest_id', '=', 'guests.id')
            ->leftJoin('reporters', 'news.reporter_id', '=', 'reporters.id')
            ->selectRaw('"' . $category_name . '" as  categories ,"' . $category_slug . '" as category_slug')
            ->where('news.is_active', '=', 1)
            ->whereNull('news.deleted_at')
            ->where('categories.id', '=', $category->id)
            ->when(count($childCategories), function ($a) use ($childCategories) {
                $a->orWhereIn('categories.id', $childCategories);
            })
            ->orderByDesc('publish_date')
            ->limit($limit)
            ->get();
    }

    protected function getSamacharNews($category, $limit)
    {

        $category_name = trans('messages.news');
        $category_slug = 'news';
        $segment = request()->segment(1);
        $mixCategoryId = [33, 3, 6, 13, 23, 36, 37, 38];
        if ($segment == 'nepali') {
            $mixCategoryId = [2, 35, 60, 23, 62, 38, 33, 13, 65,];
        }
        if ($segment == 'hindi') {
            $mixCategoryId = [2, 35, 60, 23, 62, 38, 33, 13, 65,];
        }
        if ($category->slug == 'news') {
            return DB::table('news')
                ->select('news.title',
                    'news.sub_title',
                    'news.id as news_slug',
                    'news.short_description',
                    'reporters.name as reporter_name',
                    'reporters.slug as reporter_slug',
                    'reporters.image as reporter_image',
                    'guests.name as guest_name',
                    'guests.image as guest_image',
                    'guests.slug as guest_slug',
                    'news.publish_date',
                    'news.date_line',
                    'news.image',
                    'news.image_description',
                    'news.image_alt')
                ->selectRaw('"' . $category_name . '" as  categories ,"' . $category_slug . '" as category_slug,0 as is_video')
                ->leftJoin('guests', 'news.guest_id', '=', 'guests.id')
                ->leftJoin('reporters', 'news.reporter_id', '=', 'reporters.id')
                ->join('news_categories', 'news_categories.news_id', '=', 'news.id')
                ->join('categories', 'categories.id', '=', 'news_categories.category_id')
                ->whereIn('categories.id', $mixCategoryId)
//                ->where('categories.slug', $category_slug)
                ->where('news.is_active', '=', 1)
                ->whereNull('news.deleted_at')
                ->orderByDesc('publish_date')
//                ->distinct(true)
                ->limit($limit)
                ->get();

        } else {
            return $this->newsByPosition($category, $limit);
        }
    }

    protected function childNewsToParent()
    {

    }
}

