<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Backend\Entities\Advertisement;
use Modules\Backend\Entities\News;
use Modules\Backend\Repositories\AdvertisementRepository;
use Modules\Frontend\Entities\Category;
use Modules\Frontend\Repositories\CategoryRepository;
use Modules\Frontend\Repositories\NewsRepository;

class NewsController extends Controller
{
    protected $module = 'fronted';

    protected $viewPath = 'frontend::components.';
    private $categoryRepository;
    /**
     * @var AdvertisementRepository
     */
    private $adsRepository;
    private $newsRepository;

    public function __construct()
    {
        $this->categoryRepository = new  CategoryRepository(new Category());
        $this->adsRepository = new AdvertisementRepository(new Advertisement());
        $this->newsRepository = new NewsRepository();
    }

    public function showNews($slug)
    {

        try {
            $news = $this->getNews($slug);
            if (!$news->is_active) {
                return redirect()->back();
            }
            $category_slug = $news->category_name;
            $advertisements = $this->adsRepository->getAllAdvertisements('detail_page');
            if (count($category_slug) == 0) {
                $category_slug = $this->newsRepository->getCategoryDoesntExitsInDetailPage();
            }
            $sameCategoryNews = $this->categoryRepository->getSimilarNewsByCategorySlug($category_slug, $news->slug, 9);
            return view($this->viewPath . '.newsDetail',
                compact('news', 'sameCategoryNews'))
                ->with($this->newsRepository->getDetailPageCommonData())
                ->with($advertisements);

        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back();
        }

    }

    protected function getNews($id)
    {
        return News::with('categories', 'reporter', 'guest', 'tags')
//            ->where('slug', $id)
            ->where('id', $id)
            ->first();
    }


    public function newsByAuthor($author_type, $author_slug)
    {
        try {
            $db = $author_type == 'reporters' ? 'reporters' : 'guests';
            $column = $db == 'reporters' ? 'reporter_id' : 'guest_id';
            $newsByAuthor = DB::table('news')
                ->select('news.title', 'news.sub_title', 'news.short_description',
                    'categories.name as categories', 'news.id as news_slug', 'news.id as news_id', 'news.publish_date',
                    'categories.slug as category_slug', 'news.image', 'news.image_alt', 'news.image_description')
                ->addSelect($db . '.name as author_name')
                ->selectRaw('IF(news.guest_id,"guests","reporters") as author_type')
                ->selectRaw($db . '.slug as author_slug')
                ->join($db, 'news.' . $column, '=', $db . '.id')
                ->join('news_categories', 'news_categories.news_id', '=', 'news.id')
                ->join('categories', 'categories.id', '=', 'news_categories.category_id')
                ->where($db . '.slug', '=', $author_slug)
                ->where('news.is_active', '=', 1)
                ->whereNull('news.deleted_at')
                ->orderByDesc('news_id')
                ->paginate(15);
            $advertisements = $this->adsRepository->getAllAdvertisements('category_page');;
            return view($this->viewPath . '.newsByAuthor',
                compact('newsByAuthor'))
                ->with($this->newsRepository->getDetailPageCommonData())
                ->with($advertisements);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back();
        }

    }

    public function bestThreeNews()
    {

    }


}
