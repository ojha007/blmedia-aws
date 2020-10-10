<?php


namespace Modules\Auth\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Auth\Http\Requests\ChangePasswordRequest;

class ChangePasswordController extends Controller
{

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->get('new-password'));
        $user->save();
        return redirect()->back()
            ->with('success', 'Password changed successfully');

    }
}
