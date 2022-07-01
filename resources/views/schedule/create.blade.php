@extends('layouts.main')

@section('pre-css')
        <link href="/assets/libs/multiselect/multi-select.css"  rel="stylesheet" type="text/css" />
        <link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <form action="/schedule" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label for="student_ids">Siswa</label>
                        <select class="select2 select2-multiple" multiple="multiple" multiple data-placeholder="Choose ..." id="student_ids" name="student_ids[]">
                            @foreach ($students as $student)
                                <option value="{{$student->id}}">{{ucwords($student->user->name)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <p class="text-muted mb-1"> *) Kosongkan kolom jam masuk dan keluar jika libur / tidak masuk</p>
                    </div>
            
                    <div class="form-group col-12 col-md-6">
                        <label for="start">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="start" id="start" value="{{old('start')}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="end">Tanggal Selesai</label>
                        <input type="date" class="form-control" name="end" id="end" value="{{old('end')}}">
                    </div>
            
                    <div class="form-group col-12 col-md-6">
                        <label for="monday_in">Jam Masuk Senin</label>
                        <input type="time" class="form-control" name="monday_in" id="monday_in" value="{{old('monday_in')}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="monday_out">Jam Keluar Senin</label>
                        <input type="time" class="form-control" name="monday_out" id="monday_out" value="{{old('monday_out')}}">
                    </div>
            
                    <div class="form-group col-12 col-md-6">
                        <label for="tuesday_in">Jam Masuk Selasa</label>
                        <input type="time" class="form-control" name="tuesday_in" id="tuesday_in" value="{{old('tuesday_in')}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="tuesday_out">Jam Keluar Selasa</label>
                        <input type="time" class="form-control" name="tuesday_out" id="tuesday_out" value="{{old('tuesday_out')}}">
                    </div>
            
                    <div class="form-group col-12 col-md-6">
                        <label for="wednesday_in">Jam Masuk Rabu</label>
                        <input type="time" class="form-control" name="wednesday_in" id="wednesday_in" value="{{old('wednesday_in')}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="wednesday_out">Jam Keluar Rabu</label>
                        <input type="time" class="form-control" name="wednesday_out" id="wednesday_out" value="{{old('wednesday_out')}}">
                    </div>
            
                    <div class="form-group col-12 col-md-6">
                        <label for="thursday_in">Jam Masuk Kamis</label>
                        <input type="time" class="form-control" name="thursday_in" id="thursday_in" value="{{old('thursday_in')}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="thursday_out">Jam Keluar Kamis</label>
                        <input type="time" class="form-control" name="thursday_out" id="thursday_out" value="{{old('thursday_out')}}">
                    </div>
            
                    <div class="form-group col-12 col-md-6">
                        <label for="friday_in">Jam Masuk Jumat</label>
                        <input type="time" class="form-control" name="friday_in" id="friday_in" value="{{old('friday_in')}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="friday_out">Jam Keluar Jumat</label>
                        <input type="time" class="form-control" name="friday_out" id="friday_out" value="{{old('friday_out')}}">
                    </div>
            
                    <div class="form-group col-12 col-md-6">
                        <label for="saturday_in">Jam Masuk Sabtu</label>
                        <input type="time" class="form-control" name="saturday_in" id="saturday_in" value="{{old('saturday_in')}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="saturday_out">Jam Keluar Sabtu</label>
                        <input type="time" class="form-control" name="saturday_out" id="saturday_out" value="{{old('saturday_out')}}">
                    </div>
            
                    <div class="form-group col-12 col-md-6">
                        <label for="sunday_in">Jam Masuk Minggu</label>
                        <input type="time" class="form-control" name="sunday_in" id="sunday_in" value="{{old('sunday_in')}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="sunday_out">Jam Keluar Minggu</label>
                        <input type="time" class="form-control" name="sunday_out" id="sunday_out" value="{{old('sunday_out')}}">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-sm btn-primary float-right">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
        <!-- Plugins Js -->
        <script src="/assets/libs/multiselect/jquery.multi-select.js"></script>
        <script src="/assets/libs/select2/select2.min.js"></script>
        <!-- Init js-->
        <script>
            $(".select2").select2()
        </script>
@endsection