<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 2/9/25
 */

namespace App\Service;

use App\Repositories\Contracts\SettingPageRepositoryInterface;
use Illuminate\Support\Str;

class SettingPageService
{
    protected SettingPageRepositoryInterface $settingPageRepository;

    public function __construct(SettingPageRepositoryInterface $settingPageRepository)
    {
        $this->settingPageRepository = $settingPageRepository;
    }

    public function getAll($params = [])
    {
        return $this->settingPageRepository->getAll($params);
    }

    /**
     * @param $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate($params)
    {
        return $this->settingPageRepository->paginate($params);
    }

    /**
     * @param $tagDto
     * @return mixed
     */
    public function create($tagDto)
    {
        $tagDto["slug"] = Str::slug($tagDto["name"]);
        return $this->settingPageRepository->create($tagDto);
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function findById($id)
    {
        return $this->settingPageRepository->find($id);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function findBySlug($slug)
    {
        return $this->settingPageRepository->findBySlug($slug);
    }

    /**
     * @param $id
     * @param $tagDto
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function update($id, $tagDto) {
        $tagDto["slug"] = Str::slug($tagDto["name"]);
        return $this->settingPageRepository->update($id, $tagDto);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->settingPageRepository->delete($id);
    }
}