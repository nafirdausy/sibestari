<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\NilaiKriteria;
use App\Models\Evaluasi;
use App\Models\Kriteria;
use App\Models\Penerimaan;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HasilPerhitunganController extends Controller
{

    public function index(Request $request){
        // Ambil periode terkini yang dipilih dari session, jika tidak tersedia, gunakan null sebagai default
        $periodeId = session('periodeId', null);

        // Ambil data periode untuk ditampilkan di dropdown
        $dataPeriode = Periode::all();

        // Ambil data evaluasi sesuai dengan periode yang dipilih
        $query = Evaluasi::query();
        if ($periodeId) {
            $query->where('id_periode', $periodeId);
        }
        $dataEvaluasi = $query->orderBy('hasil', 'desc')->get();

        // Ambil data kuota untuk periode yang dipilih
        $kuota = 0;
        if ($periodeId) {
            $periode = Periode::find($periodeId);
            if ($periode) {
                $kuota = $periode->kuota;
            }
        }

        return view('hasil.index', [
            'dataEvaluasi' => $dataEvaluasi,
            'dataPeriode' => $dataPeriode,
            'periodeId' => $periodeId,
            'kuota' => $kuota,
            'jumlahDaftar' => $dataEvaluasi->count() // Jumlah daftar hasil evaluasi
        ]);
    }


    public function showRiwayat(Request $request)
    {
        $periodeId = $request->input('id_periode');

        // Simpan periode yang dipilih dalam session
        session(['periodeId' => $periodeId]);

        return redirect()->route('hasil.index');
    }

    public function terima(Request $request)
    {
        $siswat = Evaluasi::where('id', $request->id)->get();

        foreach ($siswat as $nilai) {
            Penerimaan::create([
                'id_users' => $nilai->id_users,
                'id_siswa' => $nilai->id_siswa,
                'id_periode' => $nilai->id_periode,
                'id_evaluasi' => $nilai->id,
                'hasil' => $nilai->hasil,
                'diterima' => true
            ]);
        }

        // Redirect dengan pesan sukses
        return redirect()->route('hasil.index')->with('success', 'Data siswa berhasil diterima.');
    }

    function hapus(Request $request)
    {
        $hps = DB::table('Evaluasi')
                        ->where('id', $request->id)
                        ->pluck('id');

        DB::table('Penerimaan')->whereIn('id_evaluasi', $hps)->delete();

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('hasil.index')->with('success', 'Berhasil Hapus Data');
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
