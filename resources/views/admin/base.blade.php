<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{$pageName}} - {{$siteName}}</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('dashboard/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('dashboard/vendors/summernote/summernote-bs5.css')}}">
    @stack('css')
</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav  sidebar bg-gradient-primary sidebar-dark accordion" id="accordionSidebar"
        >

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.admin.dashboard') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                {{--                <i class="fas fa-laugh-wink"></i>--}}
            </div>
            <div class="sidebar-brand-text mx-3">{{$siteName}} </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.admin.dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.category.index')}}">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Product Category</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.products.index')}}">
                <i class="fas fa-fw fa-box"></i>
                <span>Products</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.orders.index')}}">
                <i class="fas fa-fw fa-cart-plus"></i>
                <span>Orders</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.delivery.index')}}">
                <i class="fas fa-fw fa-user"></i>
                <span>Users</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.delivery.index')}}">
                <i class="fas fa-fw fa-train"></i>
                <span>Logistics Section</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

    <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="{{url('admin/logout')}}">
                <i class="fas fa-fw fa-sign-out-alt"></i>
                <span>Logout</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>


    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-gradient-primary topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>



                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">



                {{--                    <div class="topbar-divider d-none d-sm-block"></div>--}}

                <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{$user->name}}</span>
                            <img class="img-profile rounded-circle"
                                 src="https://ui-avatars.com/api/?name={{$user->name}}">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{url('admin/settings')}}">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('admin/logout')}}">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{$pageName}}</h1>
                </div>


                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer" >
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; {{$siteName}} {{date('Y')}}</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="{{url('admin/logout')}}">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('dashboard/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('dashboard/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('dashboard/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('dashboard/vendor/chart/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('dashboard/js/demo/chart-area-demo.js')}}"></script>
<script src="{{asset('dashboard/js/demo/chart-pie-demo.js')}}"></script>

<!-- Page level plugins -->
<script src="{{asset('dashboard/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{asset('dashboard/js/demo/datatables-demo.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.10/dist/clipboard.min.js"></script>
<script>
    new ClipboardJS('.copy');
</script>

<script src="{{asset('dashboard/vendors/summernote/summernote-bs5.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 150,
        });
    });
</script>
@stack('js')
</body>

</html>
