<?php

namespace App\Http\Controllers\Fe\Blog;

use App\Service\ArticleService;
use App\Service\MenuService;
use App\Service\TagService;
use Illuminate\Http\Request;

class BlogArticleController extends BlogBaseController
{
    protected TagService $tagService;
    protected MenuService $menuService;
    protected ArticleService $articleService;

    public function __construct(
        TagService $tagService,
        ArticleService $articleService,
        MenuService $menuService,
    ) {
        $this->tagService = $tagService;
        $this->articleService = $articleService;
        $this->menuService = $menuService;
        parent::__construct($tagService, $menuService, $articleService);
    }

    public function index(Request $request, $slug)
    {
        $articleDetail = $this->articleService->findBySlug($slug);
        $articles = $this->articleService->getListsArticles($request->all());
        $viewData = [
            "articles"      => $articles,
            "articleDetail" => $articleDetail
        ];

        return view('fe.blog.article-detail.index', $viewData);
    }
}
