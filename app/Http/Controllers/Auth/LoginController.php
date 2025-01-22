<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RequestLogin;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(RequestLogin $requestLogin)
    {
        $credentials = $requestLogin->except("_token");

        if (Auth::attempt($credentials)) {
            $requestLogin->session()->regenerate();
            return redirect()->to('/');
//            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
