<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white absolute-top">
        <div class="container">

            <button class="navbar-toggler order-2 order-md-1" type="button" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" aria-controls="navbar-left navbar-right" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse order-3 order-md-2" id="navbar-left">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/" title="Trang chủ">Trang chủ</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Posts</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" href="post-image.html">Image</a>
                            <a class="dropdown-item" href="post-video.html">Video</a>
                        </div>
                    </li>
                </ul>
            </div>

            <a class="navbar-brand mx-auto order-1 order-md-3" href="{{ route("news.index") }}" title="Bài viết">123code.net</a>

            <div class="collapse navbar-collapse order-4 order-md-4" id="navbar-right">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="page-about.html">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="page-contact.html">Liên hệ</a>
                    </li>
                </ul>
                <form class="form-inline" role="search">
                    <input class="search js-search form-control form-control-rounded me-sm-2" type="text" title="Enter search query here.." placeholder="Search.." aria-label="Search">
                </form>
            </div>
        </div>
    </nav>
</header>