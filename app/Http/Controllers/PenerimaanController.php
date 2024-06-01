<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\NilaiKriteria;
use App\Models\Evaluasi;
use App\Models\Kriteria;
use App\Models\Periode;
use App\Models\Penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use PDF;
use Carbon\Carbon;

class PenerimaanController extends Controller
{
    public function index(Request $request){

        $user = Auth::user();
        $periodeId = $request->query('periodeId'); 
        $query = Penerimaan::with('alternatives', 'user');

        if ($user->role != 'admin') {
            // Jika bukan admin, filter berdasarkan ID pengguna
            $query->where('id_users', $user->id);

            // Filter juga berdasarkan tanggal pengumuman
            $today = now();
            $query->whereHas('periode', function($q) use ($today) {
                $q->where('tgl_pengumuman', '<=', $today);
            });
        } 

        if ($periodeId) {
            // Jika periode dipilih, filter berdasarkan ID periode
            $query->where('id_periode', $periodeId);
        }

        $dataPenerima = $query->get();
        $dataEvaluasi = Evaluasi::all();
        $dataPeriode = Periode::all();

        return view('penerima.index', [
            'dataEvaluasi' => $dataEvaluasi,
            'dataPeriode' => $dataPeriode,
            'dataPenerima' => $dataPenerima,
            'periodeId' => $periodeId,
        ]);
    }

    public function showRiwayat(Request $request){
        $user = Auth::user();
        $periodeId = $request->input('id_periode');
        $query = Penerimaan::with('alternatives')->where('id_periode', $periodeId);

        if ($user->role != 'admin') {
            // Jika bukan admin, filter berdasarkan ID pengguna
            $query->where('id_users', $user->id);

            // Filter juga berdasarkan tanggal pengumuman
            $today = now();
            $query->whereHas('periode', function($q) use ($today) {
                $q->where('tgl_pengumuman', '<=', $today);
            });
        }

        $dataPenerima = $query->get();
        $dataPeriode = Periode::all();

        return view('penerima.index', compact('periodeId', 'dataPenerima', 'dataPeriode'));
    }

    public function cetak($id_periode)
    {
        $cetakperiode = Penerimaan::with('alternatives', 'user')->where('id_periode', [$id_periode])->get();
        return view('penerima.cetak', compact('cetakperiode'));
    }

}