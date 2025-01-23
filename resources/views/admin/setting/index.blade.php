@extends("admin.layouts.admin_master")
@section("title_page","Cấu hình")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Cấu hình</h1>

            <div class="row">
                <div class="col-md-3 col-xl-2">

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Profile Settings</h5>
                        </div>

                        <div class="list-group list-group-flush" role="tablist">
                            <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab" aria-selected="true">
                                Thông tin website
                            </a>
                            <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#password" role="tab" aria-selected="false" tabindex="-1">
                                Password
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-xl-10">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="account" role="tabpanel">

                            <!-- INC PROFILE -->

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Thông tin</h5>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.setting') }}" id="formInfo" method="POST" autocomplete="off">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $settingInfo->name ?? '' }}" placeholder="Name">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $settingInfo->email ?? '' }}">
                                            </div>
                                        </div>
                                        <div class="mb-3">

                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputAddress">Address</label>
                                            <input type="text" class="form-control" name="full_address" id="inputAddress" placeholder="1234 Main St" value="{{ $settingInfo->full_address ?? '' }}">
                                        </div>
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputCity">Contact Number</label>
                                                <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ $settingInfo->contact_number ?? '' }}">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="inputCity">Fax</label>
                                                <input type="text" class="form-control" name="fax"  id="fax" value="{{ $settingInfo->fax ?? '' }}">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="save-settings-btn">Save changes</button>
                                    </form>

                                </div>
                            </div>

                        </div>
                        @include("admin.setting.include._inc_adm_password")
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop
@section("script")
<script>
    $(document).ready(function () {
        // Lắng nghe sự kiện click trên button cụ thể
        $('#save-settings-btn').on('click', function (e) {
            e.preventDefault();

            // Xác định form cụ thể
            let form = $('#formInfo');
            let formData = form.serialize();

            // Gửi AJAX request
            $.ajax({
                url: "{{ route('admin.setting') }}",
                method: "POST",
                data: formData,
                success: function (response) {
                    if (response.status === 'success') {
                        window.notyf.open({
                            type: "success",
                            message: "Cập nhật thành công",
                            duration: 10000,
                            ripple: true,
                            dismissible: false,
                            position: {
                                x: "right",
                                y: "bottom"
                            }
                        });
                    } else {
                        window.notyf.open({
                            type: "danger",
                            message: "Cập nhật thất bại",
                            duration: 10000,
                            ripple: true,
                            dismissible: false,
                            position: {
                                x: "right",
                                y: "bottom"
                            }
                        });
                    }
                },
                error: function (xhr) {
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        // Hiển thị lỗi chi tiết từ server
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = Object.values(errors).join('\n');
                        alert(errorMessage);
                    } else {
                        alert('Something went wrong. Please try again.');
                    }
                }
            });
        });
    });
</script>
@stop