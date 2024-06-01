<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Evaluasi;
use App\Models\Penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;


class PeriodeController extends Controller
{
    function index()
    {
        $periode = Periode::all();
        return view('periode.index', ['periode' => $periode]);
    }

    function tambah()
    {
        return view('periode.tambah');
    }
    function create(Request $request)
    {

        $request->validate([
            'nama_periode' => 'required',

        ], [
            'nama_periode' => 'minimal 1 angka',
        ]);

        if ($request->hasFile('pengumuman')) {
            $pengumuman_file = $request->file('pengumuman');
            $nama_file = date('ymdhis') . '.' . $pengumuman_file->getClientOriginalExtension();
            $pengumuman_file->move(public_path('data/pengumuman'), $nama_file);
            $pengumuman_path = 'data/pengumuman/' . $nama_file;
            $pengumuman = $nama_file;
        } 

        Periode::create([
            'nama_periode' => $request->nama_periode,
            'tgl_buka' => $request->tgl_buka,
            'tgl_tutup' => $request->tgl_tutup,
            //'status_periode' => $request->status_periode,
            'tgl_pengumuman' => $request->tgl_pengumuman,
            'kuota' => $request->kuota,
            'pengumuman' => $pengumuman,
        ]);

        Session::flash('success', 'Periode berhasil ditambahkan');

        return redirect('/periode');
    }

    function edit($id)
    {
        $periode = Periode::find($id);
        return view('periode.edit', ['periode' => $periode]);
    }
    
    function change(Request $request)
    {
        $request->validate([
            'nama_periode' => 'required',
        ], [
            'nama_periode' => 'minimal 1 angka',
        ]);

        $periode = Periode::find($request->id);

        if ($request->hasFile('pengumuman')) {
            $pengumuman_file = $request->file('pengumuman');
            $nama_file = date('ymdhis') . '.' . $pengumuman_file->getClientOriginalExtension();
            $pengumuman_file->move(public_path('data/pengumuman'), $nama_file);
            $pengumuman_path = 'data/pengumuman/' . $nama_file;
            $periode->pengumuman = $nama_file;
        } 

        $periode->nama_periode = $request->nama_periode;
        $periode->tgl_buka = $request->tgl_buka;
        $periode->tgl_tutup = $request->tgl_tutup;
        $periode->tgl_pengumuman = $request->tgl_pengumuman;
        $periode->status_periode = $request->status_periode;
        $periode->kuota = $request->kuota;
        $periode->save();

        Session::flash('success', 'Periode berhasil diedit');

        return redirect('/periode');
    }
    
    public function hapus(Request $request)
    {
        \DB::transaction(function () use ($request) {
            // Mencari Periode berdasarkan ID
            $periode = Periode::findOrFail($request->id);
    
            // Menghapus semua penerimaan yang merujuk ke evaluasi dalam periode ini
            \DB::table('penerimaan')
                ->whereIn('id_evaluasi', function($query) use ($request) {
                    $query->select('id')
                          ->from('evaluasi')
                          ->where('id_periode', $request->id);
                })
                ->delete();
    
            // Menghapus semua evaluasi yang merujuk ke periode ini
            \DB::table('evaluasi')
                ->where('id_periode', $request->id)
                ->delete();
    
            // Menghapus periode
            $periode->delete();
        });
    
        // Mengirim pesan sukses ke session
        Session::flash('success', 'Data berhasil dihapus');
    
        // Mengarahkan kembali ke halaman /periode
        return redirect('/periode');
    }
}
