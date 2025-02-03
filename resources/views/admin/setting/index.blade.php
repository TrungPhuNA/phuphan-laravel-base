@extends("admin.layouts.admin_master")
@section("title_page","Cấu hình")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">
            <h1 class="h3 mb-3">Setting</h1>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Common</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                            @foreach(config('setting.admin.menu_setting.common') ?? [] as $item)
                                <div class="col-sm-4">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="bg-light rounded-2" style="width: 40px;height: 40px;display: flex;align-items: center;justify-content: center">
                                                <i class="align-middle" data-feather="{{ $item['icon'] }}"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <a href="{{ !empty($item["route"]) ? route($item["route"]) : ''}}"><strong>{{ $item["name"] }}</strong></a>
                                            <div class="text-muted">
                                                {{ $item["desc"] }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@stop
@section("script")
@stop