<?php

namespace Modules\Auth\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->user;
        return [
            'user_name' => 'required|max:255|unique:users,user_name,'.$id,
            'email' => 'required|email|max:255|unique:users,email,'.$id,
            'role' => 'required|exists:roles,name'
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
