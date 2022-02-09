<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function checkLogin(LoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            if (Auth::user()->is_first_login == config('common.IS_FIRST_LOGIN')) {
                return redirect()->route('change-password');
            } else {
                if (Auth::user()->role->id == config('common.IS_MEMBER') && Auth::user()->is_admin != config('common.IS_ADMIN')) {
                    return redirect()->route('profile');
                } else {
                    return redirect()->route('user.index');
                }
            }
        } else {
            session()->flash('error', __('messages.login_error'));
            return redirect()->route('login');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
