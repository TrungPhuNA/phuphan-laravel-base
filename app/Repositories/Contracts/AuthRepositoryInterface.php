<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface AuthRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail($email);
    public function findByToken($token);
    public function resetDataPassword($email);
    public function findByOtp($otp);
    public function createResetPassword($dataDto);
}