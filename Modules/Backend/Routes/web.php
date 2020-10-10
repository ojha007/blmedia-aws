<?php

use Illuminate\Support\Facades\Artisan;

$edition = null;
if (in_array(request()->segment(1), config('editions'))) {
    $edition = request()->segment(1);
}
Route::group(
    [
        'middleware' => 'auth',
        'prefix' => $edition . '/bl-secure',
        'as' => $edition . '.bl-secure.',
        'edition' => $edition,
        'routePrefix' => 'bl-secure.',
        'systemName' => ucwords($edition) . '-' . 'Backend',
        'systemAbbr' => 'Bl',
        'module' => 'backend'], function ($router) use ($edition) {
    $router->get('/', 'BackendController@index')->name('dashboard');
    $router->get('/file-manager', 'FileManagerController@index')->name('file-manager.index');
    $router->get('file-manager/jsonitems', 'FileManagerController@getItems');
    $router->get('file-manager/errors', 'FileManagerController@getItems');
    $router->get('file-manager/folders', [
        'uses' => 'FileManagerController@getFolders',
    ]);
    include __DIR__ . '/subRoutes/newsCategory.php';
    include __DIR__ . '/subRoutes/news.php';
    include __DIR__ . '/subRoutes/team.php';
    include __DIR__ . '/subRoutes/contact.php';
    include __DIR__ . '/subRoutes/advertisement.php';
    include __DIR__ . '/subRoutes/settings.php';
    include __DIR__ . '/subRoutes/users.php';
    $router->resource('/roles', 'RoleController');
    $router->get('profile', 'UserController@profile')->name('profile');
    $router->post('profile', 'UserController@updateAvatar')->name('profile.avatar');
    $router->match(['put', 'patch'], 'profile/{user}', 'UserController@updateProfile')->name('profile.update');
    Route::post('password/change', 'ChangePasswordController@changePassword')->name('changePassword');
    $router->get('/cache', function () {
        Artisan::call('cache:clear');
        Artisan::call('permission:cache-reset');
        return redirect()->back()
            ->with('success', 'All Cache are removed please refresh the main page ');
    })->name('cache.remove');
//    $router->get('/pop-up/{image}', 'ElfinderController@showPopup')->name('banner-image-popup');

});

Route::get('logs', function () {
    $controller = new \Rap2hpoutre\LaravelLogViewer\LogViewerController();
    return $controller->index();
});

