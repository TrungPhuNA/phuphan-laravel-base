<?php

namespace App\Repositories\Contracts;

use AtCore\CoreRepo\Repositories\Contracts\BaseRepositoryInterface;

interface ArticleRepositoryInterface extends BaseRepositoryInterface
{
    public function getListsArticles($params, $columns = ["*"]);
}