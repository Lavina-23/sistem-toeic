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
        Schema::create('peserta', function (Blueprint $table) {
            $table->id('peserta_id');
            $table->unsignedBigInteger('pengguna_id')->index();
            $table->string('nama');
            $table->string('no_induk', 50)->unique();
            $table->string('nik');
            $table->string('no_telp');
            $table->text('alamat_asal');
            $table->text('alamat_sekarang');
            $table->string('jurusan');
            $table->string('program_studi');
            $table->enum('kampus', ['Utama', 'PSDKU Kediri', 'PSDKU Lumajang', 'PSDKU Pamekasan']);
            $table->string('ktp');
            $table->string('ktm');
            $table->string('foto');
            $table->timestamps();

            $table->foreign('pengguna_id')->references('pengguna_id')->on('pengguna');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta');
    }
};
