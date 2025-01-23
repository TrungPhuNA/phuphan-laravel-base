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
            $user = Auth::user();
            if($user->status !== "verify") {
                return redirect()->back()->with("danger","Trạng thái tài khoản không hợp lệ");
            }
            $requestLogin->session()->regenerate();
            return redirect()->to('/');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
