<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Backend\Traits\MetaInformation;

class Category extends Model
{

    use MetaInformation, SoftDeletes;

    const HM = 'HM';
    const OT = 'OT';
    const LS = 'LS';
    const PRIMARY_MENU = 'Primary Menu';
    const SUB_CATEGORY = 'Sub Category';
    const OTHER = 'Other';
    protected $metaTagsTable = 'category_meta_tags';
    protected $metaTagsClass = CategoryMetaTags::class;
    protected $categoryPositionsTable = 'category_positions';
    protected $categoryPositionsClass = CategoryPositions::class;
    protected $fillable = ['name', 'slug', 'is_active', 'in_mobile', 'parent_id', 'is_video', 'new_design'];
    protected $with = ['metaTags', 'position'];

    public static function selectCategoryCode()
    {
        return [
            self::HM => self::PRIMARY_MENU,
            self::OT => self::SUB_CATEGORY,
            self::LS => self::OTHER
        ];
    }

    public function news()
    {
        return $this->belongsToMany(News::class);
    }

    public function position()
    {
        return $this->hasOne(CategoryPositions::class);
    }

    public function childCategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


}
