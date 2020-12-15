<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Providers\RouteServiceProvider;
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

    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $credentials = $request->only('email', 'password');
        $remember_me = $request->has('remember') ? true : false;

        if (Auth::attempt($credentials, $remember_me)) {
            $user = auth()->user();

            Auth::login($user,true);
        }else{

            return back()->with('error','Your credentials are not correct.');

        }
    }

    /*
     * admin login
     * */
    public function showAdminLoginForm()
    {
        return view('auth.admin.login');
    }

    public function adminLogin(AdminLoginRequest $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended(RouteServiceProvider::ADMIN_HOME);
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors([
                'password' => 'You have provided a wrong password.',
            ]);
    }

    public function adminLogout(Request $request)
    {
        if (Auth::guard('admin')->check()){
            // Get the session key for this user
            $sessionKey = Auth::guard('admin')->getName();

            // Logout current user by guard
            Auth::guard('admin')->logout();

            // Delete single session key (just for this user)
            $request->session()->forget($sessionKey);
        }

        // After logout, redirect to login screen again
        return redirect()->route('admin.login');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('adminLogout');
        $this->middleware('guest')->except('logout');
    }
}
