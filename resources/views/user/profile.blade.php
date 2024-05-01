@extends('user.layouts.index')

@section('main')
 
    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="/profile" >
    <div class="row">
        <div class="col-md-12 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-right">Profile Lembaga</h3>
                </div>
                @csrf
                <input type="hidden" name="user()" value="{{ Auth::user() }}">
                <div class="row" id="res"></div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Foto</label>
                    <div class="p-2">
                        <img src="{{ asset('picture/accounts/') }}/{{ Auth::user()->gambar }}" alt="image" 
                            style="width: 150px; height: 150px;">
                    </div>
                    <input class="form-control" type="file" id="gambar" name="gambar">
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Nama Koordinator</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Nama Koordinator" value="{{ Auth::user()->fullname }}">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Email</label>
                        <input type="text" name="email" disabled class="form-control" value="{{ Auth::user()->email }}" >
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="labels">Nama Lembaga</label>
                        <input type="text" name="nama_lembaga" class="form-control" placeholder="Nama Lembaga" value="{{ Auth::user()->nama_lembaga }}">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="labels">Alamat Lembaga</label>
                        <input type="text" name="alamat_lembaga" class="form-control" placeholder="Alamat Lembaga" value="{{ Auth::user()->alamat_lembaga }}">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label class="labels">Nomor Telp / Hp</label>
                        <input type="text" name="telp_lembaga" class="form-control" placeholder="Nomor Telp / Hp" value="{{ Auth::user()->telp_lembaga }}">
                    </div>
                </div>
                <div class="mt-5 text-center"><button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button></div>
            </div>
        </div>  
    </div>     
        </form>
@endsection