<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

$edition = null;
if (in_array(request()->segment(1), config('editions'))) {
    $edition = request()->segment(1);
}
if (is_null($edition)) {
    $edition = 'nepali';
}
//dd($edition);
Breadcrumbs::for('dashboard', function ($trail) use ($edition) {
    $trail->push('Dashboard', route($edition . '.bl-secure.dashboard'));
});
Breadcrumbs::for('settings.index', function ($trail, $setting, $routePrefix) use ($edition) {
    $trail->parent('dashboard', route($edition . '.bl-secure.'));
    $trail->push('Setting', route($routePrefix . "settings.index", $setting));
});
Breadcrumbs::for('profile', function ($trail, $routePrefix) {
    $trail->parent('dashboard', $routePrefix);
    $trail->push('User Profile', route($routePrefix . 'profile'));
});

Breadcrumbs::resource('news', 'News');
Breadcrumbs::resource('reporters', 'Reporters');
Breadcrumbs::resource('guests', 'Guests');
Breadcrumbs::resource('users', 'Users');
Breadcrumbs::resource('advertisements', 'Advertisements');
Breadcrumbs::resource('team', 'Team');
Breadcrumbs::resource('roles', 'Roles');



