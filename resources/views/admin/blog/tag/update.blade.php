@extends("admin.layouts.admin_master")
@section("title_page","Cập nhật")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Cập nhật</strong></h3>
                </div>
                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route("admin.blog.tag.index") }}" class="btn btn-danger"><i class="align-middle" data-feather="rotate-ccw"></i> Trở về</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Thông tin</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST" autocomplete="off" class="needs-validation" novalidate>
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old("name", $tag->name) }}" required>
                                    <div class="invalid-feedback">Name không được để trống</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Trạng thái</label>
                                    <select name="status" class="form-control" id="" required>
                                        <option value="draft" {{ old("status", $tag->status ?? '') == "draft" ? "selected" : "" }}>Draft</option>
                                        <option value="published" {{ old("status", $tag->status ?? '') == "published" ? "selected" : "" }}>Published</option>
                                        <option value="pending" {{ old("status", $tag->status ?? '') == "pending" ? "selected" : "" }}>Pending</option>
                                    </select>
                                    <div class="invalid-feedback">Trạng thái không được để trống</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <input type="text" class="form-control" placeholder="Mô tả" name="description" value="{{ old("description", $tag->description) }}">
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="save"></i> Xác nhận</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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