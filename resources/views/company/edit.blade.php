@extends('layouts.main')

@section('pre-css')
<!-- dropify -->
<link href="/assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<div class="card-box">
    <form action="/company/{{$company->id}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 mb-2" style="border-left: 5px solid #f0ad4e; border-radius: 5px;"><h5>Identitas</h5></div>
                    <div class="form-group col-12">
                        <label for="name"><span class="text-danger">*)</span> Nama</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name') ?? $company->name}}">
                    </div>
                    <div class="form-group col-12">
                        <label for="adress"><span class="text-danger">*)</span> Alamat</label>
                        <textarea class="form-control" name="address" id="address" rows="5">{{old('address') ?? $company->address}}</textarea>
                    </div>
            </div>
            <div class="col-12 mt-2">
                <button class="btn btn-primary btn-sm float-right">Simpan</button>
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