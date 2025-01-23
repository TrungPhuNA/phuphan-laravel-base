@extends("admin.layouts.admin_master")
@section("title_page","Thêm mới")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Cập nhật nhóm quyền</strong></h3>
                </div>
                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route("admin.acl.role.index") }}" class="btn btn-danger"><i class="align-middle" data-feather="rotate-ccw"></i> Trở về</a>
                </div>
            </div>
            <form action="" method="POST" autocomplete="off" class="needs-validation" novalidate>
                @csrf
                <div class="row">
                    <div class="col-12 col-xl-3">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Thông tin nhóm quyền</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old("name", $role->name) }}" required>
                                    <div class="invalid-feedback">Name không được để trống</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Guard Name</label>
                                    <input type="text" class="form-control" placeholder="web" name="guard_name" value="{{ old("guard_name",$role->guard_name) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input type="text" class="form-control" placeholder="Mô tả" name="description" value="{{ old("description",$role->description) }}" required>
                                    <div class="invalid-feedback">Description không được để trống</div>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="save"></i> Xác nhận</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-9">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Chọn permissions</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3 row">
                                    @foreach($permissions as $permission)
                                        <div class="col-sm-4">
                                            <label class="form-check m-2">
                                                <input type="checkbox" name="permissions[]" {{ in_array($permission->id, $roleActive) ? "checked" : "" }} value="{{ $permission->name }}" class="form-check-input">
                                                <span class="form-check-label">{{ $permission->name }}</span>
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
    document.addEventListener("DOMContentLoaded", function() {
        var forms = document.querySelectorAll('.needs-validation')
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