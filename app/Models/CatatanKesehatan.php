<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanKesehatan extends Model
{
    use HasFactory;

    protected $table = 'catatan_kesehatans';

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

    protected $casts = [
        'tanggal' => 'date',
        'tekanan_darah_sistol' => 'decimal:1',
        'tekanan_darah_diastol' => 'decimal:1',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'suhu_tubuh' => 'decimal:1',
    ];

    /**
     * Get the parent catatantable model (Balita, IbuHamil, or Lansia)
     */
    public function catatantable()
    {
        return $this->morphTo();
    }

    /**
     * Get tekanan darah formatted
     */
    public function getTekananDarahAttribute(): string
    {
        if ($this->tekanan_darah_sistol && $this->tekanan_darah_diastol) {
            return $this->tekanan_darah_sistol . '/' . $this->tekanan_darah_diastol . ' mmHg';
        }
        return '-';
    }

    /**
     * Get type label
     */
    public function getTypeLabelAttribute(): string
    {
        return match ($this->catatantable_type) {
            'App\Models\Balita' => 'Balita',
            'App\Models\IbuHamil' => 'Ibu Hamil',
            'App\Models\Lansia' => 'Lansia',
            default => 'Unknown',
        };
    }
}
