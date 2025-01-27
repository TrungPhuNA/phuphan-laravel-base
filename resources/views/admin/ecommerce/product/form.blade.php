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
@stop