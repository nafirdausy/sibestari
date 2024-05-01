<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    function index()
    {
        return view('user/index');
    }

    function profile()
    {
        return view('user/profile');
    }

    function profileedit(Request $request)
    {
        $request->validate([
            'gambar' => 'image|file|max:1024',
            'fullname' => 'required|min:4',
            'nama_lembaga' => 'required|min:4',
            'alamat_lembaga' => 'required|min:4',
            'telp_lembaga' => 'required|min:7',
        ]);

        $user = auth()->user();

        if ($request->hasFile('gambar')) {
            $gambar_file = $request->file('gambar');
            $foto_ekstensi = $gambar_file->extension();
            $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
            $gambar_file->move(public_path('picture/accounts'), $nama_foto);
            $user->gambar = $nama_foto;
        }

        $user->fullname = $request->fullname;
        $user->nama_lembaga = $request->nama_lembaga;
        $user->alamat_lembaga = $request->alamat_lembaga;
        $user->telp_lembaga = $request->telp_lembaga;
        $user->save();

        Session::flash('success', 'User berhasil diedit');

        return redirect('/profile');
    }
}
