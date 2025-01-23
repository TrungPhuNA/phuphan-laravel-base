<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

namespace App\Service;

use App\Repositories\Contracts\AuthRepositoryInterface;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function register($userDto)
    {
        $userDto["password"] = bcrypt($userDto["password"]);
        return $this->authRepository->create($userDto);
    }

    public function findByEmail($email)
    {
        return $this->authRepository->findByEmail($email);
    }

    public function findByToken($token)
    {
        return $this->authRepository->findByToken($token);
    }

    public function findByOtp($otp)
    {
        return $this->authRepository->findByOtp($otp);
    }

    public function createResetPassword($dataDto)
    {
        return $this->authRepository->createResetPassword($dataDto);
    }

    public function updateUser($userID, $dataDto)
    {
        return $this->authRepository->update($userID, $dataDto);
    }

    public function resetDataPassword($email)
    {
        return $this->authRepository->resetDataPassword($email);
    }
}