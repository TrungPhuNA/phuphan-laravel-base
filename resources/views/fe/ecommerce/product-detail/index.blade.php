
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Item - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="{{ asset("fe/css/bootstrap-icons.css") }}" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset("fe/css/styles.css") }}" rel="stylesheet" />
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="#!">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">All Products</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                        <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <button class="btn btn-outline-dark" type="submit">
                    <i class="bi-cart-fill me-1"></i>
                    Cart
                    <span class="badge bg-dark text-white ms-1 rounded-pill">0</span>
                </button>
            </form>
        </div>
    </div>
</nav>
<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6">
                <img class="card-img-top mb-5 mb-md-0" src="{{ $product->image ?? 'https://dummyimage.com/600x700/dee2e6/6c757d.jpg' }}" alt="{{ $product->name }}" />
            </div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>

                <!-- Giá sản phẩm -->
                <div class="fs-5 mb-3">
                    @if($product->sale_price)
                        <span class="text-decoration-line-through text-muted">{{ number_format($product->regular_price, 0, ',', '.') }}₫</span>
                        <span class="text-danger fw-bold">{{ number_format($product->sale_price, 0, ',', '.') }}₫</span>
                    @else
                        <span>{{ number_format($product->regular_price, 0, ',', '.') }}₫</span>
                    @endif
                </div>

                <!-- Hiển thị tất cả thuộc tính nhưng chỉ cho phép chọn những biến thể có tồn tại -->
                @foreach($attributes as $attribute)
                    <div class="mb-3">
                        <label class="fw-bold">{{ $attribute->name }}:</label>
                        <div class="d-flex flex-wrap">
                            @foreach($attribute->attributeValues as $value)
                                @php
                                    // Kiểm tra xem giá trị này có trong biến thể của sản phẩm không
                                    $isAvailable = $product->variants->contains(function ($variant) use ($value) {
                                        return $variant->attributes->contains('attribute_value_id', $value->id);
                                    });
                                @endphp

                                <button class="btn me-2 mb-2 variant-option
                                            {{ $isAvailable ? 'btn-outline-secondary' : 'btn-light disabled' }}"
                                        data-attribute-id="{{ $attribute->id }}"
                                        data-value-id="{{ $value->id }}"
                                        {{ $isAvailable ? '' : 'disabled' }}>
                                    {{ $value->title }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Nhập số lượng -->
                <div class="d-flex align-items-center">
                    <input class="form-control text-center me-3" id="inputQuantity" type="number" value="1" min="1" style="max-width: 3rem">
                    <button class="btn btn-outline-dark flex-shrink-0 add-to-cart"
                            type="button"
                            data-product-id="{{ $product->id }}">
                        <i class="bi-cart-fill me-1"></i> Add to cart
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Fancy Product</h5>
                            <!-- Product price-->
                            $40.00 - $80.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">View options</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Special Item</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            <span class="text-muted text-decoration-line-through">$20.00</span>
                            $18.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Sale Item</h5>
                            <!-- Product price-->
                            <span class="text-muted text-decoration-line-through">$50.00</span>
                            $25.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Product image-->
                    <img class="card-img-top" src="https://dummyimage.com/450x300/dee2e6/6c757d.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Popular Item</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            $40.00
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="{{ asset("fe/js/bootstrap.bundle.min.js") }}"></script>
</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let selectedVariants = {};

        // Xử lý chọn biến thể động
        document.querySelectorAll(".variant-option:not(.disabled)").forEach(button => {
            button.addEventListener("click", function () {
                let attributeId = this.getAttribute("data-attribute-id");
                let valueId = this.getAttribute("data-value-id");

                // Đánh dấu button được chọn
                document.querySelectorAll(`.variant-option[data-attribute-id="${attributeId}"]`).forEach(btn => {
                    btn.classList.remove("btn-dark");
                });
                this.classList.add("btn-dark");

                // Lưu biến thể được chọn
                selectedVariants[attributeId] = valueId;
            });
        });

        // Thêm vào giỏ hàng
        document.querySelector(".add-to-cart").addEventListener("click", function () {
            let productId = this.getAttribute("data-product-id");
            let quantity = document.getElementById("inputQuantity").value;

            if (Object.keys(selectedVariants).length === 0) {
                alert("Vui lòng chọn đầy đủ biến thể trước khi thêm vào giỏ hàng!");
                return;
            }

            let cartItem = {
                product_id: productId,
                quantity: quantity,
                variants: selectedVariants
            };

            let cart = JSON.parse(localStorage.getItem("cart")) || [];
            cart.push(cartItem);
            localStorage.setItem("cart", JSON.stringify(cart));

            alert("Sản phẩm đã được thêm vào giỏ hàng!");
        });
    });

</script>
