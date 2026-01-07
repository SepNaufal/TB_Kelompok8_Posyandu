<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Balita extends Model
{
    use HasFactory;

    /**
     * Kolom-kolom yang dapat diisi secara massal.
     */
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

    /**
     * Konversi tipe data untuk kolom-kolom tertentu.
     */
    protected $casts = [
        'tanggal_lahir' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
    ];

    /**
     * Relasi: Balita memiliki banyak catatan kesehatan (polimorfik).
     */
    public function catatanKesehatans()
    {
        return $this->morphMany(CatatanKesehatan::class, 'catatantable');
    }

    /**
     * Accessor: Menghitung usia balita dalam bulan.
     */
    public function getUsiaAttribute()
    {
        return $this->tanggal_lahir->diffInMonths(Carbon::now());
    }

    /**
     * Accessor: Mendapatkan usia dalam format tahun dan bulan.
     */
    public function getUsiaLengkapAttribute()
    {
        $tahun = $this->tanggal_lahir->diffInYears(Carbon::now());
        $bulan = $this->tanggal_lahir->diffInMonths(Carbon::now()) % 12;

        if ($tahun > 0) {
            return "{$tahun} tahun {$bulan} bulan";
        }
        return "{$bulan} bulan";
    }
}
