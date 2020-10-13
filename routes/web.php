<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


Route::get('/', 'FrontendController@index')->name('index');
foreach (config('editions') as $edition) {
    Route::get($edition, 'FrontendController@index')->name($edition);
}

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::get('nepali/c-w-l', function () {

    try {
        $start = microtime(TRUE);

        $news = \Modules\Backend\Entities\News::
        where('image', 'like', '% www.breaknlinks.com/nepali')
            ->get();
//        dd($news);
        foreach ($news as $n) {
            $url = $n->image;
            if ($url) {
                if (\Illuminate\Support\Str::contains($url, 'https://breaknlinks.s3.amazonaws.com')) {
                    echo $url . '<br>';
                } else {
                    $url = 'https://www.breaknlinks.com/hindi/uploads/guest/' . $url;
                    $handle = @fopen($url, 'r');
                    if ($handle) {
                        $contents = file_get_contents($url);
                        if (\Illuminate\Support\Str::contains($url, 'https://www.breaknlinks.com')) {
                            $fileName = ltrim($url, "https://www.breaknlinks.com/hindi");
                        } else {
                            $fileName = '/uploads/guests/' . $n->image;
                        }
                        Storage::disk('hindi')->put($fileName, $contents, 'public');
                        $a = Storage::disk('hindi')->url($fileName);
                        $n->update([
                            'image' => $a
                        ]);
                        echo $n->image . '-' . $n->id . '<br><br>';
                    }

                }
            }
        }
        $end = microtime(TRUE);
        echo "The code took " . ($end - $start) . " seconds to complete.";

    } catch (Exception $exception) {
        \Illuminate\Support\Facades\Log::error($exception->getMessage());
        dd($exception);
    }

});


Route::get('hindi/c-w-l', function () {

    try {
        $start = microtime(TRUE);

        $news = \Modules\Backend\Entities\News::
        with('categories')
            ->where('id', '<', 1294)
            ->orderByDesc('id')
            ->get();
        foreach ($news as $n) {
            $url = $n->image;
            if ($url) {
                $handle = @fopen($url, 'r');
                if ($handle) {
                    $contents = file_get_contents($url);
                    if (!\Illuminate\Support\Str::contains($url, 'https://breaknlinks.s3.amazonaws.com/hindi')) {
                        if (\Illuminate\Support\Str::contains($url, 'https://www.breaknlinks.com')) {
                            $a = str_replace('%2520', '-', ltrim($url, "https://www.breaknlinks.com/hindi"));
                            $b = str_replace('%20', '-', $a);
                            $fileName = str_replace('%20%', '-', $b);
                        } else {
                            $a = str_replace('%2520', '-', $url);
                            $b = str_replace('%20', '-', $a);
                            $fileName = substr($b, strrpos($b, '/') + 1);
                        }
                        Storage::disk('hindi')->put($fileName, $contents, 'public');
                        $a = Storage::disk('hindi')->url($fileName);

                        $n->update([
                            'image' => $a
                        ]);
                        echo $n->image . '-' . $n->id . '<br><br>';
                    }
                }

            }
        }
        $end = microtime(TRUE);
        echo "The code took " . ($end - $start) . " seconds to complete.";

    } catch (Exception $exception) {
        \Illuminate\Support\Facades\Log::error($exception->getMessage());
        dd($exception);
    }

});


Route::get('nepali/c-w-l', function () {

    try {
        $start = microtime(TRUE);

        $news = \Modules\Backend\Entities\News::
        all();
        foreach ($news as $n) {
            $url = $n->image;
            if ($url) {
                $handle = @fopen($url, 'r');
                if ($handle) {
                    $contents = file_get_contents($url);
                    if (!\Illuminate\Support\Str::contains($url, 'https://breaknlinks.s3.amazonaws.com/nepali')) {
                        if (\Illuminate\Support\Str::contains($url, 'https://www.breaknlinks.com')) {
                            $a = str_replace('%2520', '-', ltrim($url, "https://www.breaknlinks.com/nepali"));
                            $fileName = str_replace('%20', '-', $a);
                            Storage::disk('nepali')->put($fileName, $contents, 'public');
                            $d = Storage::disk('nepali')->url($fileName);
//                            dd($d);
                            $n->update([
                                'image' => $d
                            ]);
                            echo $n->image . '-' . $n->id . '<br><br>';
                        } else {
                            $n->name;
                        }

                    }
                }

            }
        }
        $end = microtime(TRUE);
        echo "The code took " . ($end - $start) . " seconds to complete.";

    } catch (Exception $exception) {
        \Illuminate\Support\Facades\Log::error($exception->getMessage());
        dd($exception);
    }

});

Route::get('en/c-w-l-a', function () {

    try {
        $start = microtime(TRUE);
        $news = \Modules\Backend\Entities\Reporter::all();
        foreach ($news as $n) {
            if ($n->image) {
                $url = 'https://www.breaknlinks.com/uploads/reporter/' . $n->image;
                $handle = @fopen($url, 'r');
                if ($handle) {
                    $contents = file_get_contents($url);
                    $fileName = 'uploads/reporters/' . $n->image;
                    Storage::disk('en')->put($fileName, $contents, 'public');
                    $a = Storage::disk('en')->url($fileName);
                    $n->update([
                        'image' => $a
                    ]);
                }
                echo $n->image . '----' . $n->id . '<Br><Br>';
            }

        }
        $end = microtime(TRUE);
        echo "The code took " . ($end - $start) . " seconds to complete.";

    } catch (Exception $exception) {
        \Illuminate\Support\Facades\Log::error($exception->getMessage());
        dd($exception);
    }

});
