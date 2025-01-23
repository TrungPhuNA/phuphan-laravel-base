<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}