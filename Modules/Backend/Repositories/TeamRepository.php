<?php


namespace Modules\Backend\Repositories;


use App\Repositories\Repository;
use Modules\Backend\Entities\Team;

class TeamRepository extends Repository
{
    public function __construct(Team $team)
    {
        $this->model = $team;
    }

}
