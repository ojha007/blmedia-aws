<?php

namespace Modules\Backend\Entities;

use Cviebrock\EloquentTaggable\Taggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{

    use SoftDeletes, Taggable;
    use \Modules\Backend\Traits\MetaInformation;

    const PUBLISHED = 'Published';
    const UNPUBLISHED = 'Unpublished';
    const DRAFT = 'Draft';
    protected $metaTagsTable = 'news_meta_tags';
    protected $fillable = [
        'title', 'sub_title', 'guest_id', 'reporter_id', 'slug',
        'is_special',
        'is_anchor',
        'date_line', 'description', 'short_description',
        'view_count',
        'external_url',
        'video_url',
        'publish_date', 'expiry_date',
        'image_alt', 'is_active',
        'image', 'image_description',
    ];
    protected $with = ['categories'];


    public static function status()
    {
        return [
            self::PUBLISHED,
            self::UNPUBLISHED,
            self::DRAFT,
        ];
    }

    public static function publishStatus()
    {
        return ['Yes', 'No', 'Draft'];

    }

    public function reporter()
    {
        return $this->belongsTo(Reporter::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function getCategoryNameAttribute()
    {

        return $this->categories()
            ->pluck('slug')
            ->toArray();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'news_categories');
    }

    public function createdBy()
    {
        return $this->belongsTo('Modules\Auth\Entities\User', 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('Modules\Auth\Entities\User', 'updated_by');
    }


}
