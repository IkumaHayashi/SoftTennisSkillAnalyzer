<?php

namespace App\Http\Controllers\Auth;

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

    /**
     * SPA対応のためログイン時にredirectするのではなくUserオブジェクトを返す
     *
     * @param Request $request
     * @param \App\User $user
     * @return \App\User
     */
    protected function authenticated(Request $request, \App\User $user) : \App\User
    {
        return $user;
    }

    /**
     * SPA対応のためログアウト時にredirectするのではなく
     * セッションを作り直してレスポンスを返す
     *
     * @param Request $request
     * @return void
     */
    protected function loggedOut(Request $request)
    {
        // セッションを再生成する
        $request->session()->regenerate();

        return response()->json();
    }
}
