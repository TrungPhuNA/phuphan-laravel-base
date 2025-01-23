<?php

namespace App\Http\Controllers\Admin\Acl;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Acl\RequestCreateAccount;
use App\Models\UserApi;
use App\Service\AccountService;
use App\Service\RoleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AclAccountController extends Controller
{
    protected AccountService $accountService;
    protected RoleService $roleService;

    public function __construct(AccountService $accountService, RoleService $roleService)
    {
        $this->accountService = $accountService;
        $this->roleService = $roleService;
    }

    public function index(Request $request)
    {
        $accounts = $this->accountService->paginate($request->all());
        $viewData = [
            "accounts" => $accounts
        ];

        return view('admin.acl.account.index', $viewData);
    }

    public function create()
    {
        $viewData = [
            'roles' => $this->roleService->getAll()
        ];
        return view('admin.acl.account.create', $viewData);
    }

    public function store(RequestCreateAccount $requestCreateAccount)
    {
        $accountDto = $requestCreateAccount->except("_token");
        $user = $this->accountService->create($accountDto);
        if ($user) {
            if ($requestCreateAccount->roles && $user)
                $user->assignRole($requestCreateAccount->roles);
            return redirect()->route("admin.acl.account.index")->with("success", "Tạo mới thành công");
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $user = $this->accountService->findById($id);
        $viewData = [
            "user"  => $user,
            'roles' => $this->roleService->getAll()
        ];

        return view('admin.acl.account.update', $viewData);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $user = $this->accountService->update($id, $data);
        if ($user) {
            if ($request->roles) {
                $roleActive = DB::table('acl_model_has_roles')->where('model_id', $id)->pluck('role_id')->toArray();
                if (!empty($roleActive)) {
                    foreach ($roleActive as $item)
                        $user->removeRole($item);
                }

                $user->assignRole($request->roles);
            }
            return redirect()->route("admin.acl.account.index")->with("success", "Cập nhật thành công");
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }
}
