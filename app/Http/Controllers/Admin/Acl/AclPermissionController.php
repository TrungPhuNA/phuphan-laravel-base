<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\RequestCreatePermission;
use App\Service\PermissionService;
use Illuminate\Http\Request;

class AclPermissionController extends Controller
{
    public $permissionService;
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index(Request $request)
    {
        $permissions = $this->permissionService->paginate($request->all());
        $viewData = [
            "permissions" => $permissions
        ];
        return view('admin.acl.permission.index', $viewData);
    }

    public function create()
    {
        return view('admin.acl.permission.create');
    }

    public function store(RequestCreatePermission $requestCreatePermission)
    {
        $accountDto = $requestCreatePermission->except("_token");
        $user = $this->permissionService->create($accountDto);
        if($user) {
            return redirect()->route("admin.acl.permission.index")->with("success","Tạo mới thành công");
        }
        return redirect()->back()->with("danger","Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $permission = $this->permissionService->findById($id);
        $viewData = [
            "permission" => $permission
        ];

        return view('admin.acl.permission.update', $viewData);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = $this->permissionService->update($id, $data);
        if($user) {
            return redirect()->route("admin.acl.permission.index")->with("success","Cập nhật thành công");
        }
        return redirect()->back()->with("danger","Cập nhật thất bại");
    }
}
