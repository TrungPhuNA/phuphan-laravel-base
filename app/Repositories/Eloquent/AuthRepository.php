<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\AuthRepositoryInterface;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}