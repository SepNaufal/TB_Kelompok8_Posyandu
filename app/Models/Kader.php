<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kader extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'jabatan',
        'tanggal_bergabung',
        'aktif',
    ];

    protected $casts = [
        'tanggal_bergabung' => 'date',
        'aktif' => 'boolean',
    ];

    /**
     * Get jadwal posyandu yang ditangani oleh kader
     */
    public function jadwalPosyandus()
    {
        return $this->hasMany(JadwalPosyandu::class);
    }
}
