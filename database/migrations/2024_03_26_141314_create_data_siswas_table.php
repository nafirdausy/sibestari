<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->enum('jenis_kelamin', ['laki-Laki', 'perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('hobi');
            $table->string('penyakit')->nullable();
            $table->string('norek')->nullable();
            $table->string('nisn')->unique();
            $table->string('sekolah');
            $table->enum('jenjang', ['SD', 'SMP', 'SMA']);
            $table->enum('kelas', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12']);
            $table->string('alamat');
            $table->string('presdes')->nullable();
            $table->enum('tpq', ['ya', 'tidak']);
            $table->string('tempat_tpq')->nullable();
            $table->string('jilid');
            $table->enum('sholat', ['rutin', 'tidak']);
            $table->enum('bimbel', ['ikut', 'tidak-ikut']);
            $table->string('tempat_bimbel')->nullable();
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->enum('pekerjaan', ['guru', 'pns', 'pegawai', 'art', 'penjahit', 'usaha', 'irt','lainnya']);
            $table->string('alamat_ortu');
            $table->string('telp')->nullable();
            $table->string('nama_wali')->nullable();
            $table->enum('pekerjaan_wali', ['','guru', 'pns', 'pegawai', 'art', 'penjahit', 'usaha', 'irt','lainnya'])->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('hubungan')->nullable();
            $table->string('telp_wali')->nullable();
            $table->string('raport');
            $table->string('surat_kematian');
            $table->string('kk');
            $table->string('ktp');
            $table->string('sktm');
            $table->string('foto');
            $table->float('kriteria_1')->default(0);
            $table->float('kriteria_2')->default(0);
            $table->float('kriteria_3')->default(0);
            $table->float('kriteria_4')->default(0);
            $table->float('kriteria_5')->default(0);
            $table->float('kriteria_6')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datasiswa');
    }
};
