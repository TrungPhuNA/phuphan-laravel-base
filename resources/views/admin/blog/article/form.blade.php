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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old("name", $article->name ?? "") }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" id="" class="form-control @error('description')  is-invalid @enderror" required cols="30" rows="3">{{ old("description", $article->description ?? "") }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea name="content" id="my-editor" class="form-control @error('content')  is-invalid @enderror" required cols="30" rows="3">{{ old("content", $article->content ?? "") }}</textarea>
                        @error('content')
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
                    <a href="{{ route("admin.blog.article.index") }}" class="btn btn-danger"><i class="align-middle" data-feather="rotate-ccw"></i> Trở về</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">Trạng thái</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <select name="status" class="form-control @error('status')  is-invalid @enderror" id="" required>
                            <option value="draft" {{ old("status", $article->status ?? "") == "draft" ? "selected" : "" }}>Draft</option>
                            <option value="published" {{ old("status", $article->status ?? "") == "published" ? "selected" : "" }}>Published</option>
                            <option value="pending" {{ old("status", $article->status ?? "") == "pending" ? "selected" : "" }}>Pending</option>
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
                        <select name="menu_id" class="form-control @error('menu_id')  is-invalid @enderror" id="" required>
                            @foreach($menus ?? [] as $item)
                                <option value="{{ $item->id }}" {{ old("menu_id", $article->menu_id ?? "") == $item->id ? "selected" : "" }}>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">Từ khoá</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <select name="tags_id[]" class="form-control" id="tags" multiple>
                            @foreach($tags ?? [] as $item)
                                <option value="{{ $item->id }}" {{ in_array($item->id, $tagsActive) ? "selected" : "" }} >{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">Avatar</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="button" class="btn btn-primary" id="lfm" data-input="thumbnail" data-preview="holder" value="Upload">
                            <input id="thumbnail" class="form-control" type="text" name="avatar" value="{{ $article->avatar ?? config("setting.image_default") }}">
                        </div>
                        <img id="holder" style="margin-top:15px;max-height:100px;" src="{{ $article->avatar ?? config("setting.image_default") }}">
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
    $( '#tags' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
    } );
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script>
    var options = {
        filebrowserImageBrowseUrl: '/filemanager?type=image',
        // filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/filemanager?type=Files',
        filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
    };
</script>
<script>
    $('#lfm').filemanager('image');
    CKEDITOR.replace('my-editor', options);
</script>
@stop