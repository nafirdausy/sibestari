@extends('admin.layouts.index')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Tambah User</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="forms-sample" method="POST" action="/tambahuc" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input class="form-control" type="file" id="gambar" name="gambar">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukkan Email."
                            name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Masukkan Password."
                            name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Koordinator</label>
                        <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Koordinator."
                            name="fullname" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_lembaga">Nama Lembaga</label>
                        <input type="text" class="form-control" id="nama_lembaga" placeholder="Masukkan Nama Lembaga."
                            name="nama_lembaga" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_lembaga">Alamat</label>
                        <input type="text" class="form-control" id="alamat_lembaga" placeholder="Masukkan Alamat."
                            name="alamat_lembaga" required>
                    </div>
                    <div class="form-group">
                        <label for="telp_lembaga">Nomor Telp / HP</label>
                        <input type="text" class="form-control" id="telp_lembaga" placeholder="Masukkan Nomor Telp."
                            name="telp_lembaga" required>
                    </div>


                    <button type="submit" class="btn btn-primary me-2">Tambah</button>
                    <a href="/usercontrol" class="btn btn-light">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
