@extends("admin.layouts.admin_master")
@section("title_page","Cấu hình email")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route("admin.setting.info") }}">Settings</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Email Settings</h1>
                    </li>
                </ol>
            </nav>
            <h1 class="h3 mb-3">Cấu hình email</h1>
            <div class="row">
                <div class="col-md-3 col-xl-2">
                    <div class="card">
                        <div class="list-group list-group-flush" role="tablist">
                            <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab" aria-selected="true">
                                Test cấu hình
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-xl-10">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="account" role="tabpanel">

                            <!-- INC PROFILE -->

                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h5 class="card-title mb-0">Thông tin</h5>
                                </div>
                                <div class="card-body">
                                    <form action="" id="formInfo" method="POST" autocomplete="off">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label" for="inputAddress">Send To</label>
                                            <input type="email" class="form-control" name="email" placeholder="" value="phupt.humg.94@gmail.com">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="inputAddress">Contents</label>
                                            <textarea type="text" class="form-control" name="contents" rows="2" placeholder="Nội dung test email"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="save-settings-btn">Send test email</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop