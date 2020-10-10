<?php


namespace Modules\Backend\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Backend\Entities\Category;
use Modules\Backend\Entities\News;
use Modules\Backend\Observers\CategoryObserver;
use Modules\Backend\Observers\NewsObserver;

class ObserverServiceProvider extends ServiceProvider
{


    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        News::observe(NewsObserver::class);
        Category::observe(CategoryObserver::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
