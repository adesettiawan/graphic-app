<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        $this->middleware('guest')->except('logout');
    }

    public function login_show_page()
    {
        return view('auth.login');
    }

    public function login_processed(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Maaf email tidak boleh kosong!',
            'password.required' => 'Maaf password tidak boleh kosong!',
            'password.min' => 'Maaf password minimal 8 karakter!',
        ]);

        $credentials = $request->only('email', 'password');
        $request->session()->regenerate();
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard');
        }

        return redirect()->route('login')->with('message', 'Email atau Password yang anda masukan salah!.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Logout successfully!');;
    }
}
