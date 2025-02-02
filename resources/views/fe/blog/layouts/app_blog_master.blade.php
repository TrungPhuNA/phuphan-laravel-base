

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Magazine/Blog Theme">
    <meta name="author" content="Bootlab">

    <title>Milo - Magazine/Blog Theme</title>
    <link href="{{ asset("static/blog/css/app.css") }}" rel="stylesheet">
    <style>
        .card .card-meta a {
            color: #0d6efd !important;
        }
    </style>
</head>
<body>

@include("fe.blog.layouts._inc_blog_nav")

<main class="main pt-4">

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-9">

                @yield("content")

            </div>
            <div class="col-md-3 ms-auto">
                @yield("content_sidebar")
                <aside class="sidebar sidebar-sticky">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Tags</h4>
                            @foreach($tagsGlobal as $item)
                                <a class="btn btn-light btn-sm mb-1" href="{{ route("news.tag.detail",["slug" => $item->slug]) }}" title="{{ $item->name }}">{{ $item->name }}</a>
                            @endforeach
                        </div>
                    </div><!-- /.card -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Bài viết nổi bật</h4>

                            @foreach($articlesGlobal ?? [] as $item)
                                <a href="{{ route("news.article.detail",["slug" => $item->slug]) }}" title="{{ $item->name }}" class="d-inline-block">
                                    <h4 class="h6">{{ $item->name }}</h4>
                                    <img class="card-img" src="{{ $item->avatar }}" alt="{{ $item->name }}" onerror="this.src='https://123code.net/images/preloader.png'"  />
                                </a>
                                <time class="timeago" datetime="{{ $item->created_at->locale('vi') }}">{{ $item->created_at }}</time> in {{ $item->menu->name ?? "N\A" }}
                            @endforeach
                        </div>
                    </div><!-- /.card -->
                </aside>
            </div>
        </div>
    </div>

</main>

<div class="site-newsletter">
    <div class="container">
        <div class="text-center">
            <h3 class="h4 mb-2">Subscribe to our newsletter</h3>
            <p class="text-muted">Join our monthly newsletter and never miss out on new stories and promotions.</p>

            <div class="row">
                <div class="col-xs-12 col-sm-9 col-md-7 col-lg-5 ms-auto me-auto">
                    <div class="input-group mb-3 mt-3">
                        <input type="text" class="form-control" placeholder="Email address" aria-label="Email address">
                        <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Subscribe</button>
              </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-instagram">
    <div class="action">
        <a class="btn btn-light" href="#">
            Follow us @ Instagram
        </a>
    </div>
    <div class="row g-0">
        <div class="col-sm-6">
            <div class="row g-0">
                <div class="col-3">
                    <a class="photo" href="#">
                        <img class="img-fluid" src="{{ asset("static/blog/image/1.jpg") }}" alt="" />
                    </a>
                </div>
                <div class="col-3">
                    <a class="photo" href="#">
                        <img class="img-fluid" src="{{ asset("static/blog/image/2.jpg") }}" alt="" />
                    </a>
                </div>
                <div class="col-3">
                    <a class="photo" href="#">
                        <img class="img-fluid" src="{{ asset("static/blog/image/3.jpg") }}" alt="" />
                    </a>
                </div>
                <div class="col-3">
                    <a class="photo" href="#">
                        <img class="img-fluid" src="{{ asset("static/blog/image/4.jpg") }}" alt="" />
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row g-0">
                <div class="col-3">
                    <a class="photo" href="#">
                        <img class="img-fluid" src="{{ asset("static/blog/image/5.jpg") }}" alt="" />
                    </a>
                </div>
                <div class="col-3">
                    <a class="photo" href="#">
                        <img class="img-fluid" src="{{ asset("static/blog/image/6.jpg") }}" alt="" />
                    </a>
                </div>
                <div class="col-3">
                    <a class="photo" href="#">
                        <img class="img-fluid" src="{{ asset("static/blog/image/7.jpg") }}" alt="" />
                    </a>
                </div>
                <div class="col-3">
                    <a class="photo" href="#">
                        <img class="img-fluid" src="{{ asset("static/blog/image/8.jpg") }}" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="site-footer bg-dark">
    <div class="container">

        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link" href="#">Privacy policy</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Terms</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Feedback</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Advertise</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="page-contact.html">Contact</a>
            </li>
        </ul>
        <div class="copy">
            &copy; Milo 2022<br />
            All rights reserved
        </div>
    </div>
</footer>

<script src="{{ asset("static/blog/js/app.js") }}"></script>
</body>
</html>
