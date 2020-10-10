<?php

namespace Modules\Auth\Repositories;


use App\Repositories\Repository;
use Spatie\Permission\Models\Role;

class RoleRepository extends Repository
{

    protected $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

}
