<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('icon-48x48.png') }}" />

    <link rel="canonical" href="https://demo.adminkit.io/pages-reset-password.html" />

    <title>Active account | {{ config('setting.prefix_title') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Choose your prefered color scheme -->
    <!-- <link href="css/light.css" rel="stylesheet"> -->
    <!-- <link href="css/dark.css" rel="stylesheet"> -->

    <!-- BEGIN SETTINGS -->
    <!-- Remove this after purchasing -->
    <link class="js-stylesheet" href="/static/light.css" rel="stylesheet">
    <script src="/static/settings.js"></script>
    <style>
        body {
            opacity: 0;
        }
        .otp-inputs input {
            width: 48px;
            height: 48px;
            text-align: center;
            font-size: 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.2s;
        }

        .otp-inputs input:focus {
            border-color: #007bff;
        }
    </style>
</head>
<!--
  HOW TO USE:
  data-theme: default (default), dark, light, colored
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-layout: default (default), compact
-->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<main class="d-flex w-100 h-100">
    <div class="container d-flex flex-column">
        <div class="row vh-100">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Kích hoạt tài khoản</h1>
                        <p class="lead">
                            Nhập mã xác thực gồm 6 chữ số đã được gửi vào email đăng ký của bạn
                        </p>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form id="otp-form" action="" method="POST" class="needs-validation" novalidate autocomplete="off">
                                    @csrf
                                    <div class="otp-inputs text-center">
                                        <input type="text" maxlength="1" required>
                                        <input type="text" maxlength="1" required>
                                        <input type="text" maxlength="1" required>
                                        <input type="text" maxlength="1" required>
                                        <input type="text" maxlength="1" required>
                                        <input type="text" maxlength="1" required>
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button type="submit" class='btn btn-lg btn-primary'>Xác nhận</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        Bạn chưa có tài khoản? <a href='{{ route("auth.register") }}'>Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="/static/app.js"></script>
</body>
@if(session('success') || session('danger'))
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            window.notyf.open({
                type: "{{ session('success') ? 'success' : 'danger' }}",
                message: "{{ session('success') ?? session('danger') }}",
                duration: 10000,
                ripple: true,
                dismissible: false,
                position: {
                    x: "right",
                    y: "bottom"
                }
            });
        });
    </script>
@endif
<script>

    document.addEventListener("DOMContentLoaded", function () {
        var forms = document.querySelectorAll('.needs-validation');

        forms.forEach(function (form) {
            form.addEventListener('submit', function (event) {
                var passwordField = form.querySelector('[name="password"]');
                var rePasswordField = form.querySelector('[name="re_password"]');
                var password = passwordField.value;
                var rePassword = rePasswordField.value;
                console.log("password",password)
                console.log("rePassword",rePassword)
                // Custom validation for password strength
                // var passwordStrengthRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
                // if (!passwordStrengthRegex.test(password)) {
                //     event.preventDefault();
                //     event.stopPropagation();
                //     console.log("password fail validate")
                //     passwordField.setCustomValidity("Mật khẩu phải chứa ít nhất 8 ký tự, bao gồm chữ thường, chữ in hoa, số và ký tự đặc biệt.");
                // } else {
                //     passwordField.setCustomValidity(""); // Clear validity if valid
                // }

                // Check if passwords match
                if (password !== rePassword) {
                    event.preventDefault();
                    event.stopPropagation();
                    console.log("rePassword fail validate")
                    rePasswordField.setCustomValidity("Mật khẩu xác nhận không khớp.");
                } else {
                    rePasswordField.setCustomValidity("");
                }

                // Bootstrap validation style
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    });

</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const otpInputs = document.querySelectorAll('.otp-inputs input');
        const otpForm = document.getElementById('otp-form');

        // Focus vào ô đầu tiên khi load trang
        otpInputs[0].focus();

        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                // Chỉ cho phép nhập số
                if (!/^[0-9]$/.test(e.target.value)) {
                    input.value = ''; // Xóa nếu không phải số
                    return;
                }

                // Chuyển sang ô tiếp theo nếu có
                if (input.value && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace') {
                    // Quay lại ô trước đó khi nhấn Backspace
                    if (input.value === '' && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                }
            });
        });

        // Gửi OTP qua AJAX
        otpForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Gộp các giá trị OTP
            let otp = '';
            otpInputs.forEach(input => {
                otp += input.value;
            });

            if (otp.length !== 6) {
                alert('Vui lòng nhập đầy đủ mã OTP!');
                return;
            }
            console.info("OTP: ", otp)
            // Gửi AJAX
            $url = '{{ route("auth.verify.account") }}'
            fetch($url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ otp: otp })
            })
                .then(response => response.json())
                .then(data => {
                    console.log("===== data", data)
                    if (data.status === "success") {
                        window.notyf.open({
                            type: "success",
                            message: "Kích hoạt thành công",
                            duration: 10000,
                            ripple: true,
                            dismissible: false,
                            position: {
                                x: "right",
                                y: "bottom"
                            }
                        });
                        window.location.href = '/auth/login';
                    } else {
                        if(data.code && data.code === "CODE001") {
                            window.location.href = '/auth/login';
                            return;
                        }
                        window.notyf.open({
                            type: "danger",
                            message: data.message,
                            duration: 10000,
                            ripple: true,
                            dismissible: false,
                            position: {
                                x: "right",
                                y: "bottom"
                            }
                        });
                    }
                })
                .catch(error => {
                    window.notyf.open({
                        type: "danger",
                        message: "Có lỗi xẩy ra, xin vui lòng thử lại",
                        duration: 10000,
                        ripple: true,
                        dismissible: false,
                        position: {
                            x: "right",
                            y: "bottom"
                        }
                    });
                });
        });
    });
</script>
</html>