<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function credentials(Request $request)
    {
        $request['active'] = 1;

        return $request->only($this->username(), 'password', 'active');
    }

    public function showLoginForm()
    {
        return view('adminAuth.login');
    }

    public function username()
    {
        return 'email';
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    // public function login(Request $request)
    // {
    //     $this->validateLogin($request);


    //     if (Auth::guard('admin')->attempt(
    //         ['email' => $request->email, 'password' => $request->password],
    //         $request->remember
    //     )) {

    //         return redirect()->intended(route('admin.home'));
    //     }

    //     return $this->sendFailedLoginResponse($request);
    // }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect(route('admin.login'));
    }
}
