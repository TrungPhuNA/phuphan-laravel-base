<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 2/3/25
 */

namespace App\Service;

use App\Repositories\Contracts\VariantAttributeRepositoryInterface;

class VariantAttributeService
{
    protected VariantAttributeRepositoryInterface $variantAttributeRepository;

    public function __construct(VariantAttributeRepositoryInterface $variantAttributeRepository)
    {
        $this->variantAttributeRepository = $variantAttributeRepository;
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->variantAttributeRepository->paginate($params);
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function create($modelDto)
    {
        return $this->variantAttributeRepository->create($modelDto);
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function insert($modelDto)
    {
        return $this->variantAttributeRepository->insert($modelDto);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function checkExistsAttributeValue($conditions): mixed
    {
        return $this->variantAttributeRepository->checkExistsAttributeValue($conditions);
    }

    public function updateAttributeValue($conditions, $updateDto): mixed
    {
        return $this->variantAttributeRepository->updateAttributeValue($conditions, $updateDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->variantAttributeRepository->find($id);
    }


    /**
     * @param $id
     * @param $modelDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $modelDto) {
        return $this->variantAttributeRepository->update($id, $modelDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->variantAttributeRepository->delete($id);
    }
}