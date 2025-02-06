<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 2/3/25
 */

namespace App\Service;

use App\Repositories\Contracts\AttributeRepositoryInterface;
use Illuminate\Support\Str;

class AttributeService
{
    protected AttributeRepositoryInterface $attributeRepository;

    public function __construct(AttributeRepositoryInterface $attributeRepository)
    {
        $this->attributeRepository = $attributeRepository;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getAll($params = [])
    {
        return $this->attributeRepository->getAll($params);
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function getByIds($ids = [])
    {
        return $this->attributeRepository->getByIds($ids);
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->attributeRepository->paginate($params);
    }

    /**
     * @param $tagDto
     * @return mixed
     */
    public function create($tagDto)
    {
        $tagDto["slug"] = Str::slug($tagDto["name"]);
        return $this->attributeRepository->create($tagDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->attributeRepository->find($id);
    }

    /**
     * @param $id
     * @param $tagDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $tagDto) {
        $tagDto["slug"] = Str::slug($tagDto["name"]);
        return $this->attributeRepository->update($id, $tagDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->attributeRepository->delete($id);
    }
}