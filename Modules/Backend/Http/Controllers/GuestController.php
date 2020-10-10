<?php

namespace Modules\Backend\Http\Controllers;

use Modules\Backend\Entities\Guest;

class GuestController extends ContactController
{

    public function __construct(Guest $guest)
    {
        parent::__construct($guest);
    }
}
