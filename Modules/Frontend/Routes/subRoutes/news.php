<?php
Route::get('news/author/{author_type}/{author}', 'NewsController@showNewsByAuthor')->name('news.showNewsByAuthor');
Route::get('news/{news}', 'NewsController@showNews')->name('news.show');
Route::get('/author/{author_type}/{author_slug}', 'NewsController@newsByAuthor')
    ->name('news.by.author');
