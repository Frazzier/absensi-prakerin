
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{$title ?? 'Absensi Prakerin'}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{$setting->small_logo ?? '/assets/images/noimage.jpeg'}}">
        @yield('pre-css')
        <!-- Notification css (Toastr) -->
        <link href="/assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
        @yield('css')
    </head>

    <body>
        <!-- Pre-loader -->
        <div id="preloader">
            <div id="status">
                <div class="spinner">Loading...</div>
            </div>
        </div>
        <!-- End Preloader-->

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            @include('layouts.topbar')
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            @include('layouts.sidebar')
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        @yield('main-content')
                    </div> <!-- container-fluid -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                               <script>document.write(new Date().getFullYear())</script> &copy {{$setting->app_name ?? ''}}
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <form action="/logout" method="post" id="logout-form">
            @csrf
        </form>
        <!-- Vendor js -->
        <script src="/assets/js/vendor.min.js"></script>
        <!-- Toastr js -->
        <script src="/assets/libs/toastr/toastr.min.js"></script>
        <!-- App js -->
        <script src="/assets/js/app.min.js"></script>
        <script>
            function logout(){
                $('#logout-form').submit()
            }

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": 300,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1000,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        </script>
        <script>
            function errorToast(err) {
                if (err.status == 422) {
                    $.each(err.responseJSON.errors, function (i, error) {
                        toastr["error"](error[0]);
                    });
                }
            }
        </script>
        @if(session('success'))
            <script>
                toastr["success"]("{{session('success')}}");
            </script>
        @elseif(session('error'))
            <script>
                toastr["error"]("{{session('error')}}");
            </script>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <script>
                    toastr["error"]("{{$error}}");
                </script>
            @endforeach
        @endif
        @yield('script')
    </body>
</html>