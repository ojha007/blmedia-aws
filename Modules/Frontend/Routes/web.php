<?php

$edition = null;
if (in_array(request()->segment(1), config('editions'))) {
    $edition = request()->segment(1);
}
Route::group(
    [
        'middleware' => 'web',
        'prefix' => $edition,
        'as' => is_null($edition) ? null : $edition . '.',
        'edition' => $edition,
        'module' => 'frontend'], function ($router) use ($edition) {
    include __DIR__ . '/subRoutes/newsCategory.php';
    include __DIR__ . '/subRoutes/news.php';
    $router->get('/', 'FrontendController@index')->name($edition);
    $router->get('/', 'FrontendController@index')->name('index');
    $router->get('/videos', 'FrontendController@videos')->name('videos');
    $router->get('/preeti-to-unicode', 'FrontendController@preetiToUniCode')->name('preeti-to-unicode');
    $router->get('/roman-to-unicode', 'FrontendController@romanToUnicode')->name('roman-to-unicode');
    $router->get('/unicode-to-preeti', 'FrontendController@unicodeToPreeti')->name('unicode-to-preeti');
});

