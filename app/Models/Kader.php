<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'jabatan',
        'tanggal_bergabung',
        'aktif',
    ];

    /**
     * Konversi tipe data untuk kolom-kolom tertentu.
     */
    protected $casts = [
        'tanggal_bergabung' => 'date',
        'aktif' => 'boolean',
    ];

    /**
     * Relasi: Kader memiliki banyak jadwal posyandu.
     */
    public function jadwalPosyandus()
    {
        return $this->hasMany(JadwalPosyandu::class);
    }
}
