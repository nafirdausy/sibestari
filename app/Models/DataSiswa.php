<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSiswa extends Model
{
    use HasFactory;
    public $table = 'datasiswa';
    public $fillable = [
        'id_users',
        'nama',
        'nik',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'hobi',
        'penyakit',
        'norek',
        'nisn',
        'sekolah',
        'jenjang',
        'kelas',
        'alamat',
	    'presdes',
        'tpq',
        'tempat_tpq',
        'jilid',
        'sholat',
        'bimbel',
        'tempat_bimbel',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan',
        'alamat_ortu',
        'telp',
        'nama_wali',
        'pekerjaan_wali',
        'alamat_wali',
        'hubungan',
        'telp_wali',
        'raport',
        'surat_kematian',
        'kk',
        'ktp',
        'sktm',
        'foto',
        'kriteria_1',
        'kriteria_2',
        'kriteria_3',
        'kriteria_4',
        'kriteria_5',
        'kriteria_6',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

}
