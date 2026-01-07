<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migrasi untuk membuat tabel kaders.
     */
    public function up(): void
    {
        Schema::create('kaders', function (Blueprint $table) {
            $table->id();
            $table->string('nama');                          // Nama lengkap kader
            $table->text('alamat');                          // Alamat tempat tinggal
            $table->string('no_hp', 20);                     // Nomor handphone
            $table->string('jabatan');                       // Jabatan: Ketua, Sekretaris, Bendahara, Anggota
            $table->date('tanggal_bergabung')->nullable();   // Tanggal bergabung sebagai kader
            $table->boolean('aktif')->default(true);         // Status aktif/non-aktif
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi dan menghapus tabel kaders.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaders');
    }
};
