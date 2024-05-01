<?php

namespace Database\Seeders;

use App\Models\Periode;
use Illuminate\Database\Seeder;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periodes = [
        /** 1 */    ['nama_periode' => '11', 'tgl_buka' => '2024-04-03', 'tgl_tutup' => '2024-04-27', 'status_periode' => 'tutup', 'kuota' => 5, 'pengumuman' => '240427022018.pdf'],
        /** 2 */    ['nama_periode' => '12', 'tgl_buka' => '2024-04-26', 'tgl_tutup' => '2024-04-27', 'status_periode' => 'tutup', 'kuota' => 7, 'pengumuman' => '240428034043.pdf'],
        /** 3 */    ['nama_periode' => '13', 'tgl_buka' => '2024-04-03', 'tgl_tutup' => '2024-05-05', 'status_periode' => 'buka', 'kuota' => 5, 'pengumuman' => '240428042315.pdf'],
        ];

        foreach ($periodes as $periode) {
            Periode::create($periode);
        }
    }
}
