@extends("admin.layouts.admin_master")
@section("title_page","Home")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Permission</strong></h3>
                </div>

                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route("admin.acl.permission.create") }}" class="btn btn-primary"><i class="align-middle" data-feather="plus"></i> Thêm mới</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Danh sách permission</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Method</th>
                                    <th scope="col">Uri</th>
                                    <th scope="col">Group</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">#</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions ?? [] as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->method }}</td>
                                        <td>{{ $item->uri }}</td>
                                        <td>{{ $item->group }}</td>
                                        <td class="text-nowrap">{{ $item->description }}</td>
                                        <td class="text-nowrap">{{ $item->created_at->format("Y-m-d") }}</td>
                                        <td class="text-nowrap">
                                            <a href="" class="btn btn-sm btn-danger"><i class="align-middle" data-feather="trash"></i></a>
                                            <a href="{{ route("admin.acl.permission.update", $item->id) }}" class="btn btn-sm btn-primary"><i class="align-middle" data-feather="edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    {!! $permissions->links("vendor.pagination.bootstrap-5") !!}
                </div>
            </div>
        </div>
    </main>
@stop