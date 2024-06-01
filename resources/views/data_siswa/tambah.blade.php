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
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Tambah Data Siswa</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/tambahsiswa" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Nama Lengkap</h5>
                        </div>
                        <div class="col-10">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>NIK</h5>
                        </div>
                        <div class="col-10">
                            <input type="text" name="nik" class="form-control" placeholder="NIK">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Jenis Kelamin</h5>
                        </div>
                        <div class="col-10">
                            <select name="jenis_kelamin" class="form-control">
                                <option value="laki-Laki">Laki-Laki</option>
                                <option value="perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Status</h5>
                        </div>
                        <div class="col-10">
                            <select class="form-control" id="exampleFormControlSelect1" name="kriteria_3">
                                @foreach ($kriteria_3 as $value)
                                    <option value="{{ $value->nilai }}">{{ $value->nama_kriteria }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Tempat Tanggal Lahir</h5>
                        </div>
                        <div class="col-4">
                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Kota Tempat Lahir">
                        </div>
                        <div class="col-4">
                            <input type="date" name="tanggal_lahir" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Tempat Tinggal</h5>
                        </div>
                        <div class="col-10">
                            <select class="form-control" id="exampleFormControlSelect1" name="kriteria_6">
                                @foreach ($kriteria_6 as $value)
                                <option value="{{ $value->nilai }}">{{ $value->nama_kriteria }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Anak Ke</h5>
                        </div>
                        <div class="col-5">
                            <select class="form-control" id="exampleFormControlSelect1" name="kriteria_4">
                                @foreach ($kriteria_4 as $value)
                                <option value="{{ $value->nilai }}">{{ $value->nama_kriteria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            <h5> bersaudara</h5>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Hobi</h5>
                        </div>
                        <div class="col-10">
                            <input type="text" name="hobi" class="form-control" placeholder="Hobi">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Penyakit yang diderita</h5>
                            <h6 style="color:red;">*sebutkan jika ada</h6>
                        </div>
                        <div class="col-10">
                            <textarea class="form-control" name="penyakit" placeholder="Penyakit yang diderita"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Nomor Rekening</h5>
                            <h6 style="color:red;">*sebutkan jika ada</h6>
                        </div>
                        <div class="col-10">
                            <input type="text" name="norek" class="form-control" placeholder="Nomor Rekening">
                        </div>
                    </div>
                <h4 class="mb-0">PENDIDIKAN</h4>
                <hr />
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>NISN</h5>
                        </div>
                        <div class="col-10">
                            <input type="text" name="nisn" class="form-control" placeholder="NISN">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Sekolah</h5>
                        </div>
                        <div class="col-10">
                            <input type="text" name="sekolah" class="form-control" placeholder="Sekolah">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Jenjang / Kelas</h5>
                        </div>
                        <div class="col-5">
                            <select name="jenjang" class="form-control">
                                <option value="SD">SD / MI</option>
                                <option value="SMP">SMP / MTS</option>
                                <option value="SMA">SMA / MA / SMK</option>
                            </select>
                        </div>
                        <div class="col-5">
                            <select name="kelas" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Alamat Sekolah</h5>
                        </div>
                        <div class="col">
                            <textarea class="form-control" name="alamat" placeholder="Alamat Sekolah"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Nilai Rata-Rata Raport</h5>
                        </div>
                        <div class="col-10">
                            <input type="number" name="kriteria_1" class="form-control" placeholder="Masukkan Nilai Rata-rata">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Prestasi Non Akademik</h5>
                            <h6 style="color:red;">*sebutkan jika ada</h6>
                        </div>
                        <div class="col-3">
                            <select class="form-control" id="exampleFormControlSelect1" name="kriteria_2">
                                @foreach ($kriteria_2 as $value)
                                <option value="{{ $value->nilai }}">{{ $value->nama_kriteria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-7">
                            <input type="text" name="presdes" class="form-control" placeholder="Masukkan Nama Prestasi.">
                        </div>
                    </div>
                <h4 class="mb-0">PERKEMBANGAN ANAK</h4>
                <hr />
                    <div class="row mb-3">
                        <div class="col-3">
                            <h5>Mengikuti TPQ</h5>
                        </div>
                        <div class="col-3">
                            <select name="tpq" class="form-control">
                                <option value="ya">Ya</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="col-1">
                            <h5>di </h5>
                        </div>
                        <div class="col-5">
                            <input type="text" name="tempat_tpq" class="form-control" placeholder="Nama Tempat TPQ">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <h5>Kemampuan Membaca Al-Quran</h5>
                        </div>
                        <div class="col-3">
                            <select class="form-control" id="exampleFormControlSelect1" name="kriteria_5">
                                @foreach ($kriteria_5 as $value)
                                <option value="{{ $value->nilai }}">{{ $value->nama_kriteria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-1">
                            <h5> Jilid / Juz ke-</h5>
                        </div>
                        <div class="col-5">
                            <input type="text" name="jilid" class="form-control" placeholder="Jilid / Juz">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <h5>Sholat Fardhu</h5>
                        </div>
                        <div class="col-9">
                            <select name="sholat" class="form-control">
                                <option value="rutin">Rutin</option>
                                <option value="tidak-rutin">Tidak Rutin</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-3">
                            <h5>Mengikuti Bimbel</h5>
                        </div>
                        <div class="col-3">
                            <select name="bimbel" class="form-control">
                                <option value="ikut">Ikut</option>
                                <option value="tidak-ikut">Tidak Ikut</option>
                            </select>
                        </div>
                        <div class="col-1">
                            <h5>di </h5>
                        </div>
                        <div class="col-5">
                            <input type="text" name="tempat_bimbel" class="form-control" placeholder="Nama Tempat Bimbel">
                        </div>
                    </div>
                <h4 class="mb-0">ORANG TUA KANDUNG</h4>
                <hr />
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Nama Ayah</h5>
                        </div>
                        <div class="col-1">
                            <h5><i>Almarhum</i></h5>
                        </div>
                        <div class="col-9">
                            <input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Nama Ibu</h5>
                        </div>
                        <div class="col-10">
                            <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Pekerjaan</h5>
                        </div>
                        <div class="col-10">
                            <select name="pekerjaan" class="form-control">                                
                                <option value="guru">Guru</option>
                                <option value="pns">Pegawai Negeri</option>
                                <option value="pegawai">Pegawai</option>
                                <option value="art">Asisten Rumah Tangga</option>
                                <option value="penjahit">Penjahit</option>
                                <option value="usaha">Pengusaha</option>
                                <option value="irt">Ibu Rumah Tangga</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Alamat Domisili</h5>
                        </div>
                        <div class="col-10">
                            <textarea class="form-control" name="alamat_ortu" placeholder="Alamat Domisili"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Nomor Telepon / HP</h5>
                        </div>
                        <div class="col-10">
                            <input type="text" name="telp" class="form-control" placeholder="Nomor Telepon / HP">
                        </div>
                    </div>

                <!-- DATA WALI -->
                <h4 class="mb-0">WALI ANAK ASUH</h4>
                <h6 style="color:red;">*tambahkan jika ada</h6>
                <hr />
                    <!-- warning coba -->
                <div class="additional-fields" style="display: none;">
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Nama Wali</h5>
                        </div>
                        <div class="col-10">
                            <input type="text" name="nama_wali" class="form-control" placeholder="Nama Wali">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Pekerjaan</h5>
                        </div>
                        <div class="col-10">
                            <select name="pekerjaan_wali" class="form-control">
                                <option value=""></option>                                
                                <option value="guru">Guru</option>
                                <option value="pns">Pegawai Negeri</option>
                                <option value="pegawai">Pegawai</option>
                                <option value="art">Asisten Rumah Tangga</option>
                                <option value="penjahit">Penjahit</option>
                                <option value="usaha">Pengusaha</option>
                                <option value="irt">Ibu Rumah Tangga</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Alamat Domisili</h5>
                        </div>
                        <div class="col-10">
                            <textarea class="form-control" name="alamat_wali" placeholder="Alamat Domisili"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Hubungan Family</h5>
                        </div>
                        <div class="col-10">
                            <input type="text" name="hubungan" class="form-control" placeholder="Hubungan Family">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-2">
                            <h5>Nomor Telepon / HP</h5>
                        </div>
                        <div class="col-10">
                            <input type="text" name="telp_wali" class="form-control" placeholder="Nomor Telepon / HP">
                        </div>
                    </div>
                </div>
                        <!-- Tambahkan kolom tambahan -->
                    <div class="row mb-3">
                        <div class="col text-center">
                            <button type="button" class="btn btn-primary" onclick="toggleAdditionalFields()">Tambah Data Wali</button>
                        </div>
                    </div>

                <h3 class="mb-0">PENGUMPULAN BERKAS</h3>
                <hr />
                    <div class="row mb-3">
                        <div class="col-4">
                            <h5>Upload Pass Photo</h5>
                        </div>
                        <div class="col-5">
                            <input type="file" name="foto" class="form-control-file">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <h5>Upload Raport</h5>
                        </div>
                        <div class="col-5">
                            <input type="file" name="raport" class="form-control-file">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <h5>Upload Surat Kematian Ayah</h5>
                        </div>
                        <div class="col-5">
                            <input type="file" name="surat_kematian" class="form-control-file" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <h5>Upload Kartu Keluarga (KK)</h5>
                        </div>
                        <div class="col-5">
                            <input type="file" name="kk" class="form-control-file" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <h5>Upload Kartu Tanda Penduduk (KTP) Wali</h5>
                        </div>
                        <div class="col-5">
                            <input type="file" name="ktp" class="form-control-file" >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <h5>Upload Surat Keterangan Tidak Mampu (SKTM)</h5>
                        </div>
                        <div class="col-5">
                            <input type="file" name="sktm" class="form-control-file" >
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    <a href="/datasiswa" class="btn btn-light">Kembali</a>
                </form>


                <script>
                function toggleAdditionalFields() {
                    var additionalFields = document.querySelector('.additional-fields');

                    // Periksa apakah kolom tambahan sudah tersembunyi
                    if (additionalFields.style.display === "none" || additionalFields.style.display === "") {
                        additionalFields.style.display = "block"; // Tampilkan kolom tambahan
                    } else {
                        additionalFields.style.display = "none"; // Sembunyikan kolom tambahan
                    }
                }
                </script>

            </div>
        </div>
    </div>
@endsection
