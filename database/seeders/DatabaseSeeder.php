<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(KriteriaSeeder::class);
        $this->call(NilaiKriteriaSeeder::class);
        $this->call(PeriodeSeeder::class);
        $this->call(DataSiswaSeeder::class);
        $this->call(EvaluasiSeeder::class);
    }
}
