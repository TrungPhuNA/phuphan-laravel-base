@extends("admin.layouts.admin_master")
@section("title_page","Setting Ads")
@section("content")
    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Cấu hình ADS</h1>

            <div class="row">
                <div class="col-md-3 col-xl-3">
                    <div class="card">
                        <div class="list-group list-group-flush" role="tablist">
                            <a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#account" role="tab" aria-selected="true">
                                Manage ads settings
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-xl-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Thông tin</h5>
                        </div>
                        <div class="card-body">
                            <form action=""  method="POST" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="mb-3 col-md-12">
                                        <label class="form-label" for="name">Google AdSense Auto Ads Snippet</label>
                                        <textarea type="text" class="form-control" rows="5" name="manage_ads_setting">{{ old("manage_ads_setting", $setting->manage_ads_setting ?? null) }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputAddress">Ads Client ID</label>
                                    <input type="text" class="form-control" name="ads_client_id" placeholder="ca-pub-123456789" value="{{ $setting->ads_client_id ?? '' }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="inputAddress">Google Adsense ads.txt</label>
                                    <input type="file" class="form-control @error('adsense_ads_file') is-invalid @enderror" name="adsense_ads_file">
                                    @error('adsense_ads_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                @if(!empty($setting->adsense_ads_file))
                                    <p>Download file <a href="{{ asset($setting->adsense_ads_file) }}" download="">{{ $setting->adsense_ads_file }}</a></p>
                                @endif
                                <button type="submit" class="btn btn-primary" id="save-settings-btn">Save changes</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop