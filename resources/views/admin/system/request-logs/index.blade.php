@extends("admin.layouts.admin_master")
@section("title_page","Cấu hình")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route("admin.system.general") }}">System</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <h1 class="mb-0 d-inline-block fs-6 lh-1">Log request</h1>
                    </li>
                </ol>
            </nav>
            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Danh sách logs request</strong></h3>
                </div>

                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route("admin.system.log.request.download") }}" class="btn btn-success"><i class="align-middle" data-feather="download"></i> Download file</a>
                    <a href="{{ route("admin.system.log.request.delete") }}" class="btn btn-danger"><i class="align-middle" data-feather="disc"></i> Delete</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">Time</th>
                                    <th scope="col">Method</th>
                                    <th scope="col">URL</th>
                                    <th scope="col">IP</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{ $log['time'] ?? '-' }}</td>
                                        <td>{{ $log['method'] ?? '-' }}</td>
                                        <td>{{ $log['url'] ?? '-' }}</td>
                                        <td>{{ $log['ip'] ?? '-' }}</td>
                                        <td>{{ $log['status_code'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">

                </div>
            </div>
        </div>
    </main>
@stop