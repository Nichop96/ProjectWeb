<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>ORC @yield('title')</title>
        <link rel="icon" href="{{asset('public-part/img/logos/logo_transparent.png')}}">
        <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <!-- endinject -->
        <script src="{{asset('js/jquery.js')}}"></script>
        @yield('jquery')

        <meta name="csrf-token" content="{{ csrf_token() }}" />
    </head>
    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex justify-content-center">
                    <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
                        <a class="navbar-brand brand-logo" href="{{ route('index') }}"><img src="{{ asset('public-part/img/logos/twitter_header_photo_2.jpg')}} " alt="logo"/></a>

                        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                            <span class="mdi mdi-view-headline"></span>
                        </button>
                    </div>  
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <ul class="navbar-nav mr-lg-4 w-100">

                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        @impersonate                        
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('admin.impersonate.destroy')}}">
                                <div class="col-lg-1">
                                    <button  class="btn btn-outline-danger">STOP</button>
                                </div>
                            </a>

                        </li>                        
                        @endimpersonate
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                                @yield('profile-photo')
                                <span class="nav-profile-name">{{ Auth::user()->username }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                                @yield('profile-settings')                                        
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout text-primary"></i>
                                    {{ __('Logout') }}
                                </a>                               
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>                                
                            </div>                         
                        </li>


                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->
                <nav class="sidebar sidebar-offcanvas"></nav>
                @yield('left-navbar')
                <!-- partial -->
                <div class="main-panel">
                    @yield('content')
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- plugins:js -->
        <script src="{{ asset('vendors/base/vendor.bundle.base.js')}} "></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        @yield('plugin')
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="{{ asset('vendors/chart.js/Chart.min.js')}}"></script>
        <script src="{{ asset('js/off-canvas.js')}} "></script>
        <script src="{{ asset('js/hoverable-collapse.js')}} "></script>
        <script src="{{ asset('js/template.js')}}"></script>       
        <!-- endinject -->
        <!-- Custom js for this page-->
        @yield('inject')
        <!-- End custom js for this page-->
    </body>

</html>

