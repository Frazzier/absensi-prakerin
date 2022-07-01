<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Log in</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="" name="description" />
        <meta content="Frazzier" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <!-- Notification css (Toastr) -->
        <link href="/assets/libs/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-stylesheet" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" id="app-stylesheet" rel="stylesheet" type="text/css" />
        @if($setting->login_background)
        <style>
            .authentication-bg{
                background-image: url({{$setting->login_background}}) !important
            }
        </style>
        @endif
    </head>


    <body class="authentication-bg">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="text-center">
                            @if($setting->logo)
                            <a href="/" class="logo">
                                <img src="{{url($setting->logo)}}" alt="" height="50" class="mx-auto">
                            </a>
                            @endif
                            <p class="text-muted mt-2 mb-4">Selamat Datang !</p>
                        </div>
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Sign In</h4>
                                </div>

                                <form action="/login" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email">Email address</label>
                                        <input class="form-control" type="email" id="email" required="" placeholder="Enter your email" name="email" value="{{old('email')}}">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" id="password" placeholder="Enter your password" name="password">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
    

        <!-- Vendor js -->
        <script src="/assets/js/vendor.min.js"></script>
        <!-- Toastr js -->
        <script src="/assets/libs/toastr/toastr.min.js"></script>

        <!-- App js -->
        <script src="/assets/js/app.min.js"></script>
        <script>
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
    </body>
</html>