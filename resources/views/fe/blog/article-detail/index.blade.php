@extends("fe.blog.layouts.app_blog_master")
@section("content")
    <article class="card mb-4">
    <header class="card-header text-center">
        <div class="card-meta">
            <a href="#"><time class="timeago" datetime="2021-09-26 20:00">26 october 2021</time></a> in <a href="{{ route("news.menu.index",["slug" => $articleDetail->menu->slug]) }}">{{ $articleDetail->menu->name ?? "N\A" }}</a>
        </div>
        <a href="" title="{{ $articleDetail->name }}">
            <h1 class="card-title">{{ $articleDetail->name }}</h1>
        </a>
    </header>
    <a href="" title="{{ $articleDetail->name }}">
        <img class="card-img" src="img/articles/1.jpg" alt="" />
    </a>
    <div class="card-body">
        {!! $articleDetail->content !!}
        <hr />

        <h3>4 comments</h3>

        <div class="d-flex mb-3 p-3 bg-light">
            <div class="text-center">
                <img class="me-3 rounded-circle" src="img/avatars/3.png" alt="Lucy" width="100" height="100">
                <h6 class="mt-1 mb-0 me-3">Lucy</h6>
            </div>
            <div class="flex-grow-1 d-block">
                <p class="mt-3 mb-2">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                <time class="timeago text-muted" datetime="2021-09-03 20:00">3 december 2021</time>
                <a class="float-end" href="#"><span class="fa fa-reply"></span> Reply</a>

                <div class="d-flex mt-3 p-0">
                    <div class="pe-3 text-center">
                        <img class="me-3 rounded-circle" src="img/avatars/2.png" alt="John" width="100" height="100">
                        <h6 class="mt-1 mb-0 me-3">John</h6>
                    </div>
                    <div class="flex-grow-1">
                        <p class="mt-3 mb-2">Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                        <time class="timeago text-muted" datetime="2021-09-14 19:00">14 december 2021</time>
                        <a class="float-end" href="#"><span class="fa fa-reply"></span> Reply</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex mb-3 p-3 bg-light">
            <div class="text-center">
                <img class="me-3 rounded-circle" src="img/avatars/1.png" alt="Kim" width="100" height="100">
                <h6 class="mt-1 mb-0 me-3">Kim</h6>
            </div>
            <div class="flex-grow-1">
                <p class="mt-3 mb-2">Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis.</p>
                <time class="timeago text-muted" datetime="2021-09-20 20:00">20 november 2021</time>
                <a class="float-end" href="#"><span class="fa fa-reply"></span> Reply</a>
            </div>
        </div>

        <div class="d-flex mb-3 p-3 bg-light">
            <div class="text-center">
                <img class="me-3 rounded-circle" src="img/avatars/4.png" alt="Paula" width="100" height="100">
                <h6 class="mt-1 mb-0 me-3">Paula</h6>
            </div>
            <div class="flex-grow-1">
                <p class="mt-3 mb-2">Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus.</p>
                <time class="timeago text-muted" datetime="2021-09-05 20:00">5 november 2021</time>
                <a class="float-end" href="#"><span class="fa fa-reply"></span> Reply</a>
            </div>
        </div>

        <div class="mt-5">
            <h5>Write a response</h5>
            <div class="row">
                <div class="col-md-6">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your name">
                </div>
                <div class="col-md-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your email">
                </div>
            </div>
            <textarea class="form-control mt-3" rows="3" placeholder="Write a response.."></textarea>
            <a href="#" class="btn btn-success mt-3">Publish</a>
        </div>

    </div>
</article><!-- /.card -->
@stop