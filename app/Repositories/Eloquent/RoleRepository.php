<?php

namespace App\Repositories\Eloquent;

use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Spatie\Permission\Models\Role;

class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Role::all();
    }
}