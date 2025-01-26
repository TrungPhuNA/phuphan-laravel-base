<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/23/25
 */

namespace App\Service;

use App\Repositories\Contracts\TagRepositoryInterface;
use Illuminate\Support\Str;

class TagService
{
    protected TagRepositoryInterface $tagRepository;

    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function getAll($params = [])
    {
        return $this->tagRepository->getAll($params);
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->tagRepository->paginate($params);
    }

    /**
     * @param $tagDto
     * @return mixed
     */
    public function create($tagDto)
    {
        $tagDto["slug"] = Str::slug($tagDto["name"]);
        return $this->tagRepository->create($tagDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->tagRepository->find($id);
    }

    /**
     * @param $id
     * @param $tagDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $tagDto) {
        $tagDto["slug"] = Str::slug($tagDto["name"]);
        return $this->tagRepository->update($id, $tagDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->tagRepository->delete($id);
    }
}