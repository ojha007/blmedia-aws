<?php


namespace Modules\Backend\Observers;


use Illuminate\Support\Facades\Auth;
use Modules\Backend\Entities\Category;

class CategoryObserver
{
    public function creating(Category $category)
    {
        $category->created_by = Auth::id();
    }

    public function updating(Category $category)
    {
        $category->updated_by = Auth::id();
    }
}
