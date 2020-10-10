<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'sub_title' => 'nullable|string|max:255',
            'slug' => 'nullable',
            'date_line' => 'required|string',
            'reporter_id' => 'nullable|exists:reporters,id',
            'guest_id' => 'nullable|exists:guests,id',
            'description' => 'required',
            'image_alt' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required',
            'external_url' => 'nullable',
            'publish_date' => 'required|date|date_format:Y-m-d\TH:i',
            'is_anchor' => 'required|boolean',
            'is_special' => 'required|boolean',
            'image' => 'required',
            'image_description' => 'nullable|string|max:255',
            'video_url' => 'nullable',
            'is_active' => 'required|boolean',
            'tags' => 'required'
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
