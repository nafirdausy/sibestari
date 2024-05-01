<?php

namespace Database\Seeders;

use App\Models\NilaiKriteria;
use Illuminate\Database\Seeder;

class NilaiKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            /*
            *    Prestasi Non Akademik
            */
            ['id_kriteria' => 2, 'nama_kriteria' => 'Tidak Ada','nilai' => 0],
            ['id_kriteria' => 2, 'nama_kriteria' => 'Sekolah','nilai' => 20],
            ['id_kriteria' => 2, 'nama_kriteria' => 'Kecamatan','nilai' => 40],
            ['id_kriteria' => 2, 'nama_kriteria' => 'Kota/Kabupaten','nilai' => 60],
            ['id_kriteria' => 2, 'nama_kriteria' => 'Provinsi','nilai' => 80],
            ['id_kriteria' => 2, 'nama_kriteria' => 'Nasional','nilai' => 100],

            /**
             * Status Orang Tua
            */
            ['id_kriteria' => 3,  'nama_kriteria' => 'Yatim', 'nilai' => 75],
            ['id_kriteria' => 3,  'nama_kriteria' => 'Yatim Piatu', 'nilai' => 100],

            /**
             * Tingkatan Mengaji
             */
            ['id_kriteria' => 5,  'nama_kriteria' => 'Iqro', 'nilai' => 50],
            ['id_kriteria' => 5, 'nama_kriteria' => 'Al-Quran', 'nilai' => 100],

            /**
             * Tempat Tinggal
             */
            ['id_kriteria' => 6, 'nama_kriteria' => 'Non Pantai', 'nilai' => 50],
            ['id_kriteria' => 6, 'nama_kriteria' => 'Panti', 'nilai' => 100],

            /**
             * Anak ke dari jumlah saudara
             */
            ['id_kriteria' => 4, 'nama_kriteria' => '1 dari 1', 'nilai' => 100],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '1 dari 2', 'nilai' => 50],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '2 dari 2', 'nilai' => 100],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '1 dari 3', 'nilai' => 33],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '2 dari 3', 'nilai' => 66],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '3 dari 3', 'nilai' => 100],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '1 dari 4', 'nilai' => 25],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '2 dari 4', 'nilai' => 50],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '3 dari 4', 'nilai' => 75],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '4 dari 4', 'nilai' => 100],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '1 dari 5', 'nilai' => 20],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '2 dari 5', 'nilai' => 40],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '3 dari 5', 'nilai' => 60],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '4 dari 5', 'nilai' => 80],
            [ 'id_kriteria' => 4, 'nama_kriteria' => '5 dari 5', 'nilai' => 100],
            [ 'id_kriteria' => 4, 'nama_kriteria' => 'Lainnya', 'nilai' => 20],
        ];

        foreach ($datas as $data) {
            NilaiKriteria::create($data);
        }
    }
}
