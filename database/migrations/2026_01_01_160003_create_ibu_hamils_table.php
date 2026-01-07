<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migrasi untuk membuat tabel ibu_hamils.
     */
    public function up(): void
    {
        Schema::create('ibu_hamils', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                          // Nama lengkap ibu hamil
            $table->date('tanggal_lahir');                   // Tanggal lahir
            $table->text('alamat');                          // Alamat tempat tinggal
            $table->string('no_hp', 20)->nullable();         // Nomor handphone
            $table->integer('usia_kehamilan')->nullable();   // Usia kehamilan dalam minggu
            $table->date('hpl')->nullable();                 // Hari Perkiraan Lahir
            $table->string('golongan_darah', 5)->nullable(); // Golongan darah: A, B, AB, O
            $table->string('nama_suami')->nullable();        // Nama suami
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi dan menghapus tabel ibu_hamils.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibu_hamils');
    }
};
