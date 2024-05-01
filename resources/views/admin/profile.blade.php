@extends('admin.layouts.index')


@section('main')
 
    <form method="POST" enctype="multipart/form-data" id="profile_setup_frm" action="/profile" >
    <div class="row">
        <div class="col-md-12 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-right">Profile Settings</h3>
                </div>
                @csrf
                <input type="hidden" name="user()" value="{{ Auth::user() }}">
                <div class="row" id="res"></div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Foto</label>
                    <div class="p-2">
                        <img src="{{ asset('picture/accounts') }}/{{ Auth::user()->gambar }}" alt="image" 
                            style="width: 150px; height: 150px;">
                    </div>
                    <input class="form-control" type="file" id="gambar" name="gambar">
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="labels">Nama Admin</label>
                        <input type="text" name="fullname" disabled class="form-control" value="{{ Auth::user()->fullname }}">
                    </div>
                    <div class="col-md-6">
                        <label class="labels">Email</label>
                        <input type="text" name="email" disabled class="form-control" value="{{ Auth::user()->email }}" >
                    </div>
                </div>
            </div>
        </div>  
    </div>   
            
        </form>
@endsection