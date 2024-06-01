<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UserControlController extends Controller
{
    function index()
    {
        $data = User::all();
        return view('user_control.index', ['uc' => $data]);
    }

    function tambah()
    {
        return view('user_control.tambah');
    }
    function create(Request $request)
    {

        $gambar = '';

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'fullname' => 'required|min:4',
            'nama_lembaga' => 'required|min:4',
            'alamat_lembaga' => 'required|min:4',
            'telp_lembaga' => 'required|min:7',

        ], [
            'email.required' => 'Email Wajib Di isi',
            'email.email' => 'Format Email Invalid',
            'password.required' => 'Password Wajib Di isi',
            'password.min' => 'Password minimal harus 6 karakter.',
            'fullname.required' => 'Nama Koordinator Wajib Di isi',
            'fullname.min' => 'Bidang Nama Koordinator minimal harus 4 karakter.',
            'nama_lembaga.required' => 'Nama Lembaga Wajib Di isi',
            'nama_lembaga.min' => 'Bidang Nama Lembaga minimal harus 4 karakter.',
            'alamat_lembaga.required' => 'Alamat Lembaga Wajib Di isi',
            'alamat_lembaga.min' => 'Bidang Alamat Lembaga di isi alamat lengkap.',
            'telp_lembaga.required' => 'Nomor Telp/HP Wajib Di isi',
            'telp_lembaga.min' => 'Bidang Nomor Telp/HP minimal harus 7 karakter.',
        ]);

        if ($request->hasFile('gambar')) {

            $request->validate(['gambar' => 'mimes:jpeg,jpg,png,gif|image|file|max:1024']);

            $gambar_file = $request->file('gambar');
            $foto_ekstensi = $gambar_file->extension();
            $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
            $gambar_file->move(public_path('picture/accounts'), $nama_foto);
            $gambar = $nama_foto;
        } else {
            $gambar = "user.jpeg";
        }

        $accounts = User::create([
            'email' => $request->email,
            'password' => $request->password,
            'fullname' => $request->fullname,
            'nama_lembaga' => $request->nama_lembaga,
            'alamat_lembaga' => $request->alamat_lembaga,
            'telp_lembaga' => $request->telp_lembaga,
            'gambar' => $gambar,
        ]);

        $details = [
            'nama' => $accounts->fullname,
            'role' => 'user',
            'datetime' => date('Y-m-d H:i:s'),
        ];


        Session::flash('success', 'User berhasil ditambahkan');

        return redirect('/usercontrol');
    }

    function edit($id)
    {
        $data = User::where('id', $id)->get();
        return view('user_control.edit', ['uc' => $data]);
    }
    function detail($id)
    {
        $data = User::where('id', $id)->get();
        return view('user_control.detail', ['uc' => $data]);
    }
    function change(Request $request)
    {
        $request->validate([
            'gambar' => 'image|file|max:1024',
            'fullname' => 'required|min:4',
            'nama_lembaga' => 'required|min:4',
            'alamat_lembaga' => 'required|min:4',
            'telp_lembaga' => 'required|min:7',
        ], [
            'gambar.image' => 'File Wajib Image',
            'gambar.file' => 'Wajib File',
            'gambar.max' => 'Bidang gambar tidak boleh lebih besar dari 1024 kilobyte',
            'fullname.required' => 'Nama Wajib Di isi',
            'fullname.min' => 'Bidang nama minimal harus 4 karakter.',
        ]);

        $user = User::find($request->id);

        if ($request->hasFile('gambar')) {
            $gambar_file = $request->file('gambar');
            $foto_ekstensi = $gambar_file->extension();
            $nama_foto = date('ymdhis') . "." . $foto_ekstensi;
            $gambar_file->move(public_path('picture/accounts'), $nama_foto);
            $user->gambar = $nama_foto;
        }

        $user->fullname = $request->fullname;
        $user->password = $request->password;
        $user->nama_lembaga = $request->nama_lembaga;
        $user->alamat_lembaga = $request->alamat_lembaga;
        $user->telp_lembaga = $request->telp_lembaga;
        $user->save();

        Session::flash('success', 'User berhasil diedit');

        return redirect('/usercontrol');
    }
    public function hapus(Request $request){
        \DB::transaction(function () use ($request) {
            // Mencari User berdasarkan ID
            $user = User::findOrFail($request->id);

            // Menghapus semua penerimaan yang merujuk ke evaluasi dalam user ini
            \DB::table('penerimaan')
                ->whereIn('id_evaluasi', function($query) use ($request) {
                    $query->select('id')
                        ->from('evaluasi')
                        ->where('id_users', $request->id);
                })
                ->delete();

            // Menghapus semua evaluasi yang merujuk ke user ini
            \DB::table('evaluasi')
                ->where('id_users', $request->id)
                ->delete();

            // Menghapus semua data siswa yang merujuk ke user ini
            \DB::table('datasiswa')
                ->where('id_users', $request->id)
                ->delete();

            // Menghapus user
            $user->delete();
        });

        // Mengirim pesan sukses ke session
        Session::flash('success', 'Data berhasil dihapus');

        // Mengarahkan kembali ke halaman /usercontrol
        return redirect('/usercontrol');
    }
}
