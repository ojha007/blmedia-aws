<?php


namespace Modules\Auth\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
{

    public function rules()
    {
        return [
            'current-password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'new-password' => 'required|string|min:6|confirmed',
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

    protected function getRedirectUrl()
    {
        $url = $this->redirector->getUrlGenerator();
        return $url->previous() . '#change-password';
    }
}
