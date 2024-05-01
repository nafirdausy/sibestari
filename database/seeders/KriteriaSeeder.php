<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kriterias = [
        /** 1 */    ['kriteria' => 'Nilai Rapot', 'bobot' => 60, 'atribut' => 'benefit'],
        /** 2 */    ['kriteria' => 'Prestasi Non Akademik', 'bobot' => 25, 'atribut' => 'benefit'],
        /** 3 */    ['kriteria' => 'Status Orang Tua', 'bobot' => 6, 'atribut' => 'benefit'],
        /** 4 */    ['kriteria' => 'Anak ke dari jumlah saudara', 'bobot' => 3, 'atribut' => 'cost'],
        /** 5 */    ['kriteria' => 'Tingkatan Mengaji', 'bobot' => 3, 'atribut' => 'benefit'],
        /** 6 */    ['kriteria' => 'Tempat Tinggal', 'bobot' => 3, 'atribut' => 'benefit'],
        ];

        foreach ($kriterias as $kriteria) {
            Kriteria::create($kriteria);
        }
    }
}
