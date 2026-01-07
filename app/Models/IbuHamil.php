<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class IbuHamil extends Model
{
    use HasFactory;

    protected $table = 'ibu_hamils';

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'usia_kehamilan',
        'hpl',
        'golongan_darah',
        'nama_suami',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'hpl' => 'date',
    ];

    /**
     * Get catatan kesehatan ibu hamil
     */
    public function catatanKesehatans()
    {
        return $this->morphMany(CatatanKesehatan::class, 'catatantable');
    }

    /**
     * Hitung usia ibu
     */
    public function getUsiaAttribute(): int
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    /**
     * Trimester kehamilan
     */
    public function getTrimesterAttribute(): string
    {
        if ($this->usia_kehamilan <= 12) {
            return 'Trimester 1';
        } elseif ($this->usia_kehamilan <= 27) {
            return 'Trimester 2';
        }
        return 'Trimester 3';
    }
}
