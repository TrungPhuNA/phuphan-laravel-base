<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>123code.net Email</title>
    <link href="https://fonts.googleapis.com/css2?family={{ $source['common']['font_family'] }}&display=swap"
          rel="stylesheet">
    <style>
        /* phiên bản này đang dùng bản style ở biến "table-style" */
        {{ $style }}
    </style>
</head>
<body style="font-family: {{ $source['common']['font_family']}}, sans-serif;">
<table class="container" cellpadding="0" cellspacing="0" width="100%">
    <!-- Header -->
{{--    <tr>--}}
{{--        <td class="header">--}}
{{--            <img src="{{ $source['common']['img_banner'] }}" alt="123code.net"/>--}}
{{--        </td>--}}
{{--    </tr>--}}
    <!-- Content -->
    <tr>
        <td class="content">
            <!--start:Thông tin dạng text -->
            <div class="content-container">
                <div class="content-title">
                    <h2 class="title">
                        Dear {{ $resetPassword->email }}
                    </h2>
                </div>
                <div class="content-email">
                    <p>Xin vui lòng click vào link này để cập nhật mật khẩu mới {{ $link }}</p>
                    <p>Nếu Quý khách gặp bất kỳ vấn đề nào trong quá trình truy cập hoặc cần hỗ trợ thêm, vui lòng liên
                        hệ với chúng tôi.</p>
                </div>
                <div class="divider-content"></div>
                <div>
                    <p>Trân trọng,</p>
                    <p>Đội ngũ 123code.net</p>
                </div>
            </div>
            <!--end:Thông tin dạng text -->
        </td>
    </tr>
    <!-- Footer -->
    <tr>
        <td class="footer">
            <div style="width: 100%">
                <img style="width: 120px;max-width: 100%" src="{{ $source['common']['img_logo'] }}" alt="Logo" class="email__logo">
            </div>
            <p>Trung tâm hỗ trợ Đối tác 123code.net</p>
            <p class="support-footer">
                <img src="{{ $source['common']['email_support_img']}}" alt="Logo_phone" class="logo-support">
                <a class="text-oneat"
                   href="mailto:{{ $source['common']['email_support_content']}}">{{ $source['common']['email_support_content']}}</a>
            </p>
            <p class="support-footer">
                <img src="{{ $source['common']['phone_support_img']}}" alt="Logo_phone" class="logo-support">
                <a class="text-oneat"
                   href="tel:{{ $source['common']['phone_support_content']}}"> {{ $source['common']['phone_support_content']}} </a>
            </p>
        </td>
    </tr>
</table>
</body>
</html>
