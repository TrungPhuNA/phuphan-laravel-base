<?php

namespace App\Http\Controllers\Fe\Blog;

use App\Http\Controllers\Controller;
use App\Service\MenuService;
use App\Service\TagService;

class BlogBaseController extends Controller
{
    protected TagService $tagService;
    protected MenuService $menuService;

    public function __construct(
        TagService $tagService,
        MenuService $menuService,
    ) {
        $this->tagService = $tagService;
        $this->menuService = $menuService;


    }
}
