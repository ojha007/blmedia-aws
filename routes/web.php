<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'FrontendController@index')->name('index');
foreach (config('editions') as $edition) {
    Route::get($edition, 'FrontendController@index')->name($edition);
}

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::get('nepali/c-w-l', function () {


    $start = microtime(TRUE);
    $news = \Illuminate\Support\Facades\DB::table('news')
        ->select('id', 'image')
        ->where('image', 'like', '%https://www.breaknlinks.com/nepali/uploads/Magh%')
        ->orderByDesc('id')
        ->get();
    foreach ($news as $n) {
        $url = $n->image;
        if ($url) {
            if (\Illuminate\Support\Str::contains($url, 'https://www.breaknlinks.com/nepali/uploads/Magh')) {
                $a = str_replace('https://www.breaknlinks.com', 'https://breaknlinks.s3.amazonaws.com', $url);
                \Illuminate\Support\Facades\DB::table('news')
                    ->where('id', $n->id)
                    ->update([
                        'image' => $a
                    ]);
                echo $n->id . '<br>' . $a . '<br>';

            }
        }
    }
    $end = microtime(TRUE);
    echo "The code took " . ($end - $start) . " seconds to complete.";


});
