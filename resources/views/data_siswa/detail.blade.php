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
        Menu
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
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Lihat Detail Data Siswa</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/detailsiswa">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control"  value="{{ $data->nama }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" name="nik" class="form-control"  value="{{ $data->nik }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <input type="text" name="jenis_kelamin" class="form-control"  value="{{ $data->jenis_kelamin }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" name="kriteria_3" class="form-control"  value="{{ $data->kriteria_3 }}"readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control"  value="{{ $data->tempat_lahir }}" readonly>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control"  value="{{ $data->tanggal_lahir }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tempat Tinggal</label>
                                <input type="text" name="tempat_tinggal" class="form-control"  value="{{ $data->tempat_tinggal }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Anak ke</label>
                                <input type="text" name="anak" class="form-control"  value="{{ $data->anak }}" readonly>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Dari</label>
                                <input type="text" name="dari" class="form-control"  value="{{ $data->dari }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Hobi</label>
                                <input type="text" name="hobi" class="form-control"  value="{{ $data->hobi }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Penyakit yang diderita</label>
                                <textarea class="form-control" name="penyakit" readonly>{{ $data->penyakit }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nomor Rekening</label>
                                <input type="text" name="norek" class="form-control"  value="{{ $data->norek }}" readonly>
                            </div>
                        </div>
                        <h3 class="mb-0">PENDIDIKAN</h3>
                        <hr />
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">NISN</label>
                                <input type="text" name="nisn" class="form-control"  value="{{ $data->nisn }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Sekolah</label>
                                <input type="text" name="sekolah" class="form-control"  value="{{ $data->sekolah }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Jenjang</label>
                                <input type="text" name="jenjang" class="form-control"  value="{{ $data->jenjang }}" readonly>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Kelas</label>
                                <input type="text" name="kelas" class="form-control"  value="{{ $data->kelas }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Alamat Sekolah</label>
                                <textarea class="form-control" name="alamat"  readonly>{{ $data->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nilai Rata-Rata Raport</label>
                                <input type="text" name="nilai" class="form-control"  value="{{ $data->nilai }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tingkat Prestasi Non Akademik</label>
                                <input type="text" name="prestasi" class="form-control"  value="{{ $data->prestasi }}" readonly>
                            </div>
                            <div class="col mb-3">
                            <label class="form-label">Nama Prestasi Akademik</label>
                                <input type="text" name="presdes" class="form-control"  value="{{ $data->presdes }}" readonly>
                            </div>
                        </div>
                        <h3 class="mb-0">PERKEMBANGAN ANAK</h3>
                        <hr />
                        <div class="row">
                            <div class="col mb-3">
                            <label class="form-label">Mengikuti TPQ</label>
                            <input type="text" name="tpq" class="form-control"  value="{{ $data->tpq }}" readonly>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Tempat TPQ</label>
                                <input type="text" name="tempat_tpq" class="form-control"  value="{{ $data->tempat_tpq }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                            <label class="form-label">Kemampuan Membaca Al-Quran</label>
                            <input type="text" name="baca_quran" class="form-control"  value="{{ $data->baca_quran }}" readonly>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Jilid / Juz ke</label>
                                <input type="text" name="jilid" class="form-control"  value="{{ $data->jilid }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Sholat Fardhu</label>
                                <input type="text" name="sholat" class="form-control"  value="{{ $data->sholat }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                            <label class="form-label">Mengikuti Bimbel</label>
                            <input type="text" name="bimbel" class="form-control"  value="{{ $data->bimbel }}" readonly>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Nama Tempat Bimbel</label>
                                <input type="text" name="tempat_bimbel" class="form-control"  value="{{ $data->tempat_bimbel }}" readonly>
                            </div>
                        </div>
                        <h3 class="mb-0">ORANG TUA KANDUNG</h3>
                        <hr />
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control"  value="{{ $data->nama_ayah }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control"  value="{{ $data->nama_ibu }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" class="form-control"  value="{{ $data->pekerjaan }}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Alamat Domisili</label>
                                <textarea class="form-control" name="alamat_ortu"  readonly>{{ $data->alamat_ortu }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nomor Telepon / HP</label>
                                <input type="text" name="telp" class="form-control"  value="{{ $data->telp }}" readonly>
                            </div>
                        </div>
                @if (!empty($data->nama_wali))
                <h4 class="mb-0">WALI ANAK ASUH</h4>
                <h6 style="color:red;">*tambahkan jika ada</h6>
                <hr />
                @endif
                    @if (!empty($data->nama_wali))
                    <div class="row">
                       <div class="col mb-3">
                            <label class="form-label">Nama Wali</label>
                            <input type="text" name="nama_wali" class="form-control"  value="{{ $data->nama_wali }}" readonly>
                        </div>
                    </div>
                    @endif
                    @if (!empty($data->pekerjaan_wali))
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" name="pekerjaan_wali" class="form-control"  value="{{ $data->pekerjaan_wali }}" readonly>
                        </div>
                    </div>
                    @endif
                    @if (!empty($data->alamat_wali))
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Alamat Domisili</label>
                            <textarea class="form-control" name="alamat_wali" readonly>{{ $data->alamat_wali }}</textarea>
                        </div>
                    </div>
                    @endif
                    @if (!empty($data->hubungan))
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Hubungan Family</label>
                            <textarea class="form-control" name="hubungan"  readonly>{{ $data->hubungan }}</textarea>
                        </div>
                    </div>
                    @endif
                    @if (!empty($data->telp_wali))
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Nomor Telepon / HP</label>
                            <input type="text" name="telp_wali" class="form-control"  value="{{ $data->telp_wali }}" readonly>
                        </div>
                    </div>
                    @endif

                        <h3 class="mb-0">PENGUMPULAN BERKAS</h3>
                        <hr />
                        <div class="mb-3">
                            <label for="foto" class="form-label">Pass Photo</label>
                            <div class="p-2">
                                <img src="{{ asset('picture/siswa/') }}/{{ $data->foto }}" alt="image"
                                    style="width: 120px; height: 180px;">
                            </div>

                    <a href="/datasiswa" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection