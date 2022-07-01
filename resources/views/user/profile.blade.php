@extends('layouts.main')

@section('pre-css')
<!-- dropify -->
<link href="/assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<div class="card-box">
    <form action="/profile/{{auth()->user()->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row">
            <div class="col-12 col-md-4">
                <h4 class="header-title mt-0 mb-3">Foto</h4>
                <input type="file" name="profile_picture" class="dropify"/>
                <div class="mt-2">
                    <p class="text-muted mb-1"> Keterangan : </p>
                    <span class="text-danger">*)</span> Wajib diisi
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="row">
                    <div class="col-12 mb-2" style="border-left: 5px solid #f0ad4e; border-radius: 5px;"><h5>Identitas</h5></div>
                    <div class="form-group col-12 col-md-6">
                        <label for="name"><span class="text-danger">*)</span> Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{auth()->user()->name}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="email"><span class="text-danger">*)</span> Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{auth()->user()->email}}">
                    </div>
                    <div class="col-12 mb-2" style="border-left: 5px solid #f0ad4e; border-radius: 5px;"><h5>Ganti Password</h5></div>
                    <div class="form-group col-12 col-md-6">
                        <label for="password"><span class="text-danger"></span> Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="password_confirmation"><span class="text-danger"></span> Konfirmasi Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    </div>
            </div>
            <div class="col-12 mt-2">
                <button class="btn btn-primary btn-sm float-right">Simpan Perubahan</button>
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