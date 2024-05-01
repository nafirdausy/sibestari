@extends('admin.layouts.index')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Periode</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form class="forms-sample" method="POST" action="/editperiode" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="id" value="{{ $periode->id }}">
                    <div class="form-group">
                        <label for="nama_periode">Periode</label>
                        <input type="number" class="form-control" placeholder="Masukkan Periode."
                            name="nama_periode" value="{{ $periode->nama_periode }}">
                    </div>
                    <div class="form-group">
                        <label for="tgl_buka">Tanggal Pendaftaran Dibuka</label>
                        <input type="date" name="tgl_buka" class="form-control" value="{{ $periode->tgl_buka }}">
                    </div>
                    <div class="form-group">
                        <label for="tgl_buka">Tanggal Pendaftaran Ditutup</label>
                        <input type="date" name="tgl_tutup" class="form-control" value="{{ $periode->tgl_tutup }}">
                    </div>
                    <div class="form-group">
                        <label for="kuota">Kuota</label>
                        <input type="number" class="form-control" placeholder="Masukkan Jumlah Kuota."
                            name="kuota" value="{{ $periode->kuota }}">
                    </div>
                    <div class="form-group">
                        <label for="pengumuman">Upload File Pengumuman</label>
                        <input type="file" class="form-control-file" id="pengumuman" name="pengumuman" value="{{ $periode->pengumuman }}">
                    </div>
                        <input type="hidden" name="password" value="{{ $periode->password }}">
                        <button type="submit" class="btn btn-primary me-2">Edit</button>
                        <a href="/periode" class="btn btn-light">Kembali</a>
                    </form>
            </div>
        </div>
    </div>
@endsection
