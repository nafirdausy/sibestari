<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;

    protected $table = 'evaluasi';

    protected $fillable = [
        'id_users',
        'id_siswa',
        'id_periode',
        'kriteria_1',
        'kriteria_2',
        'kriteria_3',
        'kriteria_4',
        'kriteria_5',
        'kriteria_6',
        'sudah_diajukan',
        'hasil'
    ];

    public function alternative()
    {
        return $this->belongsTo(DataSiswa::class, 'id_siswa');
    }

    public function period()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }

    public function penerimaan()
    {
        return $this->hasMany(Penerimaan::class, 'id_periode');
    }
}
