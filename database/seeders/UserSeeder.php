<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        /** 1 */    ['email' => 'admin@gmail.com', 'password' => '$2y$10$cqQh6zvIG6S37MTdOXVyUObnxZVdVAEuQNNMlVvo.hEU.l5bqhUg2', 'fullname' => 'Admin', 'nama_lembaga' => '', 'alamat_lembaga' => '', 'telp_lembaga' => '', 'role' => 'admin', 'gambar' => 'user.jpeg'],
        /** 2 */    ['email' => 'anisa@gmail.com', 'password' => '$2y$10$cqQh6zvIG6S37MTdOXVyUObnxZVdVAEuQNNMlVvo.hEU.l5bqhUg2', 'fullname' => 'Nur Anisa F', 'nama_lembaga' => 'Sanggar Genius Candi', 'alamat_lembaga' => 'Jalan Raya Malang no.1', 'telp_lembaga' => '081232576336', 'role' => 'user', 'gambar' => '240430033325.jpg'],
        /** 3 */    ['email' => 'aan@gmail.com', 'password' => '$2y$10$cqQh6zvIG6S37MTdOXVyUObnxZVdVAEuQNNMlVvo.hEU.l5bqhUg2', 'fullname' => 'Rasyid Annafi', 'nama_lembaga' => 'Panti Sumberawan', 'alamat_lembaga' => 'Jalan Raya Ki Hajar Dewantara no.1', 'telp_lembaga' => '081232576337', 'role' => 'user', 'gambar' => '240430033407.jpg'],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
