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
                <h4 class="card-title mb-4">Edit Data Siswa</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form class="forms-sample" method="POST" action="/editsiswa">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="{{ $data->nama }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">NIK</label>
                                <input type="text" name="nik" class="form-control"  value="{{ $data->nik }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="laki-Laki" {{ $data->jenis_kelamin == 'laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="perempuan" {{ $data->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-control" name="kriteria_3">
                                    @foreach ($kriteria_3 as $value)
                                        <option value="{{ $value->nilai }}" @if ($value->nilai == $data->kriteria_3) selected @endif>{{ $value->nama_kriteria }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control"  value="{{ $data->tempat_lahir }}" >
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control"  value="{{ $data->tanggal_lahir }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tempat Tinggal</label>
                                <select class="form-control" name="kriteria_6">
                                    @foreach ($kriteria_6 as $value)
                                        <option value="{{ $value->nilai }}" @if ($value->nilai == $data->kriteria_6) selected @endif>{{ $value->nama_kriteria }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Anak ke</label>
                                <select class="form-control" name="kriteria_4">
                                    @foreach ($kriteria_4 as $value)
                                        <option value="{{ $value->nilai }}" @if ($value->nilai == $data->kriteria_4) selected @endif>{{ $value->nama_kriteria }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Hobi</label>
                                <input type="text" name="hobi" class="form-control"  value="{{ $data->hobi }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Penyakit yang diderita</label>
                                <textarea class="form-control" name="penyakit"  >{{ $data->penyakit }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nomor Rekening</label>
                                <input type="text" name="norek" class="form-control"  value="{{ $data->norek }}" >
                            </div>
                        </div>
                        <h3 class="mb-0">PENDIDIKAN</h3>
                        <hr />
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">NISN</label>
                                <input type="text" name="nisn" class="form-control"  value="{{ $data->nisn }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Sekolah</label>
                                <input type="text" name="sekolah" class="form-control"  value="{{ $data->sekolah }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Jenjang</label>
                                <select name="jenjang" class="form-control">
                                    <option value="SD" {{ $data->jenjang == 'SD' ? 'selected' : '' }}>SD / MI</option>
                                    <option value="SMP" {{ $data->jenjang == 'SMP' ? 'selected' : '' }}>SMP / MTS</option>
                                    <option value="SMA" {{ $data->jenjang == 'SMA' ? 'selected' : '' }}>SMA / MA / SMK</option>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Kelas</label>
                                <select name="kelas" class="form-control">
                                <option value="1" {{ $data->kelas == '1' ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $data->kelas == '2' ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $data->kelas == '3' ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $data->kelas == '4' ? 'selected' : '' }}>4</option>
                                <option value="5" {{ $data->kelas == '5' ? 'selected' : '' }}>5</option>
                                <option value="6" {{ $data->kelas == '6' ? 'selected' : '' }}>6</option>
                                <option value="7" {{ $data->kelas == '7' ? 'selected' : '' }}>7</option>
                                <option value="8" {{ $data->kelas == '8' ? 'selected' : '' }}>8</option>
                                <option value="9" {{ $data->kelas == '9' ? 'selected' : '' }}>9</option>
                                <option value="10" {{ $data->kelas == '10' ? 'selected' : '' }}>10</option>
                                <option value="11" {{ $data->kelas == '11' ? 'selected' : '' }}>11</option>
                                <option value="12" {{ $data->kelas == '12' ? 'selected' : '' }}>12</option>
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Alamat Sekolah</label>
                                <textarea class="form-control" name="alamat"  >{{ $data->alamat }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nilai Rata-Rata Raport</label>
                                <input type="number" name="kriteria_1" class="form-control"  value="{{ $data->kriteria_1 }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Tingkat Prestasi Non Akademik</label>
                                <select class="form-control" name="kriteria_2">
                                    @foreach ($kriteria_2 as $value)
                                        <option value="{{ $value->nilai }}" @if ($value->nilai == $data->kriteria_2) selected @endif>{{ $value->nama_kriteria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Nama Prestasi Akademik</label>
                                <input type="text" name="presdes" class="form-control"  value="{{ $data->presdes }}" >
                            </div>
                        </div>

                        <h3 class="mb-0">PERKEMBANGAN ANAK</h3>
                        <hr />
                        <div class="row">
                            <div class="col mb-3">
                            <label class="form-label">Mengikuti TPQ</label>
                            <select name="tpq" class="form-control">
                                <option value="ya" {{ $data->tpq == 'ya' ? 'selected' : '' }}>Ya</option>
                                <option value="tidak" {{ $data->tpq == 'tidak' ? 'selected' : '' }}>Tidak</option>
                            </select>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Tempat TPQ</label>
                                <input type="text" name="tempat_tpq" class="form-control"  value="{{ $data->tempat_tpq }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                            <label class="form-label">Kemampuan Membaca Al-Quran</label>
                                <select class="form-control" name="kriteria_5">
                                    @foreach ($kriteria_5 as $value)
                                        <option value="{{ $value->nilai }}" @if ($value->nilai == $data->kriteria_5) selected @endif>{{ $value->nama_kriteria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Jilid / Juz ke</label>
                                <input type="text" name="jilid" class="form-control"  value="{{ $data->jilid }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Sholat Fardhu</label>
                                <select name="sholat" class="form-control">
                                <option value="rutin" {{ $data->sholat == 'rutin' ? 'selected' : '' }}>Rutin</option>
                                <option value="tidak-rutin" {{ $data->sholat == 'tidak-rutin' ? 'selected' : '' }}>Tidak Rutin</option>
                            </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                            <label class="form-label">Mengikuti Bimbel</label>
                            <<select name="bimbel" class="form-control">
                                <option value="ikut" {{ $data->bimbel == 'ikut' ? 'selected' : '' }}>Ikut</option>
                                <option value="tidak-ikut" {{ $data->bimbel == 'tidak-ikut' ? 'selected' : '' }}>Tidak Ikut</option>
                            </select>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Nama Tempat Bimbel</label>
                                <input type="text" name="tempat_bimbel" class="form-control"  value="{{ $data->tempat_bimbel }}" >
                            </div>
                        </div>
                        <h3 class="mb-0">ORANG TUA KANDUNG</h3>
                        <hr />
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control"  value="{{ $data->nama_ayah }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control"  value="{{ $data->nama_ibu }}" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Pekerjaan</label>
                                <select name="pekerjaan" class="form-control">
                                    <option value="guru" {{ $data->pekerjaan == 'guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="pns" {{ $data->pekerjaan == 'pns' ? 'selected' : '' }}>Pegawai Negeri</option>
                                    <option value="pegawai" {{ $data->pekerjaan == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                                    <option value="art" {{ $data->pekerjaan == 'art' ? 'selected' : '' }}>Asisten Rumah Tangga</option>
                                    <option value="penjahit" {{ $data->pekerjaan == 'penjahit' ? 'selected' : '' }}>Penjahit</option>
                                    <option value="usaha" {{ $data->pekerjaan == 'usaha' ? 'selected' : '' }}>Pengusaha</option>
                                    <option value="irt" {{ $data->pekerjaan == 'irt' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                    <option value="lainnya" {{ $data->pekerjaan == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Alamat Domisili</label>
                                <textarea class="form-control" name="alamat_ortu"  >{{ $data->alamat_ortu }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label class="form-label">Nomor Telepon / HP</label>
                                <input type="text" name="telp" class="form-control"  value="{{ $data->telp }}" >
                            </div>
                        </div>

                <!-- DATA WALI -->
                <h4 class="mb-0">WALI ANAK ASUH</h4>
                <h6 style="color:red;">*tambahkan jika ada</h6>
                <hr />
                    <!-- warning coba -->
                <div class="additional-fields" style="display: none;">
                    <div class="row">
                       <div class="col mb-3">
                            <label class="form-label">Nama Wali</label>
                            <input type="text" name="nama_wali" class="form-control"  value="{{ $data->nama_wali }}" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Pekerjaan</label>
                            <select name="pekerjaan_wali" class="form-control">
                                <option value="" {{ $data->pekerjaan_wali == '' ? 'selected' : '' }}></option>  
                                <option value="guru" {{ $data->pekerjaan_wali == 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="pns" {{ $data->pekerjaan_wali == 'pns' ? 'selected' : '' }}>Pegawai Negeri</option>
                                <option value="pegawai" {{ $data->pekerjaan_wali == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                                <option value="art" {{ $data->pekerjaan_wali == 'art' ? 'selected' : '' }}>Asisten Rumah Tangga</option>
                                <option value="penjahit" {{ $data->pekerjaan_wali == 'penjahit' ? 'selected' : '' }}>Penjahit</option>
                                <option value="usaha" {{ $data->pekerjaan_wali == 'usaha' ? 'selected' : '' }}>Pengusaha</option>
                                <option value="irt" {{ $data->pekerjaan_wali == 'irt' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                                <option value="lainnya" {{ $data->pekerjaan_wali == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Alamat Domisili</label>
                            <textarea class="form-control" name="alamat_wali"  >{{ $data->alamat_wali }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Hubungan Family</label>
                            <textarea class="form-control" name="hubungan"  >{{ $data->hubungan }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Nomor Telepon / HP</label>
                            <input type="text" name="telp_wali" class="form-control"  value="{{ $data->telp_wali }}" >
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
                        <div class="mb-3">
                            <label for="foto" class="form-label">Upload Pass Photo</label>
                            <div class="p-2">
                                <img src="{{ asset('picture/siswa/') }}/{{ $data->foto }}" alt="Image"
                                    style="width: 120px; height: 180px;">
                            </div>
                            <input class="form-control" type="file" id="foto" name="foto">
                        </div>
                        

                        <div class="row mb-3">
                        <div class="col-4">
                            <h5>Upload Raport</h5>
                        </div>
                        <div class="col-5">
                            <input type="file" name="raport" class="form-control-file" value="{{ $data->raport }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <h5>Upload Surat Kematian Ayah</h5>
                        </div>
                        <div class="col-5">
                            <input type="file" name="surat_kematian" class="form-control-file" value="{{ $data->surat_kematian }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <h5>Upload Kartu Keluarga (KK)</h5>
                        </div>
                        <div class="col-5">
                            <input type="file" name="kk" class="form-control-file" value="{{ $data->kk }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <h5>Upload Kartu Tanda Penduduk (KTP) Wali</h5>
                        </div>
                        <div class="col-5">
                            <input type="file" name="ktp" class="form-control-file" value="{{ $data->ktp }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <h5>Upload Surat Keterangan Tidak Mampu (SKTM)</h5>
                        </div>
                        <div class="col-5">
                            <input type="file" name="sktm" class="form-control-file" value="{{ $data->sktm }}">
                        </div>
                    </div>




                        
                        <button type="submit" class="btn btn-primary me-2">Edit</button>
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