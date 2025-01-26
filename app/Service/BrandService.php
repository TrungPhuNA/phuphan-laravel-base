<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/26/25
 */

namespace App\Service;

use App\Repositories\Contracts\BrandRepositoryInterface;
use Illuminate\Support\Str;

class BrandService
{
    protected BrandRepositoryInterface $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getAll($params = [])
    {
        return $this->brandRepository->getAll($params);
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->brandRepository->paginate($params);
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function create($modelDto)
    {
        $modelDto["slug"] = Str::slug($modelDto["name"]);
        return $this->brandRepository->create($modelDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->brandRepository->find($id);
    }

    /**
     * @param $id
     * @param $modelDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $modelDto) {
        $modelDto["slug"] = Str::slug($modelDto["name"]);
        return $this->brandRepository->update($id, $modelDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->brandRepository->delete($id);
    }
}