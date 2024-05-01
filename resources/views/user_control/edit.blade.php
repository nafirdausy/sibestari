@extends('admin.layouts.index')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit User</h4>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @foreach ($uc as $item)
                    <form class="forms-sample" method="POST" action="/edituc" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Foto</label>
                            <div class="p-2">
                                <img src="{{ asset('picture/accounts/') }}/{{ $item->gambar }}" alt="Image"
                                    style="width: 150px; height: 150px;">
                            </div>
                            <input class="form-control" type="file" id="gambar" name="gambar">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Koordinator</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama Koordinator"
                                name="fullname" value="{{ $item->fullname }}">
                        </div>
                        <div class="form-group">
                            <label for="nama_lembaga">Nama Lembaga</label>
                            <input type="text" class="form-control" id="nama_lembaga" placeholder="Nama Lembaga"
                                name="nama_lembaga" value="{{ $item->nama_lembaga }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat_lembaga">Alamat</label>
                            <input type="text" class="form-control" id="alamat_lembaga" placeholder="Alamat"
                                name="alamat_lembaga" value="{{ $item->alamat_lembaga }}">
                        </div>
                        <div class="form-group">
                            <label for="telp_lembaga">Nomor Telp / HP</label>
                            <input type="text" class="form-control" id="telp_lembaga" placeholder="Nomor Telp / HP"
                                name="telp_lembaga" value="{{ $item->telp_lembaga }}">
                        </div>
                        
                        <input type="hidden" name="password" value="{{ $item->password }}">
                        <button type="submit" class="btn btn-primary me-2">Edit</button>
                        <a href="/usercontrol" class="btn btn-light">Kembali</a>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
