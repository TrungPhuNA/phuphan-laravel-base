<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RequestRegister;
use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function index()
    {
        return view('auth.register');
    }

    /**
     * @param  RequestRegister  $requestLogin
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RequestRegister $requestLogin)
    {
        $data = $requestLogin->all();
        $user = $this->authService->register($data);
        if($user) {
            return redirect()->route('auth.alert.register');
        }
        return redirect()->back();
    }

    public function resetPassword()
    {
        return view('auth.reset-password');
    }

    public function alertRegister()
    {
        return view('auth.alert-register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }
}
