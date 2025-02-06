<?php

namespace App\Repositories\Eloquent;

use App\Models\Ecommerce\Product;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getListsProducts($params = [], $columns = ['*'])
    {
        $query = $this->model->with("category","brand");
        if (isset($filters['filters']) && is_array($filters['filters'])) {
            $query = $this->applyFilters($query, $filters['filters']);
        }
        $page = isset($filters['page']) ? (int) $filters['page'] : 1;
        $pageSize = isset($filters['page_size']) ? (int) $filters['page_size'] : 10;

        return $query->orderBy('id', 'DESC')->paginate($pageSize, $columns, 'page', $page);
    }

    public function findById($id)
    {
        return $this->model->with("variants")->where("id", $id)->first();
    }

    public function findBySlug($slug)
    {
        return $this->model->where("slug", $slug)->first();
    }
}