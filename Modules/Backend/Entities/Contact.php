<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{

    use SoftDeletes;

    protected $type = 'Contacts';

    protected $fillable = [
        'name',
        'organization',
        'facebook_url',
        'twitter_url',
        'phone_number',
        'email',
        'address',
        'slug',
        'caption',
        'description',
        'image',
        'is_active',
        'designation'
    ];

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }


}
