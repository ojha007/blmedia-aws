<?php


namespace Modules\Backend\Http\Controllers;


use App\Http\Controllers\Controller;
use UniSharp\LaravelFilemanager\Controllers\LfmController;

class FileManagerController extends Controller
{

    protected $viewPath = 'backend::file-manager.';

    public function index()
    {
        return view($this->viewPath . 'index');
    }


    public function store($file)
    {

        $image = $file->store('images', 's3');
    }
}
