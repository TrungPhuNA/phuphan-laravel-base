<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\RequestCreateAccount;
use App\Http\Requests\Admin\Acl\RequestCreateRole;
use App\Service\PermissionService;
use App\Service\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class AclRoleController extends Controller
{

    protected RoleService $roleService;
    protected PermissionService $permissionService;

    public function __construct(
        RoleService $roleService,
        PermissionService $permissionService,
    ) {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    public function index(Request $request)
    {
        $roles = $this->roleService->paginate($request->all());
        $viewData = [
            "roles" => $roles
        ];

        return view('admin.acl.role.index', $viewData);
    }

    public function create()
    {
        $viewData = [
            "permissions" => $this->permissionService->getAll()
        ];

        return view('admin.acl.role.create', $viewData);
    }

    public function store(RequestCreateRole $requestCreateRole)
    {
        dd($requestCreateRole->permissions);
        $roleDto = $requestCreateRole->except("_token", "permissions");
        $role = $this->roleService->create($roleDto);
        if ($role) {
            if (!empty($requestCreateRole->permissions)) {
                $role->givePermissionTo($requestCreateRole->permissions);
            }
            return redirect()->route("admin.acl.role.index")->with("success", "Tạo mới thành công");
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $role = $this->roleService->findById($id);
        $roleActive = $role->permissions->pluck("id")->toArray() ?? [];
        $viewData = [
            "role"        => $role,
            "roleActive"  => $roleActive,
            "permissions" => $this->permissionService->getAll()
        ];

        return view('admin.acl.role.update', $viewData);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $update = $this->roleService->update($id, $data);
        if ($update) {
            if (!empty($request->permissions)) {
                $role = $this->roleService->findById($id);
                $permissionActive = DB::table('acl_role_has_permissions')
                    ->where('role_id', $id)
                    ->pluck('permission_id')
                    ->toArray();
                if ($permissionActive) {
                    foreach ($permissionActive as $item) {
                        $role->revokePermissionTo($item);
                    }
                }
                $role->givePermissionTo($request->permissions);
            }
            return redirect()->route("admin.acl.role.index")->with("success", "Cập nhật thành công");
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }
}
