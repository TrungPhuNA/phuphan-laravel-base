<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSystemController extends Controller
{
    public function index()
    {
        return view('admin.system.index');
    }
}
