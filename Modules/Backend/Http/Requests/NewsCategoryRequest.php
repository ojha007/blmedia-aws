<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $id = $this->route()->parameter('category');
        return [
            'name' => 'required|unique:categories,name,' . $id,
            'slug' => 'required|unique:categories,slug,' . $id,
            'parent_id' => 'nullable|exists:categories,id',
            'position' => 'array',
            'position.front_header_position' => 'nullable|numeric',
            'position.front_body_position' => 'nullable|numeric',
            'position.detail_body_position' => 'nullable|numeric',
            'position.detail_header_position' => 'nullable|numeric',
            'metaTags' => 'array',
            'metaTags.meta_title' => 'nullable',
            'metaTags.meta_keywords' => 'nullable',
            'metaTags.meta_description' => 'nullable',
            'in_mobile' => 'required|boolean',
            'is_active' => 'required|boolean',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
