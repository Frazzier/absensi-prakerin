@extends('layouts.main')

@section('pre-css')
<!-- Custom box css -->
<link href="/assets/libs/custombox/custombox.min.css" rel="stylesheet">
<!-- Sweet Alert-->
<link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<!-- third party css -->
<link href="/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
<!-- third party css end -->
@endsection

@section('main-content')
<div class="row">
    @if (auth()->user()->role == 'admin')
        <div class="col-12 mb-2">
            <a href="/student/create" class="btn btn-primary btn-sm waves-effect waves-light float-right">Tambah Murid</a>
        </div>
    @endif
    @if (auth()->user()->role == 'mentor')
        <div class="col-12 mb-2">
            <a href="/schedule/create" class="btn btn-primary btn-sm waves-effect waves-light float-right">Buat Jadwal</a>
        </div>
    @endif

    <div class="col-12">
        <div class="card-box" id="student-container">
            @include('student.table')
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Modal-Effect -->
<script src="/assets/libs/custombox/custombox.min.js"></script>
<!-- Sweet Alerts js -->
<script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
<!-- third party js -->
<script src="/assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables/dataTables.bootstrap4.js"></script>
<script src="/assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables/responsive.bootstrap4.min.js"></script>
<!-- third party js ends -->
<script>
    $('#student-table').dataTable({
        "oLanguage": {
            "oPaginate": {
                "sFirst": "Halaman Pertama", // This is the link to the first page
                "sPrevious": "Sebelumnya", // This is the link to the previous page
                "sNext": "Selanjutnya", // This is the link to the next page
                "sLast": "Halaman Terakhir" // This is the link to the last page
            }
        }
    })

    $(document).on('click', '.delete-student', function(){
        id = $(this).data('id')
        Swal.fire({
            title: "Apakah anda yakin ?",
            text: "Anda tidak bisa mengembalikan data yang sudah dihapus !",
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
                    url: '/student/'+id,
                    type: 'delete',
                    data: data,
                    dataType: 'json',
                    success: function(result){
                        if(result.success){
                            $('#student-container').html(result.html)
                            $('#student-table').dataTable({
        "order": [],
        "oLanguage": {
                                    "oPaginate": {
                                        "sFirst": "Halaman Pertama", // This is the link to the first page
                                        "sPrevious": "Sebelumnya", // This is the link to the previous page
                                        "sNext": "Selanjutnya", // This is the link to the next page
                                        "sLast": "Halaman Terakhir" // This is the link to the last page
                                    }
                                }
                            })
                            Swal.fire({ title: "Dihapus!", text: result.message, type: "success" })
                        }else{
                            Swal.fire({ title: "Error", text: result.message, type: "error" });
                        }
                    },
                    error: function(err){
                        errorToast(err)
                    }
                })
            }else{
                t.dismiss === Swal.DismissReason.cancel && Swal.fire({ title: "Dibatalkan", text: "Penghapusan dibatalkan !", type: "error" });
            }
        });
    })
</script>
@endsection