<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migrasi untuk membuat tabel lansias.
     */
    public function up(): void
    {
        Schema::create('lansias', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                          // Nama lengkap lansia
            $table->date('tanggal_lahir');                   // Tanggal lahir
            $table->enum('jenis_kelamin', ['L', 'P']);       // Jenis kelamin: L=Laki-laki, P=Perempuan
            $table->text('alamat');                          // Alamat tempat tinggal
            $table->string('no_hp', 20)->nullable();         // Nomor handphone
            $table->text('riwayat_penyakit')->nullable();    // Riwayat penyakit yang pernah diderita
            $table->string('golongan_darah', 5)->nullable(); // Golongan darah: A, B, AB, O
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi dan menghapus tabel lansias.
     */
    public function down(): void
    {
        Schema::dropIfExists('lansias');
    }
};
