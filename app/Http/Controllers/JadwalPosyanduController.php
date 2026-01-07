<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use App\Models\Kader;
use Illuminate\Http\Request;

class JadwalPosyanduController extends Controller
{
    /**
     * Menampilkan daftar semua jadwal posyandu.
     */
    public function index(Request $request)
    {
        $query = JadwalPosyandu::with('kader');

        // Fitur pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('lokasi', 'like', "%{$search}%")
                    ->orWhere('kegiatan', 'like', "%{$search}%")
                    ->orWhereHas('kader', function ($q) use ($search) {
                        $q->where('nama', 'like', "%{$search}%");
                    });
            });
        }

        // Filter berdasarkan status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Fitur pengurutan
        $sortField = $request->get('sort', 'tanggal');
        $sortOrder = $request->get('order', 'desc');
        $allowedSorts = ['tanggal', 'waktu_mulai', 'lokasi', 'kegiatan', 'status', 'created_at'];

        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        }

        $jadwals = $query->paginate(10)->withQueryString();

        return view('jadwal.index', compact('jadwals'));
    }

    /**
     * Menampilkan form untuk menambah jadwal baru.
     */
    public function create()
    {
        // Ambil daftar kader yang aktif
        $kaders = Kader::where('aktif', true)->orderBy('nama')->get();
        return view('jadwal.create', compact('kaders'));
    }

    /**
     * Menyimpan jadwal baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'lokasi' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'kader_id' => 'nullable|exists:kaders,id',
            'status' => 'required|in:Dijadwalkan,Berlangsung,Selesai,Dibatalkan',
        ]);

        // Simpan ke database
        JadwalPosyandu::create($validated);

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal posyandu berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail jadwal tertentu.
     */
    public function show(JadwalPosyandu $jadwal)
    {
        // Muat relasi kader
        $jadwal->load('kader');
        return view('jadwal.show', compact('jadwal'));
    }

    /**
     * Menampilkan form untuk mengedit jadwal.
     */
    public function edit(JadwalPosyandu $jadwal)
    {
        // Ambil daftar kader yang aktif
        $kaders = Kader::where('aktif', true)->orderBy('nama')->get();
        return view('jadwal.edit', compact('jadwal', 'kaders'));
    }

    /**
     * Memperbarui jadwal di database.
     */
    public function update(Request $request, JadwalPosyandu $jadwal)
    {
        // Validasi input
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
            'lokasi' => 'required|string|max:255',
            'kegiatan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'kader_id' => 'nullable|exists:kaders,id',
            'status' => 'required|in:Dijadwalkan,Berlangsung,Selesai,Dibatalkan',
        ]);

        // Perbarui data di database
        $jadwal->update($validated);

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal posyandu berhasil diperbarui!');
    }

    /**
     * Menghapus jadwal dari database.
     */
    public function destroy(JadwalPosyandu $jadwal)
    {
        // Hapus data dari database
        $jadwal->delete();

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal posyandu berhasil dihapus!');
    }
}
