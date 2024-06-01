<?php

namespace App\Http\Controllers;

use App\Models\DataSiswa;
use App\Models\NilaiKriteria;
use App\Models\Evaluasi;
use App\Models\Kriteria;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class DataSiswaController extends Controller
{
    function index(Request $request)
    {
        $user = Auth::user();
        $periode = $request->query('periode'); 

        $dataPeriode = Periode::all();
        $periodeTerbaru = $periode ? Periode::where('id', $periode)->first() : null;

        // Jika user adalah admin, ambil semua data
        if ($user->role == 'admin') {
            $data = DataSiswa::all();
        } else {
            // Jika bukan admin, ambil data yang sesuai dengan user_id
            $data = DataSiswa::where('id_users', $user->id)->get();
        }

        $dataEvaluasi = Evaluasi::all();
 
        return view('data_siswa.index', [
            'data' => $data,
            'dataEvaluasi' => $dataEvaluasi,
            'dataPeriode' => $dataPeriode,
            'periode' => $periode,
            'periodeTerbaru' => $periodeTerbaru
        ]);
    }

    public function show(Request $request)
    {
        $periode = $request->input('id');
        return redirect()->route('datasiswa.show', ['periode' => $periode]);
    }

    function detail($id)
    {
        $data = DataSiswa::find($id);
        $kriteria_2 = NilaiKriteria::where('id_kriteria', 2)->get();
        $kriteria_3 = NilaiKriteria::where('id_kriteria', 3)->get();
        $kriteria_4 = NilaiKriteria::where('id_kriteria', 4)->get();
        $kriteria_5 = NilaiKriteria::where('id_kriteria', 5)->get();
        $kriteria_6 = NilaiKriteria::where('id_kriteria', 6)->get();
        return view('data_siswa.detail',[
            'kriteria_2' => $kriteria_2,
            'kriteria_3' => $kriteria_3,
            'kriteria_4' => $kriteria_4,
            'kriteria_5' => $kriteria_5,
            'kriteria_6' => $kriteria_6,
            'data' => $data
        ]);
        //return view('data_siswa.detail', ['data' => $data]);
    }
    function tambah()
    {
        $kriteria_2 = NilaiKriteria::where('id_kriteria', 2)->get();
        $kriteria_3 = NilaiKriteria::where('id_kriteria', 3)->get();
        $kriteria_4 = NilaiKriteria::where('id_kriteria', 4)->get();
        $kriteria_5 = NilaiKriteria::where('id_kriteria', 5)->get();
        $kriteria_6 = NilaiKriteria::where('id_kriteria', 6)->get();
        return view('data_siswa.tambah',[
            'kriteria_2' => $kriteria_2,
            'kriteria_3' => $kriteria_3,
            'kriteria_4' => $kriteria_4,
            'kriteria_5' => $kriteria_5,
            'kriteria_6' => $kriteria_6,
        ]);
        //return view('data_siswa.tambah');
    }
    function edit($id)
    {
        $data = DataSiswa::find($id);
        $kriteria_2 = NilaiKriteria::where('id_kriteria', 2)->get();
        $kriteria_3 = NilaiKriteria::where('id_kriteria', 3)->get();
        $kriteria_4 = NilaiKriteria::where('id_kriteria', 4)->get();
        $kriteria_5 = NilaiKriteria::where('id_kriteria', 5)->get();
        $kriteria_6 = NilaiKriteria::where('id_kriteria', 6)->get();
        return view('data_siswa.edit',[
            'kriteria_2' => $kriteria_2,
            'kriteria_3' => $kriteria_3,
            'kriteria_4' => $kriteria_4,
            'kriteria_5' => $kriteria_5,
            'kriteria_6' => $kriteria_6,
            'data' => $data
        ]);
        //return view('data_siswa.edit', ['data' => $data]);
    }

    public function hapus(Request $request)
    {
        \DB::transaction(function () use ($request) {
            // Mencari Periode berdasarkan ID
            $data = DataSiswa::findOrFail($request->id);
    
            // Menghapus semua penerimaan yang merujuk ke evaluasi dalam periode ini
            \DB::table('penerimaan')
                ->whereIn('id_evaluasi', function($query) use ($request) {
                    $query->select('id')
                          ->from('evaluasi')
                          ->where('id_siswa', $request->id);
                })
                ->delete();
    
            // Menghapus semua evaluasi yang merujuk ke periode ini
            \DB::table('evaluasi')
                ->where('id_siswa', $request->id)
                ->delete();
    
            // Menghapus periode
            $data->delete();
        });
    
        // Mengirim pesan sukses ke session
        Session::flash('success', 'Data berhasil dihapus');
    
        // Mengarahkan kembali ke halaman /periode
        return redirect('/datasiswa');
    }
    // new
    function create(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|min:16',
            'jenis_kelamin' => 'required',
            'tempat_lahir'=> 'required',
            'tanggal_lahir'=> 'required',
            'hobi'=> 'required',
            'penyakit',
            'norek',
            'nisn'=> 'required',
            'sekolah'=> 'required',
            'jenjang'=> 'required',
            'kelas'=> 'required',
            'alamat'=> 'required',
	        'presdes',
            'tpq'=> 'required',
            'tempat_tpq',
            'jilid'=> 'required',
            'sholat'=> 'required',
            'bimbel'=> 'required',
            'tempat_bimbel',
            'nama_ayah'=> 'required',
            'nama_ibu'=> 'required',
            'pekerjaan' ,
            'alamat_ortu',
            'telp',
            'nama_wali',
            'pekerjaan_wali',
            'alamat_wali',
            'hubungan',
            'telp_wali',
        ], [
            'nama.required' => 'Name Wajib di Isi.',
            'nik.required' => 'NIK Wajib di Isi.',
            'nik.min' => 'Bidang NIK harus 16 Angka.',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib di Isi.',
            'tempat_lahir.required' => 'Tempat Lahir Wajib di Isi.',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajib di Isi.',
            'hobi.required' => 'Hobi Wajib di Isi.',
            'nisn.required' => 'NISN Wajib di Isi.',
            'sekolah.required' => 'Nama Sekolah Wajib di Isi.',
            'jenjang.required' => 'Jenjang Sekolah Wajib di Isi.',
            'kelas.required' => 'Kelas Wajib di Isi.',
            'alamat.required' => 'Alamat Wajib di Isi.',
            'tpq.required' => 'Mengikuti TPQ Wajib di Isi.',
            'jilid.required' => 'Kemampuan Membaca Al-Quran Wajib di Isi.',
            'sholat.required' => 'Sholat Fardhu Wajib di Isi.',
            'bimbel.required' => 'Mengikuti Wajib di Isi.',
            'nama_ayah.required' => 'Nama Ayah Wajib di Isi.',
            'nama_ibu.required' => 'Nama Ibu Wajib di Isi.',
        ]);

        if ($request->hasFile('foto')) {
            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->extension();
            $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('picture/siswa'), $nama_foto);
            $foto = $nama_foto;
        }
        if ($request->hasFile('raport')) {
            $raport_file = $request->file('raport');
            $nama_file = date('ymdhis') . '.' . $raport_file->getClientOriginalExtension();
            $raport_file->move(public_path('data/raport'), $nama_file);
            $raport_path = 'data/raport/' . $nama_file;
            $raport = $nama_file;
        } 
        if ($request->hasFile('surat_kematian')) {
            $surat_kematian_file = $request->file('surat_kematian');
            $nama_file = date('ymdhis') . '.' . $surat_kematian_file->getClientOriginalExtension();
            $surat_kematian_file->move(public_path('data/sk'), $nama_file);
            $surat_kematian_path = 'data/sk/' . $nama_file;
            $surat_kematian = $nama_file;
        } 
        if ($request->hasFile('kk')) {
            $kk_file = $request->file('kk');
            $nama_file = date('ymdhis') . '.' . $kk_file->getClientOriginalExtension();
            $kk_file->move(public_path('data/kk'), $nama_file);
            $kk_path = 'data/kk/' . $nama_file;
            $kk = $nama_file;
        }
        if ($request->hasFile('ktp')) {
            $ktp_file = $request->file('ktp');
            $nama_file = date('ymdhis') . '.' . $ktp_file->getClientOriginalExtension();
            $ktp_file->move(public_path('data/ktp'), $nama_file);
            $ktp_path = 'data/ktp/' . $nama_file;
            $ktp = $nama_file;  
        }
        if ($request->hasFile('sktm')) {
            $sktm_file = $request->file('sktm');
            $nama_file = date('ymdhis') . '.' . $sktm_file->getClientOriginalExtension();
            $sktm_file->move(public_path('data/sktm'), $nama_file);
            $sktm_path = 'data/sktm/' . $nama_file;
            $sktm = $nama_file;
        }

        DataSiswa::create([
            'id_users' => Auth::id(),
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
            'foto'=> $foto,
            'raport'=> $raport,
            'surat_kematian'=> $surat_kematian,
            'kk'=> $kk,
            'ktp'=> $ktp,
            'sktm'=> $sktm,
            'kriteria_1' => $request->kriteria_1,
            'kriteria_2' => $request->kriteria_2,
            'kriteria_3' => $request->kriteria_3,
            'kriteria_4' => $request->kriteria_4,
            'kriteria_5' => $request->kriteria_5,
            'kriteria_6' => $request->kriteria_6,
        ]);

        Session::flash('success', 'Data berhasil ditambahkan');
        return redirect('/datasiswa')->with('success', 'Berhasil Menambahkan Data');
    }
    function change(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|min:16',
            'jenis_kelamin' => 'required',
            'tanggal_lahir'=> 'required',
            'hobi'=> 'required',
            'penyakit',
            'norek',
            'nisn'=> 'required',
            'sekolah'=> 'required',
            'jenjang'=> 'required',
            'kelas'=> 'required',
            'alamat'=> 'required',
	        'presdes',
            'tpq'=> 'required',
            'tempat_tpq',
            'jilid'=> 'required',
            'sholat'=> 'required',
            'bimbel'=> 'required',
            'tempat_bimbel',
            'nama_ayah'=> 'required',
            'nama_ibu'=> 'required',
            'pekerjaan' ,
            'alamat_ortu',
            'telp',
            'nama_wali',
            'pekerjaan_wali',
            'alamat_wali',
            'hubungan',
            'telp_wali',
        ], [
            'nama.required' => 'Name Wajib di Isi.',
            'nik.required' => 'NIK Wajib di Isi.',
            'nik.min' => 'Bidang NIK harus 16 Angka.',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib di Isi.',
            'tempat_lahir.required' => 'Tempat Lahir Wajib di Isi.',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajib di Isi.',
            'hobi.required' => 'Hobi Wajib di Isi.',
            'nisn.required' => 'NISN Wajib di Isi.',
            'sekolah.required' => 'Nama Sekolah Wajib di Isi.',
            'jenjang.required' => 'Jenjang Sekolah Wajib di Isi.',
            'kelas.required' => 'Kelas Wajib di Isi.',
            'alamat.required' => 'Alamat Wajib di Isi.',
            'tpq.required' => 'Mengikuti TPQ Wajib di Isi.',
            'jilid.required' => 'Kemampuan Membaca Al-Quran Wajib di Isi.',
            'sholat.required' => 'Sholat Fardhu Wajib di Isi.',
            'bimbel.required' => 'Mengikuti Wajib di Isi.',
            'nama_ayah.required' => 'Nama Ayah Wajib di Isi.',
            'nama_ibu.required' => 'Nama Ibu Wajib di Isi.',
        ]);

        $alternativeName = DataSiswa::find($request->id);
        $alternativeName->id_siswa = Auth::id();
        $alternativeName->nama = $request->nama;
        $alternativeName->nik= $request->nik;
        $alternativeName->jenis_kelamin= $request->jenis_kelamin;
        $alternativeName->tempat_lahir= $request->tempat_lahir;
        $alternativeName->tanggal_lahir= $request->tanggal_lahir;
        $alternativeName->hobi= $request->hobi;
        $alternativeName->penyakit= $request->penyakit;
        $alternativeName->norek= $request->norek;
        $alternativeName->nisn= $request->nisn;
        $alternativeName->sekolah= $request->sekolah;
        $alternativeName->jenjang= $request->jenjang;
        $alternativeName->kelas= $request->kelas;
        $alternativeName->alamat= $request->alamat;
        $alternativeName->presdes= $request->presdes;
        $alternativeName->tpq= $request->tpq;
        $alternativeName->tempat_tpq= $request->tempat_tpq;
        $alternativeName->jilid= $request->jilid;
        $alternativeName->sholat= $request->sholat;
        $alternativeName->bimbel= $request->bimbel;
        $alternativeName->tempat_bimbel= $request->tempat_bimbel;
        $alternativeName->nama_ayah= $request->nama_ayah;
        $alternativeName->nama_ibu= $request->nama_ibu;
        $alternativeName->pekerjaan= $request->pekerjaan;
        $alternativeName->alamat_ortu= $request->alamat_ortu;
        $alternativeName->telp= $request->telp; 
        $alternativeName->foto= $foto;
        $alternativeName->raport= $raport;
        $alternativeName->surat_kematian= $surat_kematian;
        $alternativeName->kk= $kk;
        $alternativeName->ktp= $ktp;
        $alternativeName->sktm= $sktm;

        $alternativeName->nama_wali= $request->nama_wali;
        $alternativeName->pekerjaan_wali= $request->pekerjaan_wali;
        $alternativeName->alamat_wali= $request->alamat_wali;
        $alternativeName->hubungan= $request->hubungan;
        $alternativeName->telp_wali= $request->telp_wali;
        $alternativeName->kriteria_1 = $request->kriteria_1;
        $alternativeName->kriteria_2= $request->kriteria_2;
        $alternativeName->kriteria_3= $request->kriteria_3;
        $alternativeName->kriteria_4= $request->kriteria_4;
	    $alternativeName->kriteria_5= $request->kriteria_5;
        $alternativeName->kriteria_6= $request->kriteria_6;
        $alternativeName->save();

        Session::flash('success', 'Berhasil Mengubah Data');
        return redirect('/datasiswa');
    }

    public function ajukan(Request $request)
    {

        $periodeTerbaru = Periode::find($request->input('id_periode'));
        $siswa = DataSiswa::where('id', $request->id)->get();

        foreach ($siswa as $nilai) {
            Evaluasi::create([
                'id_users' => $nilai->id_users,
                'id_siswa' => $nilai->id,
                'kriteria_1' => $nilai->kriteria_1,
                'kriteria_2' => $nilai->kriteria_2,
                'kriteria_3' => $nilai->kriteria_3,
                'kriteria_4' => $nilai->kriteria_4,
                'kriteria_5' => $nilai->kriteria_5,
                'kriteria_6' => $nilai->kriteria_6,
                'sudah_diajukan' => true,
                'id_periode' => $periodeTerbaru->id,
            ]);
        }
        return redirect()->back()->with('success', 'Pengajuan berhasil!');
    }
}
