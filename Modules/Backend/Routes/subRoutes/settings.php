<?php
Route::group(['prefix' => 'settings', 'as' => 'settings.'], function ($setting) {
    $setting->get('{setting}', 'SettingController@index')->name('index');
    $setting->post('/', 'SettingController@store')->name('store');
});

