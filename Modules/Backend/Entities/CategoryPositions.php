<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryPositions extends Model
{
    const FRONT_BODY_POSITION = 'front_body_position';
    const DETAIL_BODY_POSITION = 'detail_body_position';
    const FRONT_HEADER_POSITION = 'front_header_position';
    const DETAIL_HEADER_POSITION = 'detail_header_position';
    public $timestamps = false;
    protected $table = 'category_positions';
    protected $fillable = ['front_header_position', 'front_body_position', 'detail_header_position', 'detail_body_position'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
