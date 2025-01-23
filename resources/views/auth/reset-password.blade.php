
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

    <title>Reset Password | {{ config('setting.prefix_title') }}</title>

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
                        <h1 class="h2">Quên mật khẩu</h1>
                        <p class="lead">
                            Điền email đăng ký để nhận lại đường link đặt lại mật khẩu
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form action="" method="POST" class="needs-validation" novalidate autocomplete="off">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email đăng ký</label>
                                        <input class="form-control form-control-lg" type="email" name="email" required placeholder="codehue94@gmail.com" />
                                        <div class="invalid-feedback">Email không được để trống</div>
                                    </div>
                                    <div class="d-grid gap-2 mt-3">
                                        <button type="submit" class='btn btn-lg btn-primary' href='/'>Xác nhận</button>
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

    document.addEventListener("DOMContentLoaded", function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    });
</script>
</html>