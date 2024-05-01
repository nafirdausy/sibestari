<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periode';

    protected $fillable = [
        'nama_periode',
        'tgl_buka',
        'tgl_tutup',
        'status_periode',
        'kuota',
        'pengumuman'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($periode) {
            // Perform status update logic here
            $periode->updateStatusPeriode();
        });
    }

    public function updateStatusPeriode()
    {
        $today = Carbon::now()->toDateString();
        
        // Check if today is between tanggal_mulai and tanggal_selesai
        if ($today >= $this->tgl_buka && $today <= $this->tgl_tutup) {
            $this->status_periode = 'buka';
        } else {
            $this->status_periode = 'tutup';
        }
        
    }

}