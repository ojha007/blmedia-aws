<?php

$edition = null;
if (in_array(request()->segment(1), config('editions'))) {
    $edition = request()->segment(1);
}

Route::group(
    [

        'middleware' => 'web',
        'prefix' => $edition . '/bl-secure',
        'as' => (is_null($edition) ? null : $edition . '.') . 'bl-secure.',
        'edition' => $edition,
        'routePrefix' => 'bl-secure.',
        'systemName' => ucwords($edition) . '-' . 'Auth',
        'systemAbbr' => 'Bl',
        'module' => 'auth'
    ], function ($router) {
    $router->get('/', 'LoginController@showLoginForm')->name('login');
    $router->get('login', 'LoginController@showLoginForm')->name('login');
    $router->post('login', 'LoginController@login');
    $router->post('logout', 'LoginController@logout')->name('logout');

});
