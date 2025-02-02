<?php

namespace App\Http\Controllers\Fe\Blog;

use App\Http\Controllers\Controller;
use App\Service\ArticleService;
use App\Service\MenuService;
use App\Service\TagService;
use Illuminate\Http\Request;

class BlogTagController extends BlogBaseController
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
        try {
            $tag = $this->tagService->findBySlug($slug);

            $articles = $this->articleService->getListsArticles([
                "page"      => 1,
                "page_size" => 6
            ]);

            $viewData = [
                "articles" => $articles,
                "tag"      => $tag
            ];
            return view("fe.blog.tag.index", $viewData);
        } catch (\Exception $exception) {
            \Log::error("=======[BlogHomeController.php] File: "
                .$exception->getFile()
                ." Line: ".$exception->getLine()
                ." Message: ".$exception->getMessage());
        }
    }
}
