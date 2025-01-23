@extends("admin.layouts.admin_master")
@section("title_page","Danh sách tài khoản")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">

            <div class="row mb-2 mb-xl-3">
                <div class="col-auto d-none d-sm-block">
                    <h3><strong>Tài khoản</strong></h3>
                </div>

                <div class="col-auto ms-auto text-end mt-n1">
                    <a href="{{ route("admin.acl.account.create") }}" class="btn btn-primary"><i class="align-middle" data-feather="plus"></i> Thêm mới</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Danh sách thành viên</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Roles</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($accounts ?? [] as $item)
                                    <tr>
                                        <td scope="row">{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            @foreach($item->roles ?? [] as $role)
                                                <span class="badge bg-success">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-danger"><i class="align-middle" data-feather="trash"></i></a>
                                            <a href="{{ route("admin.acl.account.update", $item->id) }}" class="btn btn-sm btn-primary"><i class="align-middle" data-feather="edit"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    {!! $accounts->links("vendor.pagination.bootstrap-5") !!}
                </div>
            </div>
        </div>
    </main>
@stop