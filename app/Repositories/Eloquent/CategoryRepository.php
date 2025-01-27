<?php

namespace App\Repositories\Eloquent;

use App\Models\Ecommerce\Category;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getAll($params = [])
    {
        return Category::all();
    }
}