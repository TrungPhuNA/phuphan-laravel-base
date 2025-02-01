<?php

namespace App\Repositories\Eloquent;

use App\Models\Blog\Menu;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\MenuRepositoryInterface;

class MenuRepository extends BaseRepository implements MenuRepositoryInterface
{
    public function __construct(Menu $model)
    {
        parent::__construct($model);
    }

    public function getAll($params = [])
    {
        return Menu::all();
    }

    public function findBySlug($slug){
        return Menu::where("slug", $slug)->first();
    }
}