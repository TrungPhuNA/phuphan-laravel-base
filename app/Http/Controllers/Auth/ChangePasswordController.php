<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RequestResetPassword;
use App\Http\Requests\Auth\RequestUpdatePassword;
use App\Mail\Auth\MailResetPassword;
use App\Service\AuthService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ChangePasswordController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function resetPassword()
    {
        return view('auth.reset-password');
    }

    public function changePassword($token)
    {
        $resetPassword = $this->authService->findByToken($token);
        if(empty($resetPassword)) {
            return redirect()->route("auth.reset.password")->with("danger","Mã xác nhận không chính xác hoạc đã hết hạn");
        }
        return view('auth.change-password');
    }

    public function updatePassword(RequestUpdatePassword $requestUpdatePassword, $token) {
        $resetPassword = $this->authService->findByToken($token);
        if(empty($resetPassword)) {
            return redirect()->route("auth.reset.password")->with("danger","Mã xác nhận không chính xác hoạc đã hết hạn");
        }
        $user = $this->authService->findByEmail($resetPassword->email);
        if(empty($user)) {
            return redirect()->route("auth.reset.password")->with("danger","Tài khoản không tồn tại");
        }
        $dataUpdate = [
            "password" => bcrypt($requestUpdatePassword->password),
            "updated_at" => Carbon::now()
        ];

        $userUpdate = $this->authService->updateUser($user->id, $dataUpdate);
        $this->authService->resetDataPassword($user->email);
        return redirect()->route("auth.login")->with("success","Cập nhật thành công");
    }

    public function processResetPassword(RequestResetPassword $requestResetPassword)
    {
        $email = $requestResetPassword->email;
        $user = $this->authService->findByEmail($email);
        if (empty($user)) {
            return redirect()->back()->with("danger", "Email không tồn tại");
        }

        $uuid = (string) Str::uuid();
        $resetPassword = $this->authService->createResetPassword([
            "email"      => $email,
            "token"      => $uuid,
            "created_at" => Carbon::now()
        ]);
        if (!$resetPassword) {
            return redirect()->back()->with("danger", "Có lỗi xẩy ra, xin vui lòng thử lại");
        }

        $urlTemplateEmail = public_path("email_template_css.json");
        $jsonData = json_decode(file_get_contents($urlTemplateEmail), true);
        $link = route("auth.change.password", $uuid);
        $mailData = [
            'title'         => 'Đặt lại mật khẩu / Reset password',
            'resetPassword' => $resetPassword,
            "source"        => $jsonData['source'],
            "style"         => $jsonData['table-style'],
            "link"          => $link
        ];
        Mail::to($email)->queue(new MailResetPassword($mailData));
        return redirect()->back()->with("success", "Link cập nhật mật khẩu mới đã gủi vào email của bạn");
    }
}
