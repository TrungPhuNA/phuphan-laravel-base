<?php

namespace App\Repositories\Eloquent;

use App\Models\Blog\Article;
use AtCore\CoreRepo\Repositories\Eloquent\BaseRepository;
use App\Repositories\Contracts\ArticleRepositoryInterface;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    public function __construct(Article $model)
    {
        parent::__construct($model);
    }

    public function getListsArticles($params, $columns = ["*"])
    {
        $query = $this->model->with("menu");
        if (isset($filters['filters']) && is_array($filters['filters'])) {
            $query = $this->applyFilters($query, $filters['filters']);
        }
        $page = isset($filters['page']) ? (int) $filters['page'] : 1;
        $pageSize = isset($filters['page_size']) ? (int) $filters['page_size'] : 10;

        return $query->orderBy('id', 'DESC')->paginate($pageSize, $columns, 'page', $page);
    }
}