<?php

namespace Database\Seeders;

use App\Models\Evaluasi;
use Illuminate\Database\Seeder;

class EvaluasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $evaluasis = [
        /** 1 */    [
                    'id_users' => 2,
                    'id_siswa' => 1,
                    'id_periode' => 1,
                    'kriteria_1' => 80,
                    'kriteria_2' => 40,
                    'kriteria_3' => 75,
                    'kriteria_4' => 100,
                    'kriteria_5' => 100,
                    'kriteria_6' => 50,
                    'sudah_diajukan' => 1,
                    ],
        /** 2 */    [
            'id_users' => 2,
                    'id_siswa' => 2,
                    'id_periode' => 1,
                    'kriteria_1' => 81,
                    'kriteria_2' => 0,
                    'kriteria_3' => 100,
                    'kriteria_4' => 50,
                    'kriteria_5' => 100,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 3 */    [
            'id_users' => 2,
                    'id_siswa' => 3,
                    'id_periode' => 1,
                    'kriteria_1' => 82,
                    'kriteria_2' => 0,
                    'kriteria_3' => 75,
                    'kriteria_4' => 50,
                    'kriteria_5' => 100,
                    'kriteria_6' => 50,
                    'sudah_diajukan' => 1,
                    ],
        /** 4 */    [
            'id_users' => 2,
                    'id_siswa' => 4,
                    'id_periode' => 1,
                    'kriteria_1' => 78,
                    'kriteria_2' => 20,
                    'kriteria_3' => 75,
                    'kriteria_4' => 75,
                    'kriteria_5' => 100,
                    'kriteria_6' => 50,
                    'sudah_diajukan' => 1,
                    ],
        /** 5 */    [
            'id_users' => 2,
                    'id_siswa' => 5,
                    'id_periode' => 1,
                    'kriteria_1' => 84,
                    'kriteria_2' => 0,
                    'kriteria_3' => 100,
                    'kriteria_4' => 66,
                    'kriteria_5' => 100,
                    'kriteria_6' => 50,
                    'sudah_diajukan' => 1,
                    ],
        /** 6 */    [
            'id_users' => 3,
                    'id_siswa' => 6,
                    'id_periode' => 1,
                    'kriteria_1' => 83,
                    'kriteria_2' => 0,
                    'kriteria_3' => 75,
                    'kriteria_4' => 100,
                    'kriteria_5' => 50,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 7 */    [
            'id_users' => 3,
                    'id_siswa' => 7,
                    'id_periode' => 1,
                    'kriteria_1' => 88,
                    'kriteria_2' => 0,
                    'kriteria_3' => 75,
                    'kriteria_4' => 40,
                    'kriteria_5' => 100,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 8 */    [
            'id_users' => 3,
                    'id_siswa' => 8,
                    'id_periode' => 1,
                    'kriteria_1' => 90,
                    'kriteria_2' => 20,
                    'kriteria_3' => 100,
                    'kriteria_4' => 100,
                    'kriteria_5' => 100,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 9 */    [
            'id_users' => 3,
                    'id_siswa' => 9,
                    'id_periode' => 1,
                    'kriteria_1' => 87,
                    'kriteria_2' => 0,
                    'kriteria_3' => 75,
                    'kriteria_4' => 50,
                    'kriteria_5' => 50,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 10 */    [
            'id_users' => 3,
                    'id_siswa' => 10,
                    'id_periode' => 1,
                    'kriteria_1' => 80,
                    'kriteria_2' => 0,
                    'kriteria_3' => 75,
                    'kriteria_4' => 25,
                    'kriteria_5' => 100,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 11 */   [
            'id_users' => 2,
                    'id_siswa' => 1,
                    'id_periode' => 2,
                    'kriteria_1' => 88,
                    'kriteria_2' => 0,
                    'kriteria_3' => 75,
                    'kriteria_4' => 100,
                    'kriteria_5' => 100,
                    'kriteria_6' => 50,
                    'sudah_diajukan' => 1,
                    ],
        /** 12 */   [
            'id_users' => 2,
                    'id_siswa' => 2,
                    'id_periode' => 2,
                    'kriteria_1' => 80,
                    'kriteria_2' => 20,
                    'kriteria_3' => 100,
                    'kriteria_4' => 50,
                    'kriteria_5' => 100,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 13 */   [
            'id_users' => 2,
                    'id_siswa' => 3,
                    'id_periode' => 2,
                    'kriteria_1' => 83,
                    'kriteria_2' => 40,
                    'kriteria_3' => 75,
                    'kriteria_4' => 50,
                    'kriteria_5' => 100,
                    'kriteria_6' => 50,
                    'sudah_diajukan' => 1,
                    ],
        /** 14 */   [
            'id_users' => 2,
                    'id_siswa' => 4,
                    'id_periode' => 2,
                    'kriteria_1' => 79,
                    'kriteria_2' => 0,
                    'kriteria_3' => 75,
                    'kriteria_4' => 75,
                    'kriteria_5' => 100,
                    'kriteria_6' => 50,
                    'sudah_diajukan' => 1,
                    ],
        /** 15 */   [
            'id_users' => 2,
                    'id_siswa' => 5,
                    'id_periode' => 2,
                    'kriteria_1' => 82,
                    'kriteria_2' => 0,
                    'kriteria_3' => 100,
                    'kriteria_4' => 66,
                    'kriteria_5' => 100,
                    'kriteria_6' => 50,
                    'sudah_diajukan' => 1,
                    ],
        /** 16 */   [
            'id_users' => 3,
                    'id_siswa' => 6,
                    'id_periode' => 2,
                    'kriteria_1' => 90,
                    'kriteria_2' => 0,
                    'kriteria_3' => 75,
                    'kriteria_4' => 100,
                    'kriteria_5' => 50,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 17 */   [
            'id_users' => 3,
                    'id_siswa' => 7,
                    'id_periode' => 2,
                    'kriteria_1' => 84,
                    'kriteria_2' => 40,
                    'kriteria_3' => 75,
                    'kriteria_4' => 40,
                    'kriteria_5' => 100,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 18 */   [
            'id_users' => 3,
                    'id_siswa' => 8,
                    'id_periode' => 2,
                    'kriteria_1' => 81,
                    'kriteria_2' => 0,
                    'kriteria_3' => 100,
                    'kriteria_4' => 100,
                    'kriteria_5' => 100,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 19 */   [
            'id_users' => 3,
                    'id_siswa' => 9,
                    'id_periode' => 2,
                    'kriteria_1' => 84,
                    'kriteria_2' => 0,
                    'kriteria_3' => 75,
                    'kriteria_4' => 50,
                    'kriteria_5' => 50,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 20 */    [
            'id_users' => 3,
                    'id_siswa' => 10,
                    'id_periode' => 2,
                    'kriteria_1' => 86,
                    'kriteria_2' => 0,
                    'kriteria_3' => 75,
                    'kriteria_4' => 25,
                    'kriteria_5' => 100,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 21 */   [
            'id_users' => 2,
                    'id_siswa' => 1,
                    'id_periode' => 3,
                    'kriteria_1' => 88,
                    'kriteria_2' => 20,
                    'kriteria_3' => 75,
                    'kriteria_4' => 100,
                    'kriteria_5' => 100,
                    'kriteria_6' => 50,
                    'sudah_diajukan' => 1,
                    ],
        /** 22 */   [
            'id_users' => 2,
                    'id_siswa' => 2,
                    'id_periode' => 3,
                    'kriteria_1' => 82,
                    'kriteria_2' => 0,
                    'kriteria_3' => 100,
                    'kriteria_4' => 50,
                    'kriteria_5' => 100,
                    'kriteria_6' => 100,
                    'sudah_diajukan' => 1,
                    ],
        /** 23 */   [
            'id_users' => 2,
                    'id_siswa' => 3,
                    'id_periode' => 3,
                    'kriteria_1' => 75,
                    'kriteria_2' => 0,
                    'kriteria_3' => 75,
                    'kriteria_4' => 50,
                    'kriteria_5' => 100,
                    'kriteria_6' => 50,
                    'sudah_diajukan' => 1,
                    ],
        ];

        foreach ($evaluasis as $evaluasi) {
            Evaluasi::create($evaluasi);
        }
    }
}
