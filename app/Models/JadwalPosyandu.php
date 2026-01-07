<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;

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

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get kader penanggung jawab
     */
    public function kader()
    {
        return $this->belongsTo(Kader::class);
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeAttribute(): string
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
