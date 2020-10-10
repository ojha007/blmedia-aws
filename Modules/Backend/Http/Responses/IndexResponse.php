<?php

namespace Modules\Backend\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    private $viewPath;
    private $with;

    public function __construct($viewPath, $with = [])
    {
        $this->viewPath = $viewPath;
        $this->with = $with;
    }

    public function toResponse($request)
    {

        return view($this->viewPath . '.index');

    }
}
