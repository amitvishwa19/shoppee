
<!DOCTYPE html>
<html lang="en">



<head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="csrf-token" content="{{csrf_token()}}">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{setting('app_fevicon')}}">

        <!-- Fontawsome -->
        <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" /> -->

        <!-- App css -->
        <link href="{{asset('public/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/admin/assets/css/metisMenu.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/admin/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/admin/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/admin/assets/css/main.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/admin/assets/css/app.css')}}" rel="stylesheet" type="text/css" />

        @yield('style')

    </head>

    <body class="dark-sidenav">

        {{-- For vue js --}}


            @include('admin.partials.left-nav')


            <div  id="app" class="page-wrapper">



                <!-- Page Content-->
                <div class="page-content">

                    @include('admin.partials.top-nav')

                    <div class="container-fluid">

                        {{-- @include('admin.partials.page-area') --}}
                        @yield('content')

                    </div><!-- container -->

                    {{-- <footer class="footer text-center text-sm-left">
                        &copy; 2021 Devlomatix Solutions <span class="d-none d-sm-inline-block float-right">Devloped by <i class="mdi mdi-heart text-danger"></i> Devlomatix Solutions Pvt. Ltd</span>
                    </footer><!--end footer--> --}}
                </div>
                <!-- end page content -->

            </div>
            <!-- end page-wrapper -->






        <!-- jQuery  -->
        <script src="{{asset('public/admin/assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('public/admin/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('public/admin/assets/js/metismenu.min.js')}}"></script>
        <script src="{{asset('public/admin/assets/js/waves.js')}}"></script>
        <script src="{{asset('public/admin/assets/js/feather.min.js')}}"></script>
        <script src="{{asset('public/admin/assets/js/simplebar.min.js')}}"></script>
        <script src="{{asset('public/admin/assets/js/moment.js')}}"></script>
        <script src="{{asset('public/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>

        @yield('scripts')

        <!-- App js -->
        <script src="{{asset('public/admin/assets/js/main.js')}}"></script>
        <script src="{{asset('public/admin/assets/js/app.js')}}"></script>


        <script>
            @if(Session::has('message'))
                var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
                var alertMessage = {!! json_encode(Session::get('message')) !!};

                if(alertType == 'success'){
                    toast({
                        type: "success",
                        title: alertMessage
                    });
                }

                if(alertType == 'error'){
                    toast({
                        type: "error",
                        title: alertMessage
                    });
                }

                if(alertType == 'warning'){
                    toast({
                        type: "warning",
                        title: alertMessage
                    });
                }

                if(alertType == 'info'){
                    toast({
                        type: "info",
                        title: alertMessage
                    });
                }

            @endif

            @if(Session::has('errors'))

            @endif

        </script>

        {{-- Firebase intigration --}}
        {{-- <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-analytics.js"></script> --}}
        <script>
            // <!-- The core Firebase JS SDK is always required and must be listed first -->
            // <script src="https://www.gstatic.com/firebasejs/8.6.8/firebase-app.js">

            // <!-- TODO: Add SDKs for Firebase products that you want to use
            //     https://firebase.google.com/docs/web/setup#available-libraries -->



            // // Your web app's Firebase configuration
            // // For Firebase JS SDK v7.20.0 and later, measurementId is optional
            // var firebaseConfig = {
            //     apiKey: "AIzaSyAI-cMt53wdlRH_TMY0OddkkaNw7UwIVWk",
            //     authDomain: "devlomatix-d6e56.firebaseapp.com",
            //     projectId: "devlomatix-d6e56",
            //     storageBucket: "devlomatix-d6e56.appspot.com",
            //     messagingSenderId: "461788897174",
            //     appId: "1:461788897174:web:dc31d27c0cb195c20147b7",
            //     measurementId: "G-WT24Y2W3JQ"
            // };
            // // Initialize Firebase
            // firebase.initializeApp(firebaseConfig);
            // firebase.analytics();
        </script>

    </body>



</html>
