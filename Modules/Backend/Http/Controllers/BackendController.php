<?php

namespace Modules\Backend\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Backend\Entities\Advertisement;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\Guest;
use Modules\Backend\Entities\News;
use Modules\Backend\Entities\Reporter;

class BackendController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $attributes = [
            [
                'title' => 'Total Publish News',
                'fa' => 'newspaper-o',
                'bg' => 'green',
                'count' => $this->newsCount()
            ],
            [
                'title' => 'Active Guests',
                'fa' => 'users',
                'bg' => 'yellow',
                'count' => $this->guestsCount()
            ],
            [
                'title' => 'Active Reporters',
                'fa' => 'users',
                'bg' => 'yellow',
                'count' => $this->reportersCounts()
            ],
            [
                'title' => 'Total Category',
                'fa' => 'list-alt',
                'bg' => 'aqua',
                'count' => $this->categoryCount()
            ],
            [
                'title' => 'Total Ads',
                'fa' => 'ad',
                'bg' => 'aqua',
                'count' => $this->adsCounts()
            ],
            [
                'title' => 'Total News Today',
                'fa' => 'trending',
                'bg' => 'aqua',
                'count' => $this->todayNews()
            ],
        ];

        return view('backend::index', compact('attributes'));
    }

    protected function newsCount()
    {
        return News::where('is_active', true)->count();
    }

    protected function guestsCount()
    {
        return Guest::where('is_active', 1)->count();
    }

    protected function reportersCounts()
    {
        return Reporter::where('is_active', 1)->count();
    }

    protected function categoryCount()
    {
        return Category::where('is_active', 1)->count();
    }

    protected function adsCounts()
    {
        return Advertisement::where('is_active', 1)->count();
    }

    protected function todayNews()
    {
//        dd(now()->addHours(23)->timezone(config('app.timeZone')));
        return News::where('publish_date', '>=', now()->addHours(23)->timezone(config('app.timeZone')))
            ->where('publish_date', '<', now()->timezone(config('app.timeZone')))
            ->count();
    }

}
