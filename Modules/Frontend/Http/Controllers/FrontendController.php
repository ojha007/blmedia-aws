<?php

namespace Modules\Frontend\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Backend\Entities\Advertisement;
use Modules\Backend\Entities\CategoryPositions;
use Modules\Backend\Repositories\AdvertisementRepository;
use Modules\Backend\Repositories\NewsCategoryRepository;
use Modules\Frontend\Entities\Category;
use Modules\Frontend\Repositories\CategoryRepository;
use Modules\Frontend\Repositories\NewsRepository;

class FrontendController extends Controller
{

    /**
     * @var NewsCategoryRepository
     */
    private $newCategoryRepository;
    /**
     * @var NewsRepository
     */
    private $newsRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var AdvertisementRepository
     */
    private $adsRepository;

    public function __construct()
    {

        $this->categoryRepository = new CategoryRepository(new Category());
        $this->newsRepository = new NewsRepository();
        $this->adsRepository = new AdvertisementRepository(new Advertisement());
    }


    public function index()
    {
        $segment = request()->segment(1);
        $country = $this->getCountyByIp();
        if ($country != 'en') {
            if (!in_array($segment, config('editions'))) {
                return $this->redirectClientByIp();
            }
        }
//        $trendingNews = [];
        $newsRepo = $this->newsRepository;
        $headerCategories = $this->categoryRepository->getFrontPageHeaderCategoriesByPosition();
        $advertisements = $this->adsRepository->getAllAdvertisements('main_page');
        $anchorNews = $newsRepo->getCacheNewsByExtraColumn('is_anchor', 5);
        $blSpecialNews = $newsRepo->getCacheNewsByExtraColumn('is_special', 5);
        $trendingNews = [];
        $firstPositionNews = $newsRepo->getCacheNews(1, CategoryPositions::FRONT_BODY_POSITION, 9, 'firstPositionNews');
        $fourthPositionNews = $newsRepo->getCacheNews(4, CategoryPositions::FRONT_BODY_POSITION, 5, 'fourthPositionNews');
        $fifthPositionNews = $newsRepo->getCacheNews(5, CategoryPositions::FRONT_BODY_POSITION, 5, 'fifthPositionNews');
        $sixthPositionNews = $newsRepo->getCacheNews(6, CategoryPositions::FRONT_BODY_POSITION, 6, 'sixthPositionNews');
        $seventhPositionNews = $newsRepo->getCacheNews(7, CategoryPositions::FRONT_BODY_POSITION, 6, 'seventhPositionNews');
        $eighthPositionNews = $newsRepo->getCacheNews(8, CategoryPositions::FRONT_BODY_POSITION, 9, 'eighthPositionNews');
        $ninthPositionNews = $newsRepo->getCacheNews(9, CategoryPositions::FRONT_BODY_POSITION, 6, 'ninthPositionNews');
        $tenthPositionNews = $newsRepo->getCacheNews(10, CategoryPositions::FRONT_BODY_POSITION, 6, 'tenthPositionNews');
        $eleventhPositionNews = $newsRepo->getCacheNews(11, CategoryPositions::FRONT_BODY_POSITION, 5, 'eleventhPositionNews');
        $twelvePositionNews = $newsRepo->getCacheNews(12, CategoryPositions::FRONT_BODY_POSITION, 5, 'twelvePositionNews');
        $thirteenPositionNews = $newsRepo->getCacheNews(13, CategoryPositions::FRONT_BODY_POSITION, 4, 'thirteenPositionNews');
        $fourteenPositionNews = $newsRepo->getCacheNews(14, CategoryPositions::FRONT_BODY_POSITION, 6, 'fourteenPositionNews');
        $fifteenPositionNews = $newsRepo->getCacheNews(15, CategoryPositions::FRONT_BODY_POSITION, 9, 'fifteenPositionNews');
        return view('frontend::index', compact(
            'headerCategories',
            'firstPositionNews',
            'fourthPositionNews',
            'anchorNews',
            'blSpecialNews',
            'fifthPositionNews',
            'sixthPositionNews',
            'seventhPositionNews',
            'eighthPositionNews',
            'ninthPositionNews',
            'tenthPositionNews',
            'eleventhPositionNews',
            'twelvePositionNews',
            'fourthPositionNews',
            'thirteenPositionNews',
            'fifteenPositionNews',
            'trendingNews',
            'fourteenPositionNews'))
            ->with($advertisements);

    }

    public function getCountyByIp()
    {
//        $ip = "43.245.87.255";
        $ip = request()->ip();
        $data = null;
        $data = \Location::get($ip);
        if ($data) {
            if ($data->countryName == 'Nepal') {
                return 'Nepal';
            }
            if ($data->countryName == 'India') {
                return 'India';
            }
            return 'en';
        } else {
            return 'en';
        }
    }

    protected function redirectClientByIp()
    {


        $country = $this->getCountyByIp();
        if (strtolower($country) == "nepal") {
            return redirect('/nepali');
        }
        if (strtolower($country) == "india") {
            return redirect('/hindi');
        }
        return redirect('/');
    }

    public function getAllEditions()
    {
        return config('editions');
    }

    public function videos()
    {
        $headerCategories = $this->categoryRepository->getFrontPageHeaderCategoriesByPosition();
        $advertisements = $this->adsRepository->getAllAdvertisements('main_page');
        $fourthPositionNews = $this->newsRepository->getNewsByPosition(4, 9);
        return view('frontend::components.videos.videos', compact('headerCategories', 'fourthPositionNews'))->with($advertisements);
    }

    public function preetiToUniCode()
    {
        return view('frontend::unicode.preeti-to-unicode');
    }

    public function unicodeToPreeti()
    {
        return view('frontend::unicode.unicode-to-preeti');
    }

    public function romanToUnicode()
    {
        return view('frontend::unicode.roman-to-nepali');
    }

    public function getFrontPageFirstPositionNews($limit)
    {
        try {
            $childCategories = [];
            $category = $this->getFrontPageCategory(1);
            $category_slug = $category->slug;
            $category_name = $category->name;
            if ($category) {
                $childCategories = DB::table('categories')
                    ->select('id')
                    ->where('parent_id', '=', $category->id)
                    ->get()->map(function ($cat) {
                        return $cat->id;
                    })->toArray();
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
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
        }


    }

    public function getFrontPageCategory($position)
    {
        try {
            return DB::table('categories')
                ->select(
                    'categories.id',
                    'categories.slug',
                    'categories.name')
                ->join('category_positions', 'categories.id', '=', 'category_positions.category_id')
                ->where('category_positions.front_body_position', '=', $position)
                ->first();
        } catch (\Exception $exception) {
            Log::error($exception->getTraceAsString() . '-' . $exception->getMessage());
            return redirect()->back();
        }

    }
}
