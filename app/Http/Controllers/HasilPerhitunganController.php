<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\NilaiKriteria;
use App\Models\Evaluasi;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilPerhitunganController extends Controller
{
    public function index()
    {
        $copras = new Perhitungan();
        $ranking = $copras->hitungCOPRAS();

        $datas = json_decode($ranking->content(), true);
        return view('hasil.index', compact('datas'));
    }

    public function create()
    {
        $kriteria_2 = NilaiKriteria::where('id_kriteria', 2)->get();
        $kriteria_3 = NilaiKriteria::where('id_kriteria', 3)->get();
        $kriteria_4 = NilaiKriteria::where('id_kriteria', 4)->get();
        $kriteria_5 = NilaiKriteria::where('id_kriteria', 5)->get();
        $kriteria_6 = NilaiKriteria::where('id_kriteria', 6)->get();
        return view('hasil.create',[
            'kriteria_2' => $kriteria_2,
            'kriteria_3' => $kriteria_3,
            'kriteria_4' => $kriteria_4,
            'kriteria_5' => $kriteria_5,
            'kriteria_6' => $kriteria_6,
        ]);
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $alternativeName = DataSiswa::create([
                'nama' => $request->nama,
                'nik'=> $request->nik,
                'jenis_kelamin'=> $request->jenis_kelamin,
                'tempat_lahir'=> $request->tempat_lahir,
                'tanggal_lahir'=> $request->tanggal_lahir,
                'hobi'=> $request->hobi,
                'penyakit'=> $request->penyakit,
                'norek'=> $request->norek,
                'nisn'=> $request->nisn,
                'sekolah'=> $request->sekolah,
                'jenjang'=> $request->jenjang,
                'kelas'=> $request->kelas,
                'alamat'=> $request->alamat,
                'presdes'=> $request->presdes,
                'tpq'=> $request->tpq,
                'tempat_tpq'=> $request->tempat_tpq,
                'jilid'=> $request->jilid,
                'sholat'=> $request->sholat,
                'bimbel'=> $request->bimbel,
                'tempat_bimbel'=> $request->tempat_bimbel,
                'nama_ayah'=> $request->nama_ayah,
                'nama_ibu'=> $request->nama_ibu,
                'pekerjaan'=> $request->pekerjaan,
                'alamat_ortu'=> $request->alamat_ortu,
                'telp'=> $request->telp,
                'kriteria_1' => $request->kriteria_1,
                'kriteria_2' => $request->kriteria_2,
                'kriteria_3' => $request->kriteria_3,
                'kriteria_4' => $request->kriteria_4,
                'kriteria_5' => $request->kriteria_5,
                'kriteria_6' => $request->kriteria_6,
            ]);

            Evaluasi::create([
                'id_siswa' => $alternativeName->id,
                'kriteria_1' => $alternativeName->kriteria_1,
                'kriteria_2' => $alternativeName->kriteria_2,
                'kriteria_3' => $alternativeName->kriteria_3,
                'kriteria_4' => $alternativeName->kriteria_4,
                'kriteria_5' => $alternativeName->kriteria_5,
                'kriteria_6' => $alternativeName->kriteria_6,
            ]);

            DB::commit();
            return redirect()->route('hasil.index')->with('success', 'Data added successfully');
        } catch (\Throwable $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->route('hasil.create')->with('error', 'Data failed to add');
        }
    }
}
