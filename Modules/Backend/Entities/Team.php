<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'title', 'designation', 'image', 'email', 'detail', 'is_active'
    ];
}
