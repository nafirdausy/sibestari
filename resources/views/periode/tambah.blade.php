@extends('admin.layouts.index')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Tambah Periode</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/tambahperiode" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama_periode">Periode</label>
                        <input type="number" class="form-control" id="nama_periode" placeholder="Masukkan Periode."
                            name="nama_periode">
                    </div>
                    <div class="form-group">
                        <label for="tgl_buka">Tanggal Pendaftaran Dibuka</label>
                        <input type="date" name="tgl_buka" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tgl_buka">Tanggal Pendaftaran Ditutup</label>
                        <input type="date" name="tgl_tutup" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tgl_buka">Tanggal Pengumuman</label>
                        <input type="date" name="tgl_pengumuman" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="kuota">Kuota</label>
                        <input type="number" class="form-control" id="kuota" placeholder="Masukkan Jumlah Kuota."
                            name="kuota">
                    </div>
                    <div class="form-group">
                        <label for="pengumuman">Upload File Pengumuman</label>
                        <input type="file" class="form-control-file" id="pengumuman" name="pengumuman">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Tambah</button>
                    <a href="/periode" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
