@extends('user.layouts.index')

@section('main')
 
<form method="post" action="{{ route('password.reset') }}">
    <div class="row">
        <div class="col-md-12 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-right">Ubah Password</h3>
                </div>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                @csrf
                <input type="hidden" name="user()" value="{{ Auth::user() }}">
                <div class="row" id="res"></div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Foto</label>
                    <div class="p-2">
                        <img src="{{ asset('picture/accounts/') }}/{{ Auth::user()->gambar }}" alt="image" 
                            style="width: 150px; height: 150px;">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Nama Koordinator</label>
                        <input type="text" name="fullname" disabled class="form-control" placeholder="Nama Koordinator" value="{{ Auth::user()->fullname }}">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Email</label>
                        <input type="text" name="email" disabled class="form-control" value="{{ Auth::user()->email }}" >
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label for="old_password">Password Lama</label>
                        <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror" required>
                            @error('old_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <label for="password_confirmation">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="mt-5 text-center">
                <button type="submit" class="btn btn-primary">Ubah Password</button>
                </div>
            </div>
        </div>  
    </div>     
        </form>
@endsection