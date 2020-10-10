<?php

namespace Modules\Backend\Http\Controllers;

use Modules\Backend\Entities\Reporter;

class ReporterController extends ContactController
{

    protected $type = 'REPORTER';

    protected $baseRoute = 'reporters';

    public function __construct(Reporter $reporter)
    {
        parent::__construct($reporter);
    }


}
