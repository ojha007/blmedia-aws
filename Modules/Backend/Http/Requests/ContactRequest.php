<?php

namespace Modules\Backend\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class  ContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $table = $this->request->get('t') == 'Reporters' ? 'reporters' : 'guests';
        $id = $this->id;
        return [
            'name' => 'required|unique:' . $table . ',name,' . $id,
            'slug' => 'required|string|max:255',
            'designation' => 'nullable',
            'organization' => 'nullable',
            'address' => 'nullable',
            'facebook_url' => 'nullable',
            'twitter_url' => 'nullable',
            'phone_number' => 'nullable',
            'email' => 'nullable|email',
            'caption' => 'nullable',
            'image' => 'nullable',
            'description' => 'nullable|max:255',
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
