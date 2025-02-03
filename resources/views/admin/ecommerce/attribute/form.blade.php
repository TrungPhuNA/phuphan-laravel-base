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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old("name", $attribute->name ?? "") }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">Value thuộc tính</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h4 class="card-title">Title</h4>
                        </div>
                        <div class="col-sm-1">
                            <h4 class="card-title">Color</h4>
                        </div>
                        <div class="col-sm-2">
                            <h4 class="card-title">Image</h4>
                        </div>
                        <div class="col-sm-2">
                            <h4 class="card-title">Action</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div id="wrap-row-option">
                            @if(isset($attributeValues) && !$attributeValues->IsEmpty())
                                @foreach($attributeValues as $key => $value)
                                    <div class="row row-menu {{ $key == 0 ? 'row-option-temple' : '' }} mb-2">
                                        <div class="col-sm-3">
                                            <div class="form-group mlr-10">
                                                <input type="text" style="height: 35px" class="form-control" name="values[title][]"
                                                       value="{{ $value->title }}"
                                                       placeholder="S"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group mlr-10">
                                                <input type="color" class="form-control" name="values[color][]"
                                                       value="{{ $value->color }}" style="height: 35px"
                                                       placeholder=""/>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group mlr-10">

                                            </div>
                                        </div>
                                        <div class="col-md-2 action-row-menu hide">
                                            <div class="form-group">
                                                <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-remove"><i class="align-middle" data-feather="trash"></i>  </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="row row-menu row-option-temple mb-2">
                                    <div class="col-sm-3">
                                        <div class="form-group mlr-10">
                                            <input type="text" style="height: 35px" class="form-control" name="values[title][]"
                                                   value=""
                                                   placeholder="S"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <div class="form-group mlr-10">
                                            <input type="color" class="form-control" name="values[color][]"
                                                   value="" style="height: 35px"
                                                   placeholder=""/>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group mlr-10">

                                        </div>
                                    </div>
                                    <div class="col-md-2 action-row-menu hide">
                                        <div class="form-group">
                                            <a href="javascript:void(0)" class="btn btn-sm btn-danger btn-remove"><i class="align-middle" data-feather="trash"></i>  </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group mt-2">
                            <a id="copy_option" class="col-sm-12" href="javascript:void(0)"><i class="fa fa-plus"></i> Thêm option</a>
                        </div>
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
                    <a href="{{ route("admin.ecommerce.attribute.index") }}" class="btn btn-danger"><i class="align-middle" data-feather="rotate-ccw"></i> Trở về</a>
                </div>
            </div>
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title">Trạng thái</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <select name="status" class="form-control @error('status')  is-invalid @enderror" id="" required>
                            <option value="draft" {{ old("status", $attribute->status ?? "") == "draft" ? "selected" : "" }}>Draft</option>
                            <option value="published" {{ old("status", $attribute->status ?? "") == "published" ? "selected" : "" }}>Published</option>
                            <option value="pending" {{ old("status", $attribute->status ?? "") == "pending" ? "selected" : "" }}>Pending</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@section("script")
    <script>
        $(function (){
            $('#copy_option').off('click').click(function () {
                let $rowMenu = $('.row-option-temple').clone().removeClass('row-option-temple');
                $rowMenu.find('.action-row-menu').removeClass('hide');
                $('#wrap-row-option').append($rowMenu);
            })
        })
    </script>
@stop