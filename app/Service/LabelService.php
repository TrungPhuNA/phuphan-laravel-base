<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/26/25
 */

namespace App\Service;

use App\Repositories\Contracts\BrandRepositoryInterface;
use App\Repositories\Contracts\LabelRepositoryInterface;
use Illuminate\Support\Str;

class LabelService
{
    protected LabelRepositoryInterface $labelRepository;

    public function __construct(LabelRepositoryInterface $labelRepository)
    {
        $this->labelRepository = $labelRepository;
    }

    /**
     * @param $params
     * @return mixed
     */
    public function getAll($params = [])
    {
        return $this->labelRepository->getAll($params);
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->labelRepository->paginate($params);
    }

    /**
     * @param $modelDto
     * @return mixed
     */
    public function create($modelDto)
    {
        $modelDto["slug"] = Str::slug($modelDto["name"]);
        return $this->labelRepository->create($modelDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->labelRepository->find($id);
    }

    /**
     * @param $id
     * @param $modelDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $modelDto) {
        $modelDto["slug"] = Str::slug($modelDto["name"]);
        return $this->labelRepository->update($id, $modelDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->labelRepository->delete($id);
    }
}