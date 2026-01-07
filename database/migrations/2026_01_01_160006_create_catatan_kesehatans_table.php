<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Menjalankan migrasi untuk membuat tabel catatan_kesehatans.
     * Tabel ini menggunakan relasi polimorfik untuk mendukung tiga jenis pasien.
     */
    public function up(): void
    {
        Schema::create('catatan_kesehatans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');                         // Tanggal pemeriksaan
            $table->text('catatan');                         // Catatan hasil pemeriksaan
            $table->text('tindakan')->nullable();            // Tindakan yang dilakukan
            $table->integer('tekanan_darah_sistol')->nullable();   // Tekanan darah sistol
            $table->integer('tekanan_darah_diastol')->nullable();  // Tekanan darah diastol
            $table->decimal('berat_badan', 5, 2)->nullable();      // Berat badan dalam kg
            $table->decimal('tinggi_badan', 5, 2)->nullable();     // Tinggi badan dalam cm
            $table->decimal('suhu_tubuh', 4, 1)->nullable();       // Suhu tubuh dalam °C
            $table->string('catatantable_type');             // Tipe model: Balita, IbuHamil, atau Lansia
            $table->unsignedBigInteger('catatantable_id');   // ID dari model terkait
            $table->timestamps();

            // Indeks untuk relasi polimorfik
            $table->index(['catatantable_type', 'catatantable_id']);
        });
    }

    /**
     * Membatalkan migrasi dan menghapus tabel catatan_kesehatans.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_kesehatans');
    }
};
