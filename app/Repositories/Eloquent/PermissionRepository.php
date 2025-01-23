<?php

namespace App\Repositories\Eloquent;

use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Permission::all();
    }

    public function getPermissionByRole()
    {

    }
}