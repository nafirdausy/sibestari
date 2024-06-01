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
        <span>Data Siswa</span>
    </a>
</li>

    <!-- Nav Item - Rekomendasi -->
    <li class="nav-item">
        <a class="nav-link" href="/hasil">
            <i class="fas fa-fw fa-table"></i>
            <span>Rekomendasi</span>
        </a>
    </li>

    <!-- Nav Item - Penerima -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="/penerima">
            <i class="fas fa-fw fa-file-alt"></i>
            <span>Penerima Beasiswa</span>
        </a>
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
        <i class="fas fa-fw fa-users"></i>
        <span>Data Koordinator</span></a>
</li>

<!-- Nav Item - Periode -->
<li class="nav-item">
    <a class="nav-link" href="{{ route('periode') }}">
        <i class="fas fa-fw fa-calendar-alt"></i>
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

            <!-- Nav Item - Penerima -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="/penerima">
                    <i class="fas fa-fw fa-file-alt"></i>
                    <span>Penerima Beasiswa</span>
                </a>
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
<h1 class="h3 mb-2 text-gray-800">Daftar Penerima Beasiswa</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
    <form action="{{ route('penerima.showRiwayat') }}" method="POST">
                        @csrf
                    <div class="row mb-3">
                        <div class="col-2">
                            <h4>Pilih Periode :</h4>
                        </div>
                        <div class="col-4">
                        <select name="id_periode" id="id_periode" class="form-control">
                            @foreach($dataPeriode as $prd)
                                <option value="{{ $prd->id }}" {{ isset($periodeId) && $periodeId == $prd->id ? 'selected' : '' }}>
                                    {{ $prd->nama_periode }} : {{ $prd->tgl_buka }} sampai {{ $prd->tgl_tutup}}
                                </option>
                            @endforeach
                        </select>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary" >Pilih</button>
                        </div>
                        <div class="col-2">
                        <a href="" onclick="this.href='/cetak/'+document.getElementById(periode_id).value" target="_blank" class="btn btn-primary">Export to PDF <i class="fas fa-fw fa-print"></i></a>
                        </div>
                        
                    </div>
                </form>
                
    </div>
    <div class="card-body">
        <div class="table-responsive">
        @isset($periodeId)
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        @if (Auth::user()->role === 'admin') 
                        <th>Nama Lembaga</th>
                        @endif
                        <th>Nama Siswa</th>
                        <th>Jenjang</th>
                        <th>Sekolah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataPenerima as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            @if (Auth::user()->role === 'admin') 
                                    <td>{{ $item->user->nama_lembaga }}</td>
                                    @endif
                            <td>{{ $item->alternatives->nama }}</td>
                            <td>{{ $item->alternatives->jenjang }}</td>
                            <td>{{ $item->alternatives->sekolah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endisset
        </div>
    </div>
</div>

</div>
@endsection
