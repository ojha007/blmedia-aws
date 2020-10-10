<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerSystemConfiguration();
    }

    public function registerSystemConfiguration()
    {

        View::composer('auth::*', function ($view) {
            $prefix = Request::route()->getAction('routePrefix');
            $edition = Request::route()->getAction('edition');
            $module = Request::route()->getAction('module');
            $view->with([
                'routePrefix' => ($edition ? $edition . '.' : null) . $prefix,
                'urlPrefix' => $edition . '/' . $prefix,
                'module' => $module,
            ]);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}
