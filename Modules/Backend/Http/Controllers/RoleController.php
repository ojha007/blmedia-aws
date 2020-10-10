<?php

namespace Modules\Backend\Http\Controllers;


use Spatie\Permission\Models\Role;

class RoleController extends \Modules\Auth\Http\Controllers\RoleController
{

    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}
