<?php

namespace App\Http\Controllers;

use App\Models\JadwalPosyandu;
use App\Models\Kader;
use Illuminate\Http\Request;

class JadwalPosyanduController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = JadwalPosyandu::with('kader');

        // Search functionality
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

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Sorting functionality
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kaders = Kader::where('aktif', true)->orderBy('nama')->get();
        return view('jadwal.create', compact('kaders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        JadwalPosyandu::create($validated);

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal posyandu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JadwalPosyandu $jadwal)
    {
        $jadwal->load('kader');
        return view('jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalPosyandu $jadwal)
    {
        $kaders = Kader::where('aktif', true)->orderBy('nama')->get();
        return view('jadwal.edit', compact('jadwal', 'kaders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JadwalPosyandu $jadwal)
    {
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

        $jadwal->update($validated);

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal posyandu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JadwalPosyandu $jadwal)
    {
        $jadwal->delete();

        return redirect()->route('jadwal.index')
            ->with('success', 'Jadwal posyandu berhasil dihapus!');
    }
}
