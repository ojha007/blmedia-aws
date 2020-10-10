<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');

    }

    public function showLoginForm()
    {
        return view('auth::login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/');
    }


    public function redirectTo()
    {
        $editions = request()->route()->getAction('edition');
        $url = $editions ? ($editions . '/bl-secure') : '/bl-secure';
        return url($url);

    }

    protected function credentials(Request $request)
    {
        $request->validate([
            'user_name' => 'required|min:3|max:50',
            'password' => 'required|confirmed|min:6',
        ]);
        return array_merge($request->only($this->username(), 'password'));
    }

    public function username()
    {
        return 'user_name';
    }

    protected function authenticated(Request $request)
    {
        return redirect()->intended($this->redirectPath());
    }

}
