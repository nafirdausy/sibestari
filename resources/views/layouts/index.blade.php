<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIBESTARI</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('halaman_dashboard/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('halaman_dashboard/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('halaman_dashboard/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <img class="img-profile rounded-circle" src="data:image/png;base64,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" width="50px" height="50px">
                <div class="sidebar-brand-text mx-3">SIBESTARI</div>
            </a>

            @yield('navitem')


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
            
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Nav Item - User Information -->
                @include('layouts.topbar')
            </ul>

            </nav>
                <!-- End of Topbar -->
                @yield('main')

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy; sibestari 2024</span>
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
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Keluar" di bawah jika anda siap untuk mengakhiri sesi Anda saat ini.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-primary" type="submit">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

   

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('halaman_dashboard/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('halaman_dashboard/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('halaman_dashboard/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('halaman_dashboard/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('halaman_dashboard/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('halaman_dashboard/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('halaman_dashboard/js/demo/chart-pie-demo.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('halaman_dashboard/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('halaman_dashboard/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('halaman_dashboard/js/demo/datatables-demo.js') }}"></script>


</body>

</html>
