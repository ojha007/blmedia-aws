<?php

namespace Modules\Backend\Providers;

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

        View::composer('backend::*', function ($view) {
            $prefix = Request::route()->getAction('routePrefix');
            $edition = Request::route()->getAction('edition');
            $module = Request::route()->getAction('module');
            $contactTypes = [
                'reporters', 'guests'
            ];
            $view->with([
                'routePrefix' => $edition . '.' . $prefix,
                'urlPrefix' => $edition . '/bl-secure',
                'module' => $module,
                'edition' => $edition,
                'contactTypes' => $contactTypes
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
