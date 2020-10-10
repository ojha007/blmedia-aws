<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetaInformation extends Model
{
    protected $fillable = [
        'meta_title', 'meta_keyword', 'meta_description'
    ];

    public function model(): BelongsTo
    {
        return $this->belongsTo(Model::class);
    }


}
