@extends("admin.layouts.admin_master")
@section("title_page","Cập nhật")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Cập nhật tài khoản</strong></h3>
                </div>
                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route("admin.acl.account.index") }}" class="btn btn-danger"><i class="align-middle"
                                                                                               data-feather="rotate-ccw"></i>
                        Trở về</a>
                </div>
            </div>
            <form action="" method="POST" autocomplete="off" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Thông tin tài khoản</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Họ tên</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name"
                                           value="{{ old("name", $user->name) }}" required>
                                    <div class="invalid-feedback">Họ tên không được để trống</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" placeholder="0986" name="phone"
                                           value="{{ old("phone", $user->phone) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email đăng nhập</label>
                                    <input type="email" class="form-control" placeholder="Email" name="email"
                                           value="{{ old("email", $user->email) }}" required>
                                    <div class="invalid-feedback">Email không được để trống</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                           value="">
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="align-middle"
                                                                                 data-feather="save"></i> Xác nhận
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Chọn nhóm quyền</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    @foreach($roles as $role)
                                        <div class="col-sm-4">
                                            <label class="form-check m-2">
                                                <input type="checkbox" name="roles[]" {{ in_array($role->id, $roleActive ?? []) ? "checked" : "" }} value="{{ $role->name }}" class="form-check-input">
                                                <span class="form-check-label">{{ $role->name }}</span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@stop
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    });
</script>