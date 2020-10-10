<?php


namespace Modules\Backend\Observers;


use Illuminate\Support\Facades\Auth;
use Modules\Backend\Entities\News;

class NewsObserver
{
    public function creating(News $news)
    {
        $news->created_by = Auth::id();
    }

    public function updating(News $news)
    {
        $news->updated_by = Auth::id();
    }
}
