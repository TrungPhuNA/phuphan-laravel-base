<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 1/23/25
 */

namespace App\Service;

use App\Repositories\Contracts\MenuRepositoryInterface;
use Illuminate\Support\Str;

class MenuService
{
    protected MenuRepositoryInterface $menuRepository;

    public function __construct(MenuRepositoryInterface $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->menuRepository->paginate($params);
    }

    public function getAll($params = [])
    {
        return $this->menuRepository->getAll($params);
    }

    /**
     * @param $menuDto
     * @return mixed
     */
    public function create($menuDto)
    {
        $menuDto["slug"] = Str::slug($menuDto["name"]);
        return $this->menuRepository->create($menuDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->menuRepository->find($id);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug) {
        return $this->menuRepository->findBySlug($slug);
    }

    /**
     * @param $id
     * @param $menuDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $menuDto) {
        $menuDto["slug"] = Str::slug($menuDto["name"]);
        return $this->menuRepository->update($id, $menuDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->menuRepository->delete($id);
    }
}