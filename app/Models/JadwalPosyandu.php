<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'kegiatan',
        'keterangan',
        'kader_id',
        'status',
    ];

    /**
     * Konversi tipe data untuk kolom-kolom tertentu.
     */
    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Relasi: Jadwal posyandu dimiliki oleh satu kader.
     */
    public function kader()
    {
        return $this->belongsTo(Kader::class);
    }

    /**
     * Accessor: Mendapatkan warna badge berdasarkan status jadwal.
     */
    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'Dijadwalkan' => 'bg-blue-100 text-blue-800',
            'Berlangsung' => 'bg-yellow-100 text-yellow-800',
            'Selesai' => 'bg-green-100 text-green-800',
            'Dibatalkan' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
