<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RequestRegister;
use App\Mail\Auth\MailOtpVerifyAccount;
use App\Service\AuthService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    protected AuthService $authService;

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
        if ($user) {
            $otp = $this->generateOTP();
            $this->authService->updateUser($user->id, [
                "otp"        => $otp,
                "updated_at" => Carbon::now()
            ]);

            $urlTemplateEmail = public_path("email_template_css.json");
            $jsonData = json_decode(file_get_contents($urlTemplateEmail), true);
            $mailData = [
                'title'  => 'Kích hoạt tài khoản',
                "source" => $jsonData['source'],
                "style"  => $jsonData['table-style'],
                "otp"    => $otp,
                "user"   => $user
            ];

            Mail::to($user->email)->queue(new MailOtpVerifyAccount($mailData));
            return redirect()->route('auth.active.account')->with("success",
                "Đăng ký thành công, kiểm tra email để kích hoạt tài khoản");
        }
        return redirect()->back();
    }

    public function alertRegister()
    {
        return view('auth.alert-register');
    }

    public function viewActiveAccount()
    {
        return view('auth.active-account');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }

    public function activeAccount(Request $request)
    {
        $otp = $request->otp;
        if (empty($otp)) {
            return response()->json([
                'status'  => 'fail',
                'message' => 'Mã OTP không được để trống',
                'code'    => null
            ]);
        }
        if (strlen($otp) != 6) {
            return response()->json([
                'status'  => 'fail',
                'message' => 'Mã OTP không đúng định dạng',
                'code'    => null
            ]);
        }

        $user = $this->authService->findByOtp($otp);
        if (empty($user)) {
            return response()->json([
                'status'  => 'fail',
                'message' => 'Mã OTP không tồn tại',
                'code'    => null
            ]);
        }
        if ($user->status != "pending") {
            return response()->json([
                'status'  => 'fail',
                'message' => 'Trạng thái tài khoản không hợp lệ',
                'code'    => 'CODE001'
            ]);
        }

        $this->authService->updateUser($user->id, [
            "status"     => "verify",
            "otp"        => null,
            "updated_at" => Carbon::now()
        ]);

        return response()->json([
            'status'  => 'success',
            'otp'     => $otp,
            'message' => 'Kích hoạt thành công, xin mời bạn đăng nhập',
        ]);
    }

    public function generateOTP()
    {
        return random_int(100000, 999999);
    }
}
