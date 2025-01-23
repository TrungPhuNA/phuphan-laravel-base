<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\RequestCreateTag;
use App\Service\ArticleService;
use App\Service\TagService;
use Illuminate\Http\Request;

class AdmBlogArticleController extends Controller
{
    protected TagService $tagService;
    protected ArticleService $articleService;
    public function __construct(
        TagService $tagService,
        ArticleService $articleService
    ) {
        $this->tagService = $tagService;
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $articles = $this->articleService->paginate($request->all());
        $viewData = [
            "articles" => $articles
        ];

        return view('admin.blog.article.index', $viewData);
    }

    public function create()
    {
        return view('admin.blog.article.create');
    }

    public function store(RequestCreateTag $requestCreateTag)
    {
        $tagDto = $requestCreateTag->except("_token");
        $tag = $this->tagService->create($tagDto);
        if ($tag) {
            return redirect()->route("admin.blog.tag.index")->with("success", "Tạo mới thành công");
        }
        return redirect()->back()->with("danger", "Tạo mới thất bại");
    }

    public function edit(Request $request, $id)
    {
        $tag = $this->tagService->findById($id);
        $viewData = [
            "tag"        => $tag
        ];

        return view('admin.blog.tag.update', $viewData);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $update = $this->tagService->update($id, $data);
        if ($update) {
            return redirect()->route("admin.blog.tag.index")->with("success", "Cập nhật thành công");
        }
        return redirect()->back()->with("danger", "Cập nhật thất bại");
    }

    public function delete(Request $request, $id)
    {
        $tag = $this->tagService->findById($id);
        if (empty($tag)) {
            return redirect()->back()->with("danger", "Không tồn tại từ khoá");
        }

        $this->tagService->delete($id);
        return redirect()->back()->with("success", "Cập nhật dữ liệu thành công");
    }

}
