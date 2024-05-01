<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;

    protected $table = 'evaluasi';

    protected $fillable = [
        'id_siswa',
        'id_periode',
        'kriteria_1',
        'kriteria_2',
        'kriteria_3',
        'kriteria_4',
        'kriteria_5',
        'kriteria_6',
        'sudah_diajukan'
    ];

    public function alternative()
    {
        return $this->belongsTo(DataSiswa::class, 'id_siswa');
    }

    public function period()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }
}
