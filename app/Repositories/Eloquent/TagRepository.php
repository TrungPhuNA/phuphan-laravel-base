<?php

namespace App\Repositories\Eloquent;

use App\Models\Blog\Menu;
use App\Models\Blog\Tag;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\TagRepositoryInterface;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    public function getAll($params = [])
    {
        return Menu::all();
    }
}