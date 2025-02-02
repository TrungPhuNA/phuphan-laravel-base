@extends("fe.blog.layouts.app_blog_master")
@section("content")
    <div class="row">
        @foreach($articles as $item)
            <div class="col-md-4">
                <article class="card mb-4">
                    <header class="card-header">
                        <div class="card-meta">
                            <a href="{{ route("news.article.detail",["slug" => $item->slug]) }}" title="{{ $item->name }}">
                                <time class="timeago" datetime="{{ $item->created_at->format("d/m/Y H:i:s") }}">{{ $item->created_at->format("d/m/Y H:i:s") }}</time>
                            </a> in <a href="{{ route("news.menu.index",["slug" => $item->menu->slug]) }}">{{ $item->menu->name ?? "" }}</a>
                        </div>
                        <a href="{{ route("news.article.detail",["slug" => $item->slug]) }}" title="{{ $item->name }}">
                            <h4 class="card-title">{{ $item->name }}</h4>
                        </a>
                    </header>
                    <a href="{{ route("news.article.detail",["slug" => $item->slug]) }}" title="{{ $item->name }}">
                        <img class="card-img" src="{{ $item->avatar }}" alt="" />
                    </a>
                    <div class="card-body">
                        <p class="card-text">{{ $item->description }}</p>
                    </div>
                </article><!-- /.card -->
            </div>
        @endforeach
    </div>
@stop
@section("content_sidebar")
    <aside class="sidebar">
        <div class="card mb-4">
            <div class="card-body">
                <h1 class="card-title">{{ $tag->name }}</h1>
                <p class="card-text">{{ $tag->description }}</p>
            </div>
        </div><!-- /.card -->
    </aside>
@stop