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
            DB::table('news')
                ->where('id', $slug)
                ->increment('view_count', 100);
            $news = $this->getNews($slug);
            if ($news->is_active == 0) {
                return redirect()->back();
            }
            $tags = DB::table('tags')
                ->select('name')
                ->join('taggables', 'taggables.tag_id', '=', 'tags.tag_id')
                ->join('news', 'news.id', 'taggables.taggable_id')
                ->where('news.id', $slug)
                ->get();
            $category_slug = $news->category_slug;
            $advertisements = $this->adsRepository->getAllAdvertisements('detail_page');
            if (!$category_slug) {
                $category_slug = $this->newsRepository->getCategoryDoesntExitsInDetailPage();
            }
            $sameCategoryNews = $this->categoryRepository->getSimilarNewsByCategorySlug($category_slug, $news->news_slug, 9);
            return view($this->viewPath . '.newsDetail',
                compact('news', 'sameCategoryNews'))
                ->with($this->newsRepository->getDetailPageCommonData())
                ->with('news_tags', $tags)
                ->with($advertisements);

        } catch (\Exception $exception) {
            Log::error($exception->getMessage() . '-' . $exception->getTraceAsString());
            return redirect()->back();
        }

    }

    protected function getNews($id)
    {

//        DB::table('news')
//            ->increment('view_count', 100);
        return News::with('tags')
            ->without('categories')
            ->select(
                'news.title',
                'news.sub_title',
                'news.short_description',
                'news.description',
                'reporters.name as reporter_name',
                'guests.name as guest_name',
                'reporters.image as reporter_image',
                'guests.slug as guest_slug',
                'guests.image as guest_image',
                'reporters.slug as reporter_slug',
                'news.image_description',
                'news.external_url',
                'news.video_url',
                'news.date_line',
                'news.is_active',
                'news.publish_date',
                'news.id as news_slug',
                'categories.is_video',
                'news.image',
                'news.image_description',
                'news.image_alt',
                'categories.name as categories',
                'categories.slug as category_slug',
                'categories.is_video'
            )
            ->join('news_categories', 'news_categories.news_id', '=', 'news.id')
            ->join('categories', 'categories.id', '=', 'news_categories.category_id')
            ->leftJoin('guests', 'news.guest_id', '=', 'guests.id')
            ->leftJoin('reporters', 'news.reporter_id', '=', 'reporters.id')
            ->where('news.is_active', true)
            ->whereNull('news.deleted_at')
            ->where('news.id', $id)
            ->first();

    }


    public function newsByAuthor($author_type, $author_slug)
    {
        try {
            $db = $author_type == 'reporter' ? 'reporters' : 'guests';
            $col = $author_type == 'reporter' ? 'reporter' : 'guest';
            $nullFiled = $author_type == 'reporter' ? 'guest' : 'reporter';
            $column = $db == 'reporters' ? 'reporter_id' : 'guest_id';
            $newsByAuthor = DB::table('news')
                ->select('news.title',
                    'news.sub_title',
                    'news.short_description',
                    'categories.name as categories',
                    'news.id as news_slug',
                    'news.id as news_id',
                    'news.publish_date',
                    'categories.slug as category_slug',
                    'news.image',
                    'news.date_line',
                    'news.image_alt',
                    'news.image_description')
                ->selectRaw('(SELECT distinct (news.id))')
                ->addSelect($db . '.name as ' . $col . '_name')
                ->addSelect($db . '.slug as ' . $col . '_slug')
                ->addSelect($db . '.image as ' . $col . '_image')
                ->selectRaw('Null as ' . $nullFiled . '_name')
                ->selectRaw('Null as ' . $nullFiled . '_slug')
                ->selectRaw('Null as ' . $nullFiled . '_image')
                ->join($db, 'news.' . $column, '=', $db . '.id')
                ->join('news_categories', 'news_categories.news_id', '=', 'news.id')
                ->join('categories', 'categories.id', '=', 'news_categories.category_id')
                ->where($db . '.slug', '=', $author_slug)
                ->where('news.is_active', '=', 1)
                ->whereNull('news.deleted_at')
                ->orderByDesc('news.publish_date')
                ->paginate(30);
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
