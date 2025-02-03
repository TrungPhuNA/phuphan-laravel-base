<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 2/3/25
 */

namespace App\Service;

use App\Repositories\Contracts\AttributeValueRepositoryInterface;
use Illuminate\Support\Str;

class AttributeValueService
{
    protected AttributeValueRepositoryInterface $attributeValueRepository;

    public function __construct(AttributeValueRepositoryInterface $attributeValueRepository)
    {
        $this->attributeValueRepository = $attributeValueRepository;
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->attributeValueRepository->paginate($params);
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function create($modelDto)
    {
        return $this->attributeValueRepository->create($modelDto);
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function insert($modelDto)
    {
        return $this->attributeValueRepository->insert($modelDto);
    }

    /**
     * @param $params
     * @return mixed
     */
    public function checkExistsAttributeValue($params): mixed
    {
        return $this->attributeValueRepository->checkExistsAttributeValue($params);
    }

    public function updateAttributeValue($params, $updateDto): mixed
    {
        return $this->attributeValueRepository->updateAttributeValue($params, $updateDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->attributeValueRepository->find($id);
    }

    /**
     * @param $attributeID
     * @return mixed
     */
    public function getListsByAttributeId($attributeID)
    {
        return $this->attributeValueRepository->getListsByAttributeId($attributeID);
    }

    /**
     * @param $id
     * @param $modelDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $modelDto) {
        return $this->attributeValueRepository->update($id, $modelDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->attributeValueRepository->delete($id);
    }
}