<?php

namespace App\Http\Controllers\Fe\Blog;

use App\Http\Controllers\Controller;
use App\Service\ArticleService;
use App\Service\MenuService;
use App\Service\TagService;
use Illuminate\Support\Facades\View;

class BlogBaseController extends Controller
{
    protected TagService $tagService;
    protected MenuService $menuService;
    protected ArticleService $articleService;

    public function __construct(
        TagService $tagService,
        MenuService $menuService,
        ArticleService $articleService,
    ) {
        $this->tagService = $tagService;
        $this->menuService = $menuService;
        $this->articleService = $articleService;

        $tags = $this->tagService->getAll();
        View::share('tagsGlobal', $tags);

        $articles = $this->articleService->getListsArticles([]);
        View::share('articlesGlobal', $articles);
    }
}
