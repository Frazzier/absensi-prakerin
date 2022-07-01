@extends('layouts.main')

@section('pre-css')
<!-- dropify -->
<link href="/assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<div class="card-box">
    <form action="/setting" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="app_name">Nama Aplikasi</label>
                    <input type="text" name="app_name" class="form-control" id="app_name" placeholder="Masukan nama aplikasi" value="{{$setting->app_name}}">
                </div>
            </div>
            <div class="col-md-4">
                <h4 class="header-title mt-0 mb-3">Logo</h4>
                <input type="file" name="logo" class="dropify" @if($setting->logo) data-default-file="{{$setting->logo}}" @endif />
            </div><!-- end col -->

            <div class="col-md-4">
                <h4 class="header-title mt-0 mb-3">Small Logo</h4>
                <input type="file" name="small_logo" class="dropify" @if($setting->small_logo) data-default-file="{{$setting->small_logo}}" @endif />
            </div><!-- end col -->

            <div class="col-md-4">
                <h4 class="header-title mt-0 mb-3">Login Background</h4>
                <input type="file" name="login_background" class="dropify" @if($setting->login_background) data-default-file="{{$setting->login_background}}" @endif />
            </div>
            <div class="col-12 mt-2">
                <button class="btn btn-sm btn-primary float-right">Simpan Perubahan</button>
            </div>
        </div>
    </form>
</div>
@endsection

@section('script')
<!-- dropify js -->
<script src="/assets/libs/dropify/dropify.min.js"></script>
<script>
    $(".dropify").dropify({
        messages: { 
            default: "Drag and drop a file here or click", 
            replace: "Drag and drop or click to replace", 
            error: "Ooops, something wrong appended." },
        error: { fileSize: "The file size is too big (1M max)." },
    });
</script>
@endsection