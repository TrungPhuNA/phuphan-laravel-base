<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

namespace App\Service;

use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function paginate($params)
    {
        return $this->roleRepository->paginate($params);
    }

    public function getAll()
    {
        return $this->roleRepository->getAll();
    }

    public function create($roleDto)
    {
        return $this->roleRepository->create($roleDto);
    }

    public function findById($id)
    {
        return $this->roleRepository->find($id);
    }

    public function update($id, $roleDto) {
        return $this->roleRepository->update($id, $roleDto);
    }
}