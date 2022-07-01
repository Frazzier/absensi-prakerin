@extends('layouts.main')

@section('pre-css')
    <!-- third party css -->
    <link href="/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <link href="/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <!-- Sweet Alert-->
    <link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <!-- Custom box css -->
    <link href="/assets/libs/custombox/custombox.min.css" rel="stylesheet">
@endsection

@section('main-content')
 <div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="text-center card-box">
            <div>
                <img src="{{$student->user->profile_picture ?? '/assets/images/noimage.jpeg'}}" class="rounded-circle avatar-xl img-thumbnail mb-3" alt="profile-image">
                <div class="text-left">
                    <p class="text-muted font-13"><strong>Nama Lengkap :</strong> <span class="ml-2">{{ucwords($student->user->name)}}</span></p>
                    <p class="text-muted font-13"><strong>Kelas :</strong><span class="ml-2">{{$student->class}}</span></p>
                    <p class="text-muted font-13"><strong>Email :</strong> <span class="ml-2">{{$student->user->email}}</span></p>
                </div>
                <div class="text-left">
                    <p class="text-muted font-13"><strong>Perusahaan :</strong><span class="ml-2">{{$student->company->name}}</span></p>
                    <p class="text-muted font-13"><strong>Alamat Perusahaan :</strong> <span class="ml-2">{{$student->company->address}}</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-6">
        <div class="card-box">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h5 class="mb-3">Jadwal Prakerin</h5>
                </div>
                <div class="col-12 col-md-6">
                    @if (auth()->user()->role == 'mentor')
                        <button class="btn btn-primary btn-sm waves-effect waves-light float-right mx-1" id="edit-schedule">Edit Jadwal</button>
                        <button class="btn btn-warning btn-sm waves-effect waves-light float-right mx-1" id="free-today" data-student_id="{{$student->id}}">Liburkan Hari Ini</button>
                    @endif
                </div>
                <div class="col-12">Tanggal Mulai : {{$student->schedule ? ($student->schedule->start ? date('Y-m-d', strtotime($student->schedule->start)) : '-') : '-'}}</div>
                <div class="col-12 mb-3">Tanggal Selesai : {{$student->schedule ? ($student->schedule->end ? date('Y-m-d', strtotime($student->schedule->end)) : '-') : '-'}}</div>

                <div class="col-6 text-center">Jam Masuk</div>
                <div class="col-6 text-center">Jam Keluar</div>

                <div class="col-12 text-center border-top pt-2">Senin</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->monday_in ? date('H:i', strtotime($student->schedule->monday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->monday_out ? date('H:i', strtotime($student->schedule->monday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Selasa</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->tuesday_in ? date('H:i', strtotime($student->schedule->tuesday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->tuesday_out ? date('H:i', strtotime($student->schedule->tuesday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Rabu</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->wednesday_in ? date('H:i', strtotime($student->schedule->wednesday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->wednesday_out ? date('H:i', strtotime($student->schedule->wednesday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Kamis</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->thursday_in ? date('H:i', strtotime($student->schedule->thursday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->thursday_out ? date('H:i', strtotime($student->schedule->thursday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Jumat</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->friday_in ? date('H:i', strtotime($student->schedule->friday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->friday_out ? date('H:i', strtotime($student->schedule->friday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Sabtu</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->saturday_in ? date('H:i', strtotime($student->schedule->saturday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->saturday_out ? date('H:i', strtotime($student->schedule->saturday_out)) : '-') : '-'}}</div>

                <div class="col-12 text-center border-top pt-2">Minggu</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->sunday_in ? date('H:i', strtotime($student->schedule->sunday_in)) : '-') : '-'}}</div>
                <div class="col-6 text-center border-bottom">{{$student->schedule ? ($student->schedule->sunday_out ? date('H:i', strtotime($student->schedule->sunday_out)) : '-') : '-'}}</div>
                
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card-box" id="presence-container">
            <h5 class="mb-3">Riwayat Absensi</h5>
            @include('student.presence-table')
        </div>
    </div>
 </div>
 
 @if (auth()->user()->role == 'mentor')
<div id="edit-schedule-modal" class="modal-demo">
    <button type="button" class="close" onclick="Custombox.modal.close();">
        <span>&times;</span><span class="sr-only">X</span>
    </button>
    <h4 class="custom-modal-title">Jadwal Siswa</h4>
    <div class="custom-modal-text" style="max-height: 80vh; overflow-y: scroll;">
        <form action="/schedule/{{$student->id}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <p class="text-muted mb-1"> *) Kosongkan kolom jam masuk dan keluar jika libur / tidak masuk</p>
                </div>
                
                <div class="form-group col-12 col-md-6">
                    <label for="start">Tanggal Mulai</label>
                    <input type="date" class="form-control" name="start" id="start" value="{{$student->schedule ? ($student->schedule->start ? date('Y-m-d', strtotime($student->schedule->start)) : '') : ''}}">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="end">Tanggal Selesai</label>
                    <input type="date" class="form-control" name="end" id="end" value="{{$student->schedule ? ($student->schedule->end ? date('Y-m-d', strtotime($student->schedule->end)) : '') : ''}}">
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
 @endif
@endsection

@section('script')
    <!-- third party js -->
    <script src="/assets/libs/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/libs/datatables/dataTables.bootstrap4.js"></script>
    <script src="/assets/libs/datatables/dataTables.responsive.min.js"></script>
    <script src="/assets/libs/datatables/responsive.bootstrap4.min.js"></script>
    <!-- third party js ends -->
    <!-- Sweet Alerts js -->
    <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- Modal-Effect -->
    <script src="/assets/libs/custombox/custombox.min.js"></script>
    <script>
        $('#presence-table').dataTable({
            "oLanguage": {
                "oPaginate": {
                    "sFirst": "Halaman Pertama", // This is the link to the first page
                    "sPrevious": "Sebelumnya", // This is the link to the previous page
                    "sNext": "Selanjutnya", // This is the link to the next page
                    "sLast": "Halaman Terakhir" // This is the link to the last page
                }
            }
        })
        $(document).on('click', '#edit-schedule', function(){
            var modal = new Custombox.modal({
                content: {
                    effect: 'door',
                    target: '#edit-schedule-modal'
                }
            });
            modal.open()
        })
        $(document).on('click', '#free-today', function(){
            student_id = $(this).data('student_id')
            Swal.fire({
                title: "Apakah anda yakin ?",
                text: "Anda meliburkan siswa !",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Ya!",
                cancelButtonText: "Tidak!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ml-2 mt-2",
                buttonsStyling: !1,
            }).then(function (t) {
                if(t.value){
                    data = {'_token' : '{{csrf_token()}}'}
                    $.ajax({
                        url: '/schedule/free/'+student_id,
                        type: 'post',
                        data: data,
                        dataType: 'json',
                        success: function(result){
                            if(result.success){
                                Swal.fire({ title: "Siswa berhasil diliburkan!", text: result.message, type: "success" })
                            }else{
                                Swal.fire({ title: "Error", text: result.message, type: "error" });
                            }
                        },
                        error: function(err){
                            errorToast(err)
                        }
                    })
                }else{
                    t.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Dibatalkan", text: "Aksi dibatalkan !", type: "error" });
                }
            });
        })
    </script>
@endsection