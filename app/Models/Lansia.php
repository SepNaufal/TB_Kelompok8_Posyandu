<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lansia extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'no_hp',
        'riwayat_penyakit',
        'golongan_darah',
    ];

    /**
     * Konversi tipe data untuk kolom-kolom tertentu.
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    /**
     * Relasi: Lansia memiliki banyak catatan kesehatan (polimorfik).
     */
    public function catatanKesehatans()
    {
        return $this->morphMany(CatatanKesehatan::class, 'catatantable');
    }

    /**
     * Accessor: Menghitung usia lansia dalam tahun.
     */
    public function getUsiaAttribute()
    {
        return $this->tanggal_lahir->diffInYears(Carbon::now());
    }
}
