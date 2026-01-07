<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migrasi untuk membuat tabel balitas.
     */
    public function up(): void
    {
        Schema::create('balitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                          // Nama lengkap balita
            $table->date('tanggal_lahir');                   // Tanggal lahir
            $table->enum('jenis_kelamin', ['L', 'P']);       // Jenis kelamin: L=Laki-laki, P=Perempuan
            $table->string('nama_ortu');                     // Nama orang tua/wali
            $table->text('alamat');                          // Alamat tempat tinggal
            $table->decimal('berat_badan', 5, 2)->nullable(); // Berat badan dalam kg
            $table->decimal('tinggi_badan', 5, 2)->nullable(); // Tinggi badan dalam cm
            $table->string('nik', 16)->nullable();           // Nomor Induk Kependudukan
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi dan menghapus tabel balitas.
     */
    public function down(): void
    {
        Schema::dropIfExists('balitas');
    }
};
