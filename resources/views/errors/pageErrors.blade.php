<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">

    
<!-- Mirrored from themesbrand.com/velzon/html/default/auth-500.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Apr 2022 17:22:07 GMT -->
<head>
        
        <meta charset="utf-8" />
        <title>Oups Error | {{ config('app.name') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico') }}">

        <!-- Layout config Js -->
        <script src="assets/js/layout.js"></script>
        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <!-- custom Css-->
        <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />


    </head>

    <body>

        <!-- auth-page wrapper -->
        <div class="auth-page-wrapper py-5 d-flex justify-content-center align-items-center min-vh-100">

            <!-- auth-page content -->
            <div class="auth-page-content overflow-hidden p-0">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-xl-4 text-center">
                            <div class="error-500 position-relative">
                                <img src="{{ asset('assets/images/error500.png') }}" alt="" class="img-fluid error-500-img error-img" />
                                <h1 class="title text-muted">Oops!</h1>
                            </div>
                            <div>
                                <h3>Erreur d'accès
                                <p class="text-muted">Oups! 
                                    @if(session('typeAnswer'))
                                        {!!session('typeAnswer')!!}
                                    @endif
                                </p></h3>
                                <a href="{{url('/')}}" class="btn btn-success"><i class="mdi mdi-home me-1"></i>Retour</a>
                            </div>
                        </div><!-- end col-->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end container -->
            </div>
            <!-- end auth-page content -->
        </div>
        <!-- end auth-page-wrapper -->

    </body>


<!-- Mirrored from themesbrand.com/velzon/html/default/auth-500.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Apr 2022 17:22:08 GMT -->
</html>