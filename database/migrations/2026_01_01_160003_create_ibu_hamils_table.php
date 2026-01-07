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
        Schema::create('ibu_hamils', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_hp', 20)->nullable();
            $table->integer('usia_kehamilan')->nullable()->comment('dalam minggu');
            $table->date('hpl')->nullable()->comment('Hari Perkiraan Lahir');
            $table->string('golongan_darah', 5)->nullable();
            $table->string('nama_suami')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibu_hamils');
    }
};
