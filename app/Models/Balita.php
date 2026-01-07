<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Balita extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'nama_ortu',
        'alamat',
        'berat_badan',
        'tinggi_badan',
        'nik',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
    ];

    /**
     * Get catatan kesehatan balita
     */
    public function catatanKesehatans()
    {
        return $this->morphMany(CatatanKesehatan::class, 'catatantable');
    }

    /**
     * Hitung usia dalam bulan
     */
    public function getUsiaAttribute(): int
    {
        return Carbon::parse($this->tanggal_lahir)->diffInMonths(Carbon::now());
    }

    /**
     * Get usia formatted
     */
    public function getUsiaFormattedAttribute(): string
    {
        $bulan = $this->usia;
        if ($bulan >= 12) {
            $tahun = floor($bulan / 12);
            $sisaBulan = $bulan % 12;
            return $tahun . ' tahun ' . ($sisaBulan > 0 ? $sisaBulan . ' bulan' : '');
        }
        return $bulan . ' bulan';
    }
}
