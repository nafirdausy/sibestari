<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    function index()
    {
        return view('halaman_auth/login');
    }
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {
            if (Auth::user()->email != null) {
                if (Auth::user()->role === 'admin') {
                    return redirect()->route('admin')->with('success', 'Halo Admin , Anda berhasil login');
                } else if (Auth::user()->role === 'user') {
                    return redirect()->route('user')->with('success', 'Berhasil login');
                }
            } else {
                Auth::logout();
            }
        } else {
            return redirect()->route('auth')->withErrors('Email atau password salah');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
