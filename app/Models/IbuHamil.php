<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class IbuHamil extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     */
    protected $table = 'ibu_hamils';

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     */
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

    /**
     * Konversi tipe data untuk kolom-kolom tertentu.
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'hpl' => 'date',
        'usia_kehamilan' => 'integer',
    ];

    /**
     * Relasi: Ibu hamil memiliki banyak catatan kesehatan (polimorfik).
     */
    public function catatanKesehatans()
    {
        return $this->morphMany(CatatanKesehatan::class, 'catatantable');
    }

    /**
     * Accessor: Menghitung usia ibu dalam tahun.
     */
    public function getUsiaAttribute()
    {
        return $this->tanggal_lahir->diffInYears(Carbon::now());
    }

    /**
     * Accessor: Mendapatkan trimester kehamilan berdasarkan usia kehamilan.
     */
    public function getTrimesterAttribute()
    {
        if (!$this->usia_kehamilan)
            return 'Belum diketahui';

        if ($this->usia_kehamilan <= 12)
            return 'Trimester 1';
        if ($this->usia_kehamilan <= 27)
            return 'Trimester 2';
        return 'Trimester 3';
    }
}
