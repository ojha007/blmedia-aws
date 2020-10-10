<?php


namespace Modules\Backend\Providers;

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;
use Illuminate\Support\ServiceProvider;

class ResourceBreadCrumbsServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->breadCrumbsMacros();
    }

    protected function breadCrumbsMacros()
    {
        Breadcrumbs::macro('resource', function ($name, $title) {
            Breadcrumbs::for("$name.index", function ($trail, $routePrefix) use ($name, $title) {
                $trail->parent('dashboard', $routePrefix);
                $trail->push($title, route("$routePrefix$name.index"));
            });
            Breadcrumbs::for("$name.create", function ($trail, $routePrefix) use ($name, $title) {
                $trail->parent("$name.index", $routePrefix);
                $trail->push('Create', route("$routePrefix$name.create"));

            });
            Breadcrumbs::for("$name.show", function ($trail, $model, $routePrefix) use ($name) {
                $trail->parent("$name.index", $routePrefix);
                $trail->push('Show', route("$routePrefix$name.show", $model));
            });
            Breadcrumbs::for("$name.edit", function ($trail, $model, $routePrefix) use ($name) {
                $trail->parent("$name.index", $routePrefix);
                $trail->push('Edit', route("$routePrefix$name.edit", $model));

            });
        });

    }

    public function register()
    {

    }
}
