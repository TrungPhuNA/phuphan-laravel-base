<?php

namespace App\Http\Controllers\Fe\Blog;

use App\Service\ArticleService;
use App\Service\MenuService;
use App\Service\TagService;
use Illuminate\Http\Request;

class BlogMenuController extends BlogBaseController
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
    }

    public function index(Request $request, $slug)
    {
        try {
            $menu = $this->menuService->findBySlug($slug);
            $articles = $this->articleService->getListsArticles([
                "page"             => 1,
                "page_size"        => 6,
                "filters[menu_id]" => $menu->id
            ]);

            $viewData = [
                "articles" => $articles
            ];
            return view("fe.blog.home.index", $viewData);
        } catch (\Exception $exception) {
            \Log::error("=======[BlogHomeController.php] File: "
                .$exception->getFile()
                ." Line: ".$exception->getLine()
                ." Message: ".$exception->getMessage());
        }
    }
}
