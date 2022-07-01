@extends('layouts.main')

@section('pre-css')
<!-- third party css -->
<link href="/assets/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="/assets/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
<!-- third party css end -->
@endsection

@section('main-content')
<div class="row">
    <div class="col-12">
        <div class="card-box" id="presence-container">
            @include('student.presence-table')
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- third party js -->
<script src="/assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/libs/datatables/dataTables.bootstrap4.js"></script>
<script src="/assets/libs/datatables/dataTables.responsive.min.js"></script>
<script src="/assets/libs/datatables/responsive.bootstrap4.min.js"></script>
<!-- third party js ends -->
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
</script>
@endsection