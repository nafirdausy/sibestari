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
        Schema::create('evaluasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_users')->constrained('users');
            $table->foreignId('id_siswa')->constrained('datasiswa');
            $table->foreignId('id_periode')->constrained('periode');
            $table->float('kriteria_1')->default(0);
            $table->float('kriteria_2')->default(0);
            $table->float('kriteria_3')->default(0);
            $table->float('kriteria_4')->default(0);
            $table->float('kriteria_5')->default(0);
            $table->float('kriteria_6')->default(0);
            $table->boolean('sudah_diajukan')->default(false);
            $table->float('hasil')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluasi');
    }
};
