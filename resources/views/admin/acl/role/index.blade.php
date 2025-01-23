@extends("admin.layouts.admin_master")
@section("title_page","Danh sách nhóm quyền")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Nhóm quyền</strong></h3>
                </div>

                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route("admin.acl.role.create") }}" class="btn btn-primary"><i class="align-middle" data-feather="plus"></i> Thêm mới</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Danh sách nhóm quyền</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Guard Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($roles ?? [] as $item)
                                    <tr>
                                        <td scope="row">{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->guard_name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-danger"><i class="align-middle" data-feather="trash"></i></a>
                                            <a href="{{ route("admin.acl.role.update", $item->id) }}" class="btn btn-sm btn-primary"><i class="align-middle" data-feather="edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    {!! $roles->links("vendor.pagination.bootstrap-5") !!}
                </div>
            </div>
        </div>
    </main>
@stop