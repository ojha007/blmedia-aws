<?php


namespace Modules\Backend\Repositories;


use App\Repositories\Repository;
use Cviebrock\EloquentTaggable\Models\Tag;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\Guest;
use Modules\Backend\Entities\News;
use Modules\Backend\Entities\Reporter;

class NewsRepository extends Repository
{
    public function __construct(News $news)
    {
        $this->model = $news;
    }

    public function getViewData()
    {
        $selectPublishStatuses = $this->selectNewsStatus();
        $selectGuests = (new ContactRepository(new Guest()))->selectContacts();
        $selectReporters = (new ContactRepository(new Reporter()))->selectContacts();
        $allTags = Tag::all()->pluck('name')->toArray();
        $selectNewsCategories = (new NewsCategoryRepository(new Category()))->selectAllCategories();
        return [
            'selectPublishStatuses' => $selectPublishStatuses,
            'selectReporters' => $selectReporters,
            'selectGuests' => $selectGuests,
            'allTags' => $allTags,
            'selectNewsCategories' => $selectNewsCategories
        ];
    }

    public function selectNewsStatus()
    {

        $publishStatuses = [];
        foreach (News::publishStatus() as $status) {
            $publishStatuses[$status] = $status;
        }
        return $publishStatuses;
    }
}
