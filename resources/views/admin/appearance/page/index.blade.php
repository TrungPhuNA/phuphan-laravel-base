@extends("admin.layouts.admin_master")
@section("title_page","Danh sách")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Page</strong></h3>
                </div>

                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route("admin.appearance.pages.create") }}" class="btn btn-primary"><i class="align-middle" data-feather="plus"></i> Thêm mới</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Danh sách page</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Image</th>
                                    <th scope="col" style="width: 30%">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pages ?? [] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>
                                            <img src="{{ $item->avatar }}" alt="" style="width: 50px;height: auto">
                                        </td>
                                        <td>
                                            <a href="" style="width: 200px">{{ $item->name }}</a>
                                        </td>
                                        <td>
                                             <span class="badge {{ \App\HelpersClass\HelpersRenderHtml::getStatusBadgeClass($item->status) }}">
                                                {{ ucfirst($item->status) }}
                                            </span>
                                        </td>
                                        <td class="text-nowrap">{{ $item->created_at->format("Y-m-d") }}</td>
                                        <td class="text-nowrap">
                                            <a href="{{ route("admin.appearance.pages.delete", $item->id) }}" class="btn btn-sm btn-danger"><i class="align-middle" data-feather="trash"></i></a>
                                            <a href="{{ route("admin.appearance.pages.update", $item->id) }}" class="btn btn-sm btn-primary"><i class="align-middle" data-feather="edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    {!! $pages->links("vendor.pagination.bootstrap-5") !!}
                </div>
            </div>
        </div>
    </main>
@stop