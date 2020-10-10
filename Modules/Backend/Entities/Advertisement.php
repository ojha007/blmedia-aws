<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{


    protected $fillable = ['title', 'image', 'url', 'for',
        'sub_for', 'placement', 'is_active',
        'sub_placement', 'description',
        'sub_description'];


}
