@extends('admin.layouts.index')
@section('main')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Detail Koordinator</h4>
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
                    <form class="forms-sample" method="POST" action="/detailuc" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Foto</label>
                            <div class="p-2">
                                <img src="{{ asset('picture/accounts/') }}/{{ $item->gambar }}" alt="Image"
                                    style="width: 150px; height: 150px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama">Email</label>
                            <input type="text" class="form-control" id="email" 
                                name="email" value="{{ $item->email }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Koordinator</label>
                            <input type="text" class="form-control" id="nama" 
                                name="fullname" value="{{ $item->fullname }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_lembaga">Nama Lembaga</label>
                            <input type="text" class="form-control" id="nama_lembaga" 
                                name="nama_lembaga" value="{{ $item->nama_lembaga }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="alamat_lembaga">Alamat</label>
                            <input type="text" class="form-control" id="alamat_lembaga" 
                                name="alamat_lembaga" value="{{ $item->alamat_lembaga }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="telp_lembaga">Nomor Telp / HP</label>
                            <input type="text" class="form-control" id="telp_lembaga" 
                                name="telp_lembaga" value="{{ $item->telp_lembaga }}" readonly>
                        </div>
                        
                        <input type="hidden" name="password" value="{{ $item->password }}">
                        <a href="/usercontrol" class="btn btn-light">Kembali</a>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
