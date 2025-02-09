@extends("fe.layouts.app_master_frontend")
@section("content")
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0"
                         src="{{ $product->image ?? 'https://dummyimage.com/600x700/dee2e6/6c757d.jpg' }}"
                         alt="{{ $product->name }}" />
                </div>
                <div class="col-md-6">
                    <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>

                    <!-- Giá sản phẩm -->
                    <div class="fs-5 mb-3">
                        @if($product->sale_price)
                            <span class="text-decoration-line-through text-muted">
                            {{ number_format($product->regular_price, 0, ',', '.') }}₫
                        </span>
                            <span class="text-danger fw-bold">
                            {{ number_format($product->sale_price, 0, ',', '.') }}₫
                        </span>
                        @else
                            <span>{{ number_format($product->regular_price, 0, ',', '.') }}₫</span>
                        @endif
                    </div>

                    <!-- Nếu có biến thể, hiển thị -->
                    @if(!$product->variants->isEmpty())
                        @foreach($attributes as $attribute)
                            <div class="mb-3">
                                <label class="fw-bold">{{ $attribute->name }}:</label>
                                <div class="d-flex flex-wrap">
                                    @foreach($attribute->attributeValues as $value)
                                        @php
                                            // Kiểm tra giá trị này có trong biến thể không
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
                    @endif

                    <!-- Nhập số lượng -->
                    <div class="d-flex align-items-center">
                        <input class="form-control text-center me-3"
                               id="inputQuantity" type="number" value="1" min="1" style="max-width: 3rem">
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
    @include("fe.ecommerce.product-detail.include._inc_related_product",["products" => $productsRelated ?? []])

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let selectedVariants = {};
            let hasVariants = {{ !$product->variants->isEmpty() ? 'true' : 'false' }};

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

                if (hasVariants && Object.keys(selectedVariants).length === 0) {
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

                // Gửi dữ liệu lên server
                fetch("{{ route('cart.add') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(cartItem)
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                    })
                    .catch(error => console.error("Lỗi khi thêm vào giỏ hàng:", error));
            });
        });
    </script>
@stop
