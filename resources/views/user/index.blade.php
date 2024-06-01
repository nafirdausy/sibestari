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
                                <div class="text-s font-weight-bold text-primary text-uppercase mb-1">Periode Ke- {{ $lastPeriode->nama_periode }}</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">Tanggal Buka: {{ $lastPeriode->tgl_buka }} </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">Tanggal Tutup: {{ $lastPeriode->tgl_tutup }}</div>
                            </div>
                            <div class="col mr-2">
                                <div class="text-s font-weight-bold text-primary text-uppercase mb-1"> </div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">Tanggal Pengumuman: {{ $lastPeriode->tgl_pengumuman }} </div>
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
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $lastPeriode->kuota }} Siswa</div>
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
                                <div class="h6 mb-0 font-weight-bold text-gray-800">{{ $lastPeriode->pengumuman }}</div>
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
                            </span>
                            <span class="mr-2">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Data untuk Bar Chart
                    var dataPenerima = @json($dataPenerima);

                    var ctxBar = document.getElementById('myBarChart').getContext('2d');
                    var labels = dataPenerima.map(function(item) {
                        return item.jenjang;
                    });

                    var data = dataPenerima.map(function(item) {
                        return item.total;
                    });

                    var myBarChart = new Chart(ctxBar, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Total Penerima",
                                backgroundColor: "#4e73df",
                                hoverBackgroundColor: "#2e59d9",
                                borderColor: "#4e73df",
                                data: data,
                            }],
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });

                    // Data untuk Pie Chart
                    var totalEvaluasi = @json($totalEvaluasi);
                    var totalPenerimaan = @json($totalPenerimaan);

                    var ctxPie = document.getElementById("myPieChart").getContext('2d');
                    var myPieChart = new Chart(ctxPie, {
                    type: 'doughnut',
                    data: {
                        labels: ["Diterima", "Ditolak"],
                        datasets: [{
                        data: [totalPenerimaan, totalEvaluasi - totalPenerimaan],
                        backgroundColor: ['#4e73df', '#1cc88a'],
                        hoverBackgroundColor: ['#2e59d9', '#17a673'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                        }],
                    },
                    });
                });
            </script>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
