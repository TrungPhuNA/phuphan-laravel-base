<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdmBlogArticleController extends Controller
{
    public function index()
    {
        return view('admin.blog.article.index');
    }
}
