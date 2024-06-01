<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Periode;
use App\Models\Penerimaan;
use App\Models\DataSiswa;
use App\Models\Evaluasi;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        $jumlahKoor = User::where('role', 'user')->count();
        $lastPeriode = Periode::latest()->first();

        $user = Auth::user();
        $query = Penerimaan::query();

        //if ($user->role != 'admin') {
        //    $query->where('penerimaan.id_users', $user->id);
        //}

        $dataPenerima = $query->select('datasiswa.jenjang', DB::raw('count(*) as total'))
                              ->join('datasiswa', 'penerimaan.id_siswa', '=', 'datasiswa.id')
                              ->groupBy('datasiswa.jenjang')
                              ->get();

        // Hitung total evaluasi dan penerimaan
        $totalEvaluasi = Evaluasi::count();
        $totalPenerimaan = Penerimaan::count();

        return view('admin.index', [
            'jumlahKoor' => $jumlahKoor, 
            'lastPeriode' => $lastPeriode, 
            'dataPenerima' => $dataPenerima,
            'totalEvaluasi' => $totalEvaluasi,
            'totalPenerimaan' => $totalPenerimaan
        ]);
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
