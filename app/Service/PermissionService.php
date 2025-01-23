<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/22/25
 */

namespace App\Service;

use App\Repositories\Contracts\PermissionRepositoryInterface;

class PermissionService
{
    protected $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function paginate($params){
        return $this->permissionRepository->paginate($params);
    }

    public function getAll(){
        return $this->permissionRepository->getAll();
    }

    public function findById($id)
    {
        return $this->permissionRepository->find($id);
    }

    public function create($permissionDto)
    {
        return $this->permissionRepository->create($permissionDto);
    }

    public function update($id, $permissionDto) {
        return $this->permissionRepository->update($id, $permissionDto);
    }
}