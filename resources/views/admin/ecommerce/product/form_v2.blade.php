<form action="" method="POST" autocomplete="off" class="needs-validation" novalidate>
    @csrf
    <div class="row">
        <div class="col-9 col-xl-9">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">Thông tin</h5>
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
                <div class="card-header border-bottom">
                    <h5 class="card-title">Danh sách Biến thể</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>ID</th>
                                <th>Image</th>
                                @foreach($attributes as $attribute)
                                    <th>{{ $attribute->name }}</th>
                                @endforeach
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Is Default</th>
                                <th>Operations</th>
                            </tr>
                            </thead>
                            <tbody id="variants-container">
                            @foreach($variants ?? [] as $variant)
                                <tr>
                                    <td><input type="checkbox" name="selected_variants[]" value="{{ $variant->id }}"></td>
                                    <td>{{ $variant->id }}</td>
                                    <td>
                                        <img src="{{ $variant->image ?? 'default.jpg' }}" width="50">
                                    </td>
                                    @foreach($attributes as $attribute)
                                        <td>
                                            <select name="variants[{{ $variant->id }}][attributes][{{ $attribute->id }}]" class="form-control">
                                                @foreach($attribute->attributeValues as $value)
                                                    <option value="{{ $value->id }}"
                                                            {{ isset($variant->attribute_values[$attribute->name]) && $variant->attribute_values[$attribute->name] == $value->id ? 'selected' : '' }}>
                                                        {{ $value->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                    @endforeach

                                    <td>
                                        <input type="number" name="variants[{{ $variant->id }}][price]" class="form-control" value="{{ $variant->price }}" required>
                                    </td>
                                    <td>
                                        <input type="number" name="variants[{{ $variant->id }}][stock]" class="form-control" value="{{ $variant->stock }}" required>
                                    </td>
                                    <td>
                                        <input type="radio" name="default_variant" value="{{ $variant->id }}" {{ $variant->is_default ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger remove-variant">
                                            <i class="align-middle" data-feather="trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <button type="button" class="btn btn-success mt-2" id="add-variant">Thêm biến thể</button>
                </div>
            </div>

        </div>
        <div class="col-3 col-xl-3">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">Xuất bản</h5>
                </div>
                <div class="card-body">
                    <button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="save"></i> Xác nhận</button>
                    <a href="{{ route("admin.ecommerce.product.index") }}" class="btn btn-danger"><i class="align-middle" data-feather="rotate-ccw"></i> Trở về</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">Trạng thái</h5>
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
                    <h5 class="card-title">Chuyên mục</h5>
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
                    <h5 class="card-title">Thương hiệu</h5>
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
                    <h5 class="card-title">Nhãn</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <select name="labels[]" class="form-control" id="labels" multiple>
                            @foreach($labels ?? [] as $item)
                                <option value="{{ $item->id }}" {{ in_array($item->id, $labelsActive ?? []) ? "selected" : "" }} >{{ $item->name }}</option>
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
        document.addEventListener("DOMContentLoaded", function () {
            let variantIndex = {{ count($variants) }}; // Bắt đầu từ số lượng biến thể hiện có

            document.getElementById("add-variant").addEventListener("click", function () {
                let variantsContainer = document.getElementById("variants-container");

                let newRow = document.createElement("tr");
                newRow.innerHTML = `
                <td><input type="checkbox" name="selected_variants[]" value=""></td>
                <td>New</td>
                <td><input type="file" name="variants[${variantIndex}][image]" class="form-control"></td>

                @foreach($attributes as $attribute)
                <td>
                    <select name="variants[${variantIndex}][attributes][{{ $attribute->id }}]" class="form-control">
                            @foreach($attribute->attributeValues as $value)
                <option value="{{ $value->id }}">{{ $value->title }}</option>
                            @endforeach
                </select>
            </td>
@endforeach

                <td><input type="number" name="variants[${variantIndex}][price]" class="form-control" required></td>
                <td><input type="number" name="variants[${variantIndex}][stock]" class="form-control" required></td>
                <td><input type="radio" name="default_variant" value=""></td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger remove-variant">
                        <i class="align-middle" data-feather="trash"></i>
                    </button>
                </td>
            `;

                variantsContainer.appendChild(newRow);
                variantIndex++;

                // Cập nhật lại icons Feather
                feather.replace();
            });

            // Xóa biến thể khi nhấn vào nút xóa
            document.getElementById("variants-container").addEventListener("click", function (event) {
                if (event.target.closest(".remove-variant")) {
                    event.target.closest("tr").remove();
                }
            });
        });
    </script>

@stop