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

    public function login()
    {

    }
}