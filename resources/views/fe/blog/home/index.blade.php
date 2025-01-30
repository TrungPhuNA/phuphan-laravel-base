@extends("fe.blog.layouts.app_blog_master")
@section("content")
    <div class="row">
        @foreach($articles->chunk(3) as $articlesHome)
            @foreach($articlesHome as $item)
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
        @endforeach
    </div>
@stop