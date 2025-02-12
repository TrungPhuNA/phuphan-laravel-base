<form action="" method="POST" autocomplete="off" class="needs-validation" novalidate id="form-product">
    @csrf
    <div class="row">
        <div class="col-9 col-xl-9">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Thông tin</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old("name", $product->name ?? "") }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="" class="form-control @error('description')  is-invalid @enderror" required cols="30" rows="3">{{ old("description", $product->description ?? "") }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea name="contents" id="" class="form-control @error('contents')  is-invalid @enderror" required cols="30" rows="3">{{ old("contents", $product->contents ?? "") }}</textarea>
                        @error('contents')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card">
                <!-- Nút mở modal -->
                <div class="card-body">
                    <div class="d-flex">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#attributeModal">
                            Edit attribute
                        </button>
                        <button type="button" class="btn btn-success" style="margin-left: 10px" id="add-variant">
                            Add new variation
                        </button>
                    </div>
                </div>
                <!-- Modal chọn thuộc tính -->
                <div class="modal fade" id="attributeModal" tabindex="-1" aria-labelledby="attributeModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Select attribute</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-warning">
                                    <i class="fas fa-exclamation-circle"></i> This action will reload the page to update the data!
                                </p>
                                <div class="mb-3">
                                    @foreach($attributes as $attribute)
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input attribute-checkbox" id="attribute-{{ $attribute->id }}" value="{{ $attribute->id }}">
                                            <label class="form-check-label" for="attribute-{{ $attribute->id }}">{{ $attribute->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="save-attributes">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bảng danh sách biến thể -->
                <div class="table-responsive mt-3">
                    <table class="table table-striped">
                        <thead>
                            <tr id="variant-header-row">
                                <th><input type="checkbox"></th>
                                <th>ID</th>
                                <th>Image</th>
                                @foreach($selectedAttributes ?? [] as $attribute)
                                    <th data-attr-id="{{ $attribute->id }}">{{ $attribute->name }}</th>
                                @endforeach
                                <th style="width: 200px">Price</th>
                                <th style="width: 100px">Quantity</th>
                                <th>Is Default</th>
                            </tr>
                        </thead>
                        <tbody id="variants-container">
                        @foreach($variants ?? [] as $variant)
                            <tr>
                                <td><input type="checkbox" name="selected_variants[]" value="{{ $variant->id }}"></td>
                                <td>{{ $variant->id }}</td>
                                <td><img src="{{ $variant->image ?? config("setting.image_default") }}" width="50"></td>
                                @foreach($selectedAttributes ?? [] as $attribute)
                                    <td>
                                        <select name="variants[{{ $variant->id }}][attributes][{{ $attribute->id }}]" class="form-control">
                                            @foreach($attribute->attributeValues as $value)
                                                <option value="{{ $value->id }}" {{ $variant->attribute_values[$attribute->id] == $value->id ? 'selected' : '' }}>
                                                    {{ $value->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                @endforeach
                                <td><input type="text" name="variants[{{ $variant->id }}][price]" class="form-control price-input" value="{{ number_format($variant->price, 0, ',', '.') }}" required></td>
                                <td><input type="number" name="variants[{{ $variant->id }}][stock]" class="form-control" value="{{ $variant->stock }}" required></td>
                                <td><input type="radio" name="default_variant" value="{{ $variant->id }}" {{ $variant->is_default ? 'checked' : '' }}></td>
                                <input type="hidden" name="variants[{{ $variant->id }}][id]" class="form-control" value="{{ $variant->id }}">
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-3 col-xl-3">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Xuất bản</h5>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="save"></i> Xác nhận</button>
                    <a href="{{ route("admin.ecommerce.product.index") }}" class="btn btn-danger"><i class="align-middle" data-feather="rotate-ccw"></i> Trở về</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Trạng thái</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <select name="status" class="form-control @error('status')  is-invalid @enderror" id="" required>
                            <option value="draft" {{ old("status", $product->status ?? "") == "draft" ? "selected" : "" }}>Draft</option>
                            <option value="published" {{ old("status", $product->status ?? "") == "published" ? "selected" : "" }}>Published</option>
                            <option value="pending" {{ old("status", $product->status ?? "") == "pending" ? "selected" : "" }}>Pending</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Chuyên mục</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <select name="category_id" class="form-control @error('category_id')  is-invalid @enderror" id="" required>
                            @foreach($categories ?? [] as $item)
                                <option value="{{ $item->id }}" {{ old("category_id", $product->category_id ?? "") == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Thương hiệu</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <select name="brand_id" class="form-control @error('brand_id')  is-invalid @enderror" id="" required>
                            @foreach($brands ?? [] as $item)
                                <option value="{{ $item->id }}" {{ old("brand_id", $product->brand_id ?? "") == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Nhãn</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <select name="labels[]" class="form-control" id="labels" multiple>
                            @foreach($labels ?? [] as $item)
                                <option style="font-size: 14px" value="{{ $item->id }}" {{ in_array($item->id, $labelsActive ?? []) ? "selected" : "" }} >{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@section("script")
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $( '#labels' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
    } );
</script>

<script>
    let imgDefault = "{{ config("setting.image_default") }}";
    document.addEventListener("DOMContentLoaded", function () {
        let variantIndex = document.querySelectorAll("#variants-container tr").length;

        let url = new URL(window.location.href);
        let params = new URLSearchParams(url.search);
        // Kiểm tra nếu selected_attributes chưa có trong URL
        if (!params.has("selected_attributes")) {
            params.set("selected_attributes", "{{ implode(',', $selectedAttributes ? $selectedAttributes->pluck('id')->toArray() : []) }}");

            // Cập nhật URL mà không reload trang
            window.history.replaceState({}, "", `${url.pathname}?${params.toString()}`);
        }

        let selectedAttributes = new URLSearchParams(window.location.search).get("selected_attributes")?.split(",") || [];
        console.info("======= selectedAttributes; ", selectedAttributes);
        selectedAttributes.forEach(attrId => {
            let checkbox = document.getElementById(`attribute-${attrId}`);
            if (checkbox) {
                checkbox.checked = true;
            }
        });

        function formatPriceInput(input) {
            let value = input.value.replace(/\D/g, ""); // Chỉ giữ số
            if (value !== "") {
                value = Number(value).toLocaleString("vi-VN"); // Định dạng kiểu Việt Nam
            }
            input.value = value;
        }

        function updateHeaderAttributes() {
            let headerRow = document.getElementById("variant-header-row");
            document.querySelectorAll(".dynamic-variant-th").forEach(el => el.remove());

            selectedAttributes.forEach(attrId => {
                let label = document.querySelector(`label[for="attribute-${attrId}"]`)?.innerText || `Attribute ${attrId}`;
                let th = document.createElement("th");
                th.classList.add("dynamic-variant-th");
                th.setAttribute("data-attr-id", attrId);
                th.innerText = label;
                headerRow.insertBefore(th, headerRow.children[headerRow.children.length - 4]);
            });
        }

        function updateBodyAttributes(selectedAttributes) {
            document.querySelectorAll("#variants-container tr").forEach(row => {
                let attributesHtml = "";

                selectedAttributes.forEach(attr => {
                    attributesHtml += `
                    <td>
                        <select name="variants[${variantIndex}][attributes][${attr}]" class="form-control">
                            <!-- Các option sẽ được fetch từ backend -->
                        </select>
                    </td>`;
                });

                row.insertAdjacentHTML("afterbegin", attributesHtml);
            });
        }
        // Hàm fetch danh sách giá trị thuộc tính từ backend
        async function fetchAttributeValues(attributeId) {
            try {
                let response = await fetch(`/admin/ecommerce/attribute/values/${attributeId}`);
                let data = await response.json();
                return data; // Trả về danh sách giá trị thuộc tính
            } catch (error) {
                console.error("Lỗi khi fetch attribute values: ", error);
                return [];
            }
        }


        // updateHeaderAttributes();
        document.getElementById("save-attributes").addEventListener("click", function () {
            let selectedAttributes = [];
            let selectedLabels = [];

            // document.querySelectorAll(".attribute-checkbox:checked").forEach(attr => {
            //     selectedAttributes.push(attr.value);
            //     let label = document.querySelector(`label[for="attribute-${attr.value}"]`).innerText;
            //     selectedLabels.push(label);
            // });

            let checkedAttributes = [];
            document.querySelectorAll(".attribute-checkbox:checked").forEach(attr => {
                checkedAttributes.push(attr.value);
            });

            if (checkedAttributes.length === 0) {
                alert("Please select at least one attribute!");
                return;
            }

            // updateHeaderAttributes(selectedAttributes, selectedLabels);
            // updateBodyAttributes(selectedAttributes);
            selectedAttributes = checkedAttributes;
            updateHeaderAttributes();

            console.info("Selected Attributes:", selectedAttributes, "Labels:", selectedLabels);

            // Lưu vào URL mà không reload
            let url = new URL(window.location.href);
            url.searchParams.set("selected_attributes", selectedAttributes.join(","));
            history.replaceState(null, "", url.toString());

            // Đóng modal sau khi chọn
            document.querySelector("#attributeModal .btn-close").click();
        });

        document.getElementById("add-variant").addEventListener("click", async function () {
            console.info("============ ADD ============", )
            let variantsContainer = document.getElementById("variants-container");
            let newRow = document.createElement("tr");

            let attributesHtml = "";
            // let selectedAttributes = new URLSearchParams(window.location.search).get("selected_attributes")?.split(",") || [];

            let selectedAttributes = [];
            document.querySelectorAll(".attribute-checkbox:checked").forEach(attr => {
                selectedAttributes.push(attr.value);
            });

            console.log("Selected Attributes: ", selectedAttributes);

            for (let attr of selectedAttributes) {
                let values = await fetchAttributeValues(attr); // Lấy danh sách giá trị thuộc tính
                attributesHtml += `
                <td>
                    <select name="variants[${variantIndex}][attributes][${attr}]" class="form-control">
                        ${values.map(value => `<option value="${value.id}">${value.title}</option>`).join("")}
                    </select>
                </td>`;
            }

            newRow.innerHTML = `
            <td><input type="checkbox" name="selected_variants[]" value=""></td>
            <td>New</td>
            <td>
                <img src="${imgDefault}" width="50">
            </td>
            ${attributesHtml}
            <td><input type="text" name="variants[${variantIndex}][price]" class="form-control price-input" required></td>
            <td><input type="number" name="variants[${variantIndex}][stock]" class="form-control" required></td>
            <td><input type="radio" name="default_variant" value=""></td>
        `;

            variantsContainer.appendChild(newRow);
            variantIndex++;
            feather.replace();
        });

        // Xóa biến thể
        document.getElementById("variants-container").addEventListener("click", function (event) {
            if (event.target.closest(".remove-variant")) {
                event.target.closest("tr").remove();
            }
        });
        document.querySelectorAll(".price-input").forEach(input => {
            input.addEventListener("input", function (e) {
                let value = e.target.value.replace(/\D/g, ""); // Xóa hết ký tự không phải số
                value = Number(value).toLocaleString("vi-VN"); // Định dạng theo chuẩn Việt Nam
                e.target.value = value;
            });
        });

        document.getElementById("form-product").addEventListener("submit", function () {
            document.querySelectorAll(".price-input").forEach(input => {
                input.value = input.value.replace(/\./g, ""); // Xóa dấu "." trước khi submit
            });
        });

        document.addEventListener("input", function (e) {
            if (e.target.classList.contains("price-input")) {
                formatPriceInput(e.target);
            }
        });
    });

</script>

@stop