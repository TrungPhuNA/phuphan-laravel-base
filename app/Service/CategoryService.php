<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/26/25
 */

namespace App\Service;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryService
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getAll($params = [])
    {
        return $this->categoryRepository->getAll($params);
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->categoryRepository->paginate($params);
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function create($modelDto)
    {
        $modelDto["slug"] = Str::slug($modelDto["name"]);
        return $this->categoryRepository->create($modelDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * @param $id
     * @param $modelDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $modelDto) {
        $modelDto["slug"] = Str::slug($modelDto["name"]);
        return $this->categoryRepository->update($id, $modelDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->categoryRepository->delete($id);
    }
}