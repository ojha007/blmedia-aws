<?php

namespace Modules\Backend\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class Response implements Responsable
{
    private $viewPath;
    private $with;

    /**
     * Response constructor.
     * @param $viewPath
     * @param array $with
     */
    public function __construct($viewPath, $with = [])
    {
        $this->viewPath = $viewPath;
        $this->with = $with;
    }

    public function toResponse($request)
    {

        if ($request->wantsJson()) {
            return 404;
        }
        return view($this->viewPath)
            ->with($this->with);


    }
}
