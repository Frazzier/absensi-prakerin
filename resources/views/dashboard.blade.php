@extends('layouts.main')

@section('pre-css')
<!-- dropify -->
<link href="/assets/libs/dropify/dropify.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('css')
<style>
    /* Hide scrollbar for Chrome, Safari and Opera */
    .hide-scroll::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .hide-scroll {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
    }
</style>
@endsection

@section('main-content')
    @include('dashboard.'.auth()->user()->role)
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