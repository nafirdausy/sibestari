@extends('user.layouts.index')

@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    </div>
                    <div class="card-body d-flex align-items-center row mb-15">
                        <div class="col-6">
                            <h3 class="m-0 font-weight-bold text-primary">Selamat Datang, {{ Auth::user()->fullname }}!</h3>
                            <p>SIBESTARI adalah website dari <b>Yatim Mandiri cabang Malang</b> yang memiliki tujuan sebagai sistem rekomendasi pada program <b>BESTARI</b>.</p>
                        </div>
                        <div class="text-right mr-4 col-5" >
                            <img class="img-fluid" style="max-width: 250px;" src="{{ asset('halaman_dashboard/img/undraw_announcement.svg') }}" alt="...">
                        </div>
                    </div>
                </div>
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-s font-weight-bold text-primary text-uppercase mb-1">Periode Ke-</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">Tanggal Pendaftaran : ... - ...</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1">Kuota Penerima</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">... Siswa</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-s font-weight-bold text-warning text-uppercase mb-1">Pengumuman</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">...</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bullhorn fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        <div class="row">

                        <!-- Bar Chart -->
                        <div class="col-xl-6 col-lg-7">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Jenjang Penerima BESTARI di {{ Auth::user()->nama_lembaga }}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="myBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-6 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Presentase Penerima BESTARI {{ Auth::user()->nama_lembaga }}</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="myPieChart"></canvas>
                        </div>
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Diterima
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Ditolak
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
