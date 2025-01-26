<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\RequestCreateArticle;
use App\Http\Requests\Admin\Blog\RequestCreateTag;
use App\Service\ArticleService;
use App\Service\MenuService;
use App\Service\TagService;
use Illuminate\Http\Request;

class AdmBlogArticleController extends Controller
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

    public function index(Request $request)
    {
        $articles = $this->articleService->getListsArticles($request->all());
        $viewData = [
            "articles" => $articles
        ];

        return view('admin.blog.article.index', $viewData);
    }

    public function create()
    {
        $viewData = [
            "menus"      => $this->menuService->getAll(),
            "tags"       => $this->tagService->getAll(),
            "tagsActive" => []
        ];

        return view('admin.blog.article.create', $viewData);
    }

    public function store(RequestCreateArticle $requestCreateArticle)
    {
        $articleDto = $requestCreateArticle->except("_token");
        $article = $this->articleService->create($articleDto);
        if ($article) {
            if (!empty($requestCreateArticle->tags_id)) {
                $this->articleService->syncTags($requestCreateArticle->tags_id, $article->id);
            }
            return redirect()->route("admin.blog.article.index")->with("success", "Tạo mới thành công");
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $article = $this->articleService->findById($id);
        $viewData = [
            "menus"      => $this->menuService->getAll(),
            "article"    => $article,
            "tags"       => $this->tagService->getAll(),
            "tagsActive" => $this->articleService->getTagIdByArticle($id)
        ];

        return view('admin.blog.article.update', $viewData);
    }

    public function update(RequestCreateArticle $request, $id)
    {
        $data = $request->all();
        $update = $this->articleService->update($id, $data);
        if ($update) {
            if (!empty($requestCreateArticle->tags_id)) {
                $this->articleService->syncTags($requestCreateArticle->tags_id, $id);
            }

            return redirect()->route("admin.blog.article.index")->with("success", "Cập nhật thành công");
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }

    public function delete(Request $request, $id)
    {
        $article = $this->articleService->findById($id);
        if (empty($article)) {
            return redirect()->back()->with("danger", "Không tồn tại bài viết");
        }

        $this->articleService->delete($id);
        return redirect()->back()->with("success", "Cập nhật dữ liệu thành công");
    }

}
