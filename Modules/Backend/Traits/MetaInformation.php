<?php


namespace Modules\Backend\Traits;


use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Backend\Exceptions\InvalidMetaTags;


trait MetaInformation
{
//    public $timestamps = false;

    /**
     * @param array $attributes
     * @return $this
     * @throws InvalidMetaTags
     */
    public function setMetaTags(array $attributes): self
    {
        if (!$this->isValidMetaTags($attributes)) {
            throw InvalidMetaTags::create();
        }

        return $this->forceSetMetaTags($attributes);
    }

    public function isValidMetaTags(array $attributes): bool
    {
        $a = array_diff_key($attributes, ['meta_title', 'meta_keywords', 'meta_description']);
        return count($a) == 0;
    }

    public function forceSetMetaTags(array $attributes): self
    {
        $this->metaTags()->create([
            'meta_title' => $attributes['meta_title'],
            'meta_keywords' => $attributes['meta_keywords'],
            'meta_description' => $attributes['meta_description'],
        ]);

        return $this;
    }

    public function metaTags(): HasOne
    {
        return $this->hasOne($this->getMetaTagsClass());
    }


    protected function getMetaTagsClass(): string
    {
        return $this->metaTagsClass;
    }


}
