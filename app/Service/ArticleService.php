<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/23/25
 */

namespace App\Service;

use App\Repositories\Contracts\ArticleRepositoryInterface;

class ArticleService
{
    protected ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->articleRepository->paginate($params);
    }

    /**
     * @param $roleDto
     * @return mixed
     */
    public function create($roleDto)
    {
        return $this->articleRepository->create($roleDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->articleRepository->find($id);
    }

    /**
     * @param $id
     * @param $roleDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $roleDto) {
        return $this->articleRepository->update($id, $roleDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->articleRepository->delete($id);
    }
}