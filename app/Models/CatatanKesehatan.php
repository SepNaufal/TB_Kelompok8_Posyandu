<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanKesehatan extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'tanggal',
        'catatan',
        'tindakan',
        'tekanan_darah_sistol',
        'tekanan_darah_diastol',
        'berat_badan',
        'tinggi_badan',
        'suhu_tubuh',
        'catatantable_type',
        'catatantable_id',
    ];

    /**
     * Konversi tipe data untuk kolom-kolom tertentu.
     */
    protected $casts = [
        'tanggal' => 'date',
        'tekanan_darah_sistol' => 'integer',
        'tekanan_darah_diastol' => 'integer',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'suhu_tubuh' => 'decimal:1',
    ];

    /**
     * Relasi Polimorfik: Catatan kesehatan dimiliki oleh Balita, Ibu Hamil, atau Lansia.
     */
    public function catatantable()
    {
        return $this->morphTo();
    }

    /**
     * Accessor: Mendapatkan tekanan darah dalam format sistol/diastol.
     */
    public function getTekananDarahAttribute()
    {
        if ($this->tekanan_darah_sistol && $this->tekanan_darah_diastol) {
            return "{$this->tekanan_darah_sistol}/{$this->tekanan_darah_diastol} mmHg";
        }
        return null;
    }

    /**
     * Accessor: Mendapatkan label tipe pasien berdasarkan tipe polimorfik.
     */
    public function getTypeLabelAttribute()
    {
        return match ($this->catatantable_type) {
            'App\Models\Balita' => 'Balita',
            'App\Models\IbuHamil' => 'Ibu Hamil',
            'App\Models\Lansia' => 'Lansia',
            default => 'Tidak Diketahui',
        };
    }
}
