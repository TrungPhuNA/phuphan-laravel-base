<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use App\Mail\Auth\MailOtpVerifyAccount;
use App\Mail\Test\MailTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminSettingEmailController extends Controller
{
    public function index()
    {
        return view('admin.setting.setting_email');
    }

    public function sendEmailTest(Request $request)
    {
        $urlTemplateEmail = public_path("email_template_css.json");
        $jsonData = json_decode(file_get_contents($urlTemplateEmail), true);

        $mailData = [
            'title'    => 'Email test',
            'email'    => $request->email,
            "source"   => $jsonData['source'],
            "style"    => $jsonData['table-style'],
            "contents" => $request->contents,
        ];

        Mail::to($request->email)->queue(new MailTest($mailData));

        return redirect()->back()->with("success","Send email success");
    }
}
