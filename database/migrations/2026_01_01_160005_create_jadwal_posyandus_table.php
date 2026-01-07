<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migrasi untuk membuat tabel jadwal_posyandus.
     */
    public function up(): void
    {
        Schema::create('jadwal_posyandus', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');                         // Tanggal pelaksanaan
            $table->time('waktu_mulai');                     // Waktu mulai kegiatan
            $table->time('waktu_selesai');                   // Waktu selesai kegiatan
            $table->string('lokasi');                        // Lokasi pelaksanaan
            $table->string('kegiatan');                      // Jenis kegiatan yang dilakukan
            $table->text('keterangan')->nullable();          // Keterangan tambahan
            $table->foreignId('kader_id')->nullable()        // ID kader penanggung jawab
                ->constrained('kaders')
                ->nullOnDelete();
            $table->string('status')->default('Dijadwalkan'); // Status: Dijadwalkan, Berlangsung, Selesai, Dibatalkan
            $table->timestamps();
        });
    }

    /**
     * Membatalkan migrasi dan menghapus tabel jadwal_posyandus.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_posyandus');
    }
};
