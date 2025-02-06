<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 2/3/25
 */

namespace App\Service;

use App\Repositories\Contracts\ProductVariantRepositoryInterface;

class ProductVariantService
{
    protected ProductVariantRepositoryInterface $productVariantRepository;

    public function __construct(ProductVariantRepositoryInterface $productVariantRepository)
    {
        $this->productVariantRepository = $productVariantRepository;
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->productVariantRepository->paginate($params);
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function create($modelDto)
    {
        return $this->productVariantRepository->create($modelDto);
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function insert($modelDto)
    {
        return $this->productVariantRepository->insert($modelDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->productVariantRepository->find($id);
    }

    /**
     * @param $id
     * @param $modelDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $modelDto) {
        return $this->productVariantRepository->update($id, $modelDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->productVariantRepository->delete($id);
    }

    public function updateOrCreate($conditions, $data)
    {
        return $this->productVariantRepository->updateOrCreate($conditions, $data);
    }
}