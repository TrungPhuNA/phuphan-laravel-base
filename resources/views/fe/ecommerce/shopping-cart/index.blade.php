@extends("fe.layouts.app_master_frontend")
@section("content")
    <div class="container my-5">
        <h2 class="fw-bold">🛒 GIỎ HÀNG</h2>

        @if($cartItems->isEmpty())
            <p class="text-center text-muted">Giỏ hàng trống!</p>
        @else
            <div class="card mt-3">
                <div class="card-body">
                    <table class="table align-middle">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
                            <th>Sản phẩm</th>
                            <th>Biến thể</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="cart-items">
                        @foreach($cartItems as $item)
                            <tr data-id="{{ $item->id }}">
                                <td><input type="checkbox" class="product-select"></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->attributes->image }}" class="me-2" width="80">
                                        <div>
                                            <p class="mb-0 fw-bold">{{ $item->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0">{{ $item->attributes->variant }}</p>
                                </td>
                                <td>
                                    <span class="text-danger fw-bold">{{ number_format($item->price, 0, ',', '.') }}₫</span>
                                </td>
                                <td>
                                    <div class="input-group quantity-group">
                                        <button class="btn btn-outline-secondary btn-decrease">-</button>
                                        <input type="text" class="form-control text-center quantity" value="{{ $item->quantity }}" style="max-width: 50px;">
                                        <button class="btn btn-outline-secondary btn-increase">+</button>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-danger total-price">{{ number_format($item->price * $item->quantity, 0, ',', '.') }}₫</span>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm btn-remove"><i class="fas fa-trash-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tổng tiền -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">🎟️ Mã giảm giá</h5>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Nhập mã giảm giá">
                                <button class="btn btn-primary">Áp dụng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">💰 Thanh toán</h5>
                            <p>Tổng tiền hàng: <span class="float-end fw-bold" id="total-amount">0₫</span></p>
                            <button class="btn btn-danger w-100 mt-2">Mua hàng</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateTotalAmount() {
                let total = 0;
                document.querySelectorAll(".total-price").forEach(price => {
                    total += parseInt(price.textContent.replace(/\D/g, ""));
                });
                document.getElementById("total-amount").textContent = new Intl.NumberFormat("vi-VN").format(total) + "₫";
            }

            document.querySelectorAll(".btn-increase").forEach(btn => {
                btn.addEventListener("click", function() {
                    let row = this.closest("tr");
                    let input = row.querySelector(".quantity");
                    let newQty = parseInt(input.value) + 1;
                    input.value = newQty;

                    fetch("{{ route('cart.update') }}", {
                        method: "POST",
                        headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "Content-Type": "application/json" },
                        body: JSON.stringify({ id: row.dataset.id, quantity: newQty })
                    }).then(() => updateTotalAmount());
                });
            });

            document.querySelectorAll(".btn-decrease").forEach(btn => {
                btn.addEventListener("click", function() {
                    let row = this.closest("tr");
                    let input = row.querySelector(".quantity");
                    if (parseInt(input.value) > 1) {
                        let newQty = parseInt(input.value) - 1;
                        input.value = newQty;

                        fetch("{{ route('cart.update') }}", {
                            method: "POST",
                            headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "Content-Type": "application/json" },
                            body: JSON.stringify({ id: row.dataset.id, quantity: newQty })
                        }).then(() => updateTotalAmount());
                    }
                });
            });

            updateTotalAmount();
        });
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".remove-item").forEach(button => {
                button.addEventListener("click", function () {
                    let itemId = this.getAttribute("data-id");

                    fetch("{{ route('cart.remove') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ id: itemId })
                    }).then(response => response.json())
                        .then(data => location.reload());
                });
            });
        });
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".cart-quantity").forEach(input => {
                input.addEventListener("change", function () {
                    let itemId = this.getAttribute("data-id");
                    let quantity = this.value;

                    fetch("{{ route('cart.update') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({ id: itemId, quantity: quantity })
                    }).then(response => response.json())
                        .then(data => location.reload());
                });
            });
        });
        document.querySelector(".checkout-button").addEventListener("click", function () {
            fetch("{{ route('cart.checkout') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Đặt hàng thành công!");
                        window.location.href = "/thank-you";
                    } else {
                        alert(data.error);
                    }
                });
        });
    </script>
@stop
