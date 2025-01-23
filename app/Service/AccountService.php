<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

namespace App\Service;

use App\Repositories\Contracts\UserRepositoryInterface;

class AccountService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function paginate($params)
    {
        return $this->userRepository->paginate($params);
    }

    public function create($accountDto)
    {
        $accountDto["password"] = bcrypt($accountDto["password"]);
        return $this->userRepository->create($accountDto);
    }

    public function findById($id)
    {
        return $this->userRepository->find($id);
    }

    public function update($id, $userDto) {
        if(!empty($userDto["password"])) {
            $userDto["password"] = bcrypt($userDto["password"]);
        }else unset($userDto["password"]);
        return $this->userRepository->update($id, $userDto);
    }
}