<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    function index()
    {
        return view('admin/index');
    }

    function profile()
    {
        return view('admin/profile');
    }

    function profileedit(Request $request)
    {
        $request->validate([
            'gambar' => 'image|file|max:1024',
            'fullname' => 'required|min:4',
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

        Session::flash('success', 'User berhasil diedit');

        return redirect('/profile');
    }
}
