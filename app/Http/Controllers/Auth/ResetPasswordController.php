<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendMail;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */


    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * UserRepositoryInterface
     *
     * @var object
     */
    private $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
        $this->middleware('guest');
    }

    /**
     * resetPassword
     *
     * @param  int $id 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resetPassword($id)
    {
        $user = $this->user->find($id);
        if (Auth::user()->can('resetPassword', $user)) {
            $password = Str::random(10);
            $message = [
                'title' => __('messages.reset_password'),
                'task' => __('messages.new_password'),
                'data' => $password
            ];
            $job = (new SendMail($message, $user->username));
            $this->dispatch($job);
            $data['password'] = Hash::make($password);
            $data['is_first_login'] = config('common.IS_FIRST_LOGIN');
            $this->user->update($data, $id);
            session()->flash('success', __('messages.reset_success'));
        } else {
            session()->flash('error',  __('messages.reset_self'));
        }

        return redirect()->route('user.index');
    }
}
