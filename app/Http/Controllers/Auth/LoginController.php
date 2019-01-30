<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Admin;

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
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        $loginAdmin = $this->prosesLogin($request);
        if($loginAdmin !== false){

            return $loginAdmin;
            
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated(Request $request, $user)
    {
        if($this->guard('admin')->user()) {
            $lastSignIn = Admin::where('id', $user->id)->update(['last_sign_in' => date('Y-m-d H:i:s')]);
            return redirect('admin/dashboard');
        }
    }

    protected function sendLoginResponse(Request $request, $guard='admin')
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard($guard)->user())
                ?: redirect()->intended($this->redirectPath());
    }

    public function prosesLogin($request, $guard='admin')
    {
        $credentials = $this->credentials($request);
        if (Auth::guard($guard)->attempt($credentials)) {
            return $this->sendLoginResponse($request,$guard);
        }
        return false;
    }
    
    /**
     *
     * @return property guard use for login
     *
     */
    public function guard($guard = 'admin')
    {
        return Auth::guard($guard);
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}
