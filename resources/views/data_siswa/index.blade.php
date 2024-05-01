@extends('layouts.index')    
@if (Auth::user()->role === 'admin')
    @section('navitem')
<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="/admin">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Siswa
</div>

<!-- Nav Item - Siswa -->
<li class="nav-item">
    <a class="nav-link" href="/datasiswa">
        <i class="fas fa-fw fa-folder"></i>
        <span>Data Siswa</span></a>
</li>

<!-- Nav Item - Rekomendasi -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsehasil"
        aria-expanded="true" aria-controls="collapsehasil">
        <i class="fas fa-fw fa-table"></i>
        <span>Rekomendasi</span>
    </a>
    <div id="collapsehasil" class="collapse" aria-labelledby="headinghasil" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">rekomendasi:</h6>
            <a class="collapse-item" href="/hasil">Hasil Rekomendasi</a>
            <a class="collapse-item" href="#">Riwayat</a>
        </div>
    </div>
</li>


<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    User
</div>


<!-- Nav Item - Koor -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('usercontrol') }}">
        <i class="fas fa-fw fa-folder"></i>
        <span>Data Koordinator</span></a>
</li>

<!-- Nav Item - Periode -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('periode') }}">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Periode</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
    @endsection
@elseif(Auth::user()->role === 'user')
    @section('navitem')
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="/user">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Siswa
            </div>


            <!--data siswa-->
            <li class="nav-item">
                <a class="nav-link" href="/datasiswa">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Data Siswa</span></a>
            </li>

            <!-- Nav Item - Rekomendasi -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsehasil"
                    aria-expanded="true" aria-controls="collapsehasil">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Rekomendasi</span>
                </a>
                <div id="collapsehasil" class="collapse" aria-labelledby="headinghasil" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">rekomendasi:</h6>
                        <a class="collapse-item" href="/hasil">Hasil Rekomendasi</a>
                        <a class="collapse-item" href="#">Riwayat</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Lembaga
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="/profile">
                <i class="fas fa-fw fa-cog"></i>
                    <span>Profile Lembaga</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
    @endsection
@endif 
@section('main')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Data Siswa</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                
            {{-- new --}}
            @if (Auth::user()->role === 'user') 
                <a href="/siswatambah" class="btn-sm btn-primary text-decoration-none">Tambah data</a>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire(
                                'Sukses',
                                '{{ Session::get('success') }}',
                                'success'
                            );
                        });
                    </script>
                @endif
            @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Jenjang</th>
                                <th>Sekolah</th>
                                <th>Action</th>
                                @if (Auth::user()->role === 'user') 
                                <th>Ajukan</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->jenjang }}</td>
                                    <td>{{ $item->sekolah }}</td>
                                    <td><a href="/siswadetail/{{ $item->id }}" class="btn-sm btn-secondary text-decoration-none">Detail</a> |
                                        <a href="/siswaedit/{{ $item->id }}" class="btn-sm btn-warning text-decoration-none">Edit</a> |
                                        <form onsubmit="return confirmHapus(event)"
                                            action="/siswahapus/{{ $item->id }}" method="post" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                    @if (Auth::user()->role === 'user') 
                                    <td>
                                        <form onsubmit="return confirmAju(event)" method="post" action="/ajukan/{{ $item->id }}">
                                            @csrf
                                            @php
                                                $periodeTerbaru = \App\Models\Periode::where('status_periode', 'buka')->latest()->first();
                                                $evaluasiTerbaru = \App\Models\Evaluasi::where('id_siswa', $item->id)
                                                    ->where('id_periode', $periodeTerbaru->id ?? null)
                                                    ->first();
                                            @endphp

                                            @if ($periodeTerbaru)
                                                @if ($evaluasiTerbaru && $evaluasiTerbaru->sudah_diajukan)
                                                    <button type="button" style="background-color: green; color: white;" disabled>Sudah Diajukan</button>
                                                @else
                                                    <input type="hidden" name="id_periode" value="{{ $periodeTerbaru->id }}">
                                                    <input type="hidden" name="status_periode" value="{{ $periodeTerbaru->status_periode }}">
                                                    <button type="submit">Ajukan</button>
                                                @endif
                                            @else
                                            <button type="button" style="background-color: #E74C3C; color: white;" disabled>Sudah Ditutup</button>
                                            @endif
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmHapus(event) {
        event.preventDefault(); 

        Swal.fire({
            title: 'Yakin Hapus Data?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((willDelete) => {
            if (willDelete.isConfirmed) {
                event.target.submit(); // Melanjutkan pengiriman form
            } else {
                swal('Your imaginary file is safe!');
            }
        });
    }
</script>

<script>
    function confirmAju(event) {
        event.preventDefault(); 

        Swal.fire({
            title: 'Konfirmasi Ajukan Data Siswa',
            text: "Anda yakin akan mengajukan data tersebut? Data tidak bisa diedit kembali",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ajukan',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit(); 
            } else {
                Swal.fire('Ajukan data dibatalkan', '', 'info');
            }
        });
    }
</script>
