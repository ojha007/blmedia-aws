<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->parameter('advertisement');
//        dd($id);
        return [
            'title' => 'required|max:255|unique:advertisements,title,'.$id,
            'image' => 'required',
            'url' => 'required',
            'placement' => 'nullable',
            'for' => 'required_if:is_active,==,1',
            'sub_for' => 'required_with:for',
            'description' => 'nullable',
            'sub_description' => 'nullable|max:255',
            'is_active' => 'required|boolean',
            'sub_placement' => 'nullable',
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
