<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach($products as $item)
                <div class="col mb-5">
                    <div class="card h-100">
                        <img class="card-img-top" src="{{ $item->avatar }}" alt="{{ $item->name }}" onerror="this.src={{ config("setting.image_default") }}" />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder">{{ $item->name }}</h5>
                                $40.00 - $80.00
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route("get.product.detail", $item->slug) }}" title="{{ $item->name }}">Chi tiết</a></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>