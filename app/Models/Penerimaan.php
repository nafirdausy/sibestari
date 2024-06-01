<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerimaan extends Model
{
    use HasFactory;

    protected $table = 'penerimaan';

    protected $fillable = [
        'id_users',
        'id_siswa',
        'id_periode',
        'id_evaluasi',
        'hasil',
        'diterima'
    ];

    public function alternatives()
    {
        return $this->belongsTo(DataSiswa::class, 'id_siswa');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }

    public function eval()
    {
        return $this->belongsTo(Evaluasi::class, 'id_evaluasi');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_users');
    }
}
