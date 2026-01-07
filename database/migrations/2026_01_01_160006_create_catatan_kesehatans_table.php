<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catatan_kesehatans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->text('catatan');
            $table->text('tindakan')->nullable();
            $table->decimal('tekanan_darah_sistol', 5, 1)->nullable();
            $table->decimal('tekanan_darah_diastol', 5, 1)->nullable();
            $table->decimal('berat_badan', 5, 2)->nullable();
            $table->decimal('tinggi_badan', 5, 2)->nullable();
            $table->decimal('suhu_tubuh', 4, 1)->nullable();
            $table->morphs('catatantable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_kesehatans');
    }
};
