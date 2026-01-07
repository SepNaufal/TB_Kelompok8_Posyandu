<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\Lansia;
use App\Models\Kader;
use App\Models\JadwalPosyandu;
use App\Models\CatatanKesehatan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display dashboard with statistics.
     */
    public function index()
    {
        $stats = [
            'balita' => Balita::count(),
            'ibu_hamil' => IbuHamil::count(),
            'lansia' => Lansia::count(),
            'kader' => Kader::where('aktif', true)->count(),
            'jadwal_mendatang' => JadwalPosyandu::where('tanggal', '>=', now())
                ->where('status', 'Dijadwalkan')
                ->count(),
            'catatan_bulan_ini' => CatatanKesehatan::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->count(),
        ];

        $jadwalMendatang = JadwalPosyandu::with('kader')
            ->where('tanggal', '>=', now())
            ->where('status', 'Dijadwalkan')
            ->orderBy('tanggal')
            ->limit(5)
            ->get();

        $catatanTerbaru = CatatanKesehatan::with('catatantable')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('stats', 'jadwalMendatang', 'catatanTerbaru'));
    }
}
