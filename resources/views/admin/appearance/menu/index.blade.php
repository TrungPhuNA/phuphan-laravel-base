@extends("admin.layouts.admin_master")
@section("title_page","Home")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">
            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Menu</strong></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div id="admin-menu"></div>
                </div>
            </div>
        </div>
    </main>
@stop
@section("script")
    @viteReactRefresh
    @vite(['resources/js/admin/menu.jsx'])
@stop