<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lansia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'riwayat_penyakit',
        'golongan_darah',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Get catatan kesehatan lansia
     */
    public function catatanKesehatans()
    {
        return $this->morphMany(CatatanKesehatan::class, 'catatantable');
    }

    /**
     * Hitung usia lansia
     */
    public function getUsiaAttribute(): int
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }
}
