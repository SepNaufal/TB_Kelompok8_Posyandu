<?php

namespace App\Http\Controllers;

use App\Models\Lansia;
use Illuminate\Http\Request;

class LansiaController extends Controller
{
    /**
     * Menampilkan daftar semua data lansia.
     */
    public function index(Request $request)
    {
        $query = Lansia::query();

        // Fitur pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('riwayat_penyakit', 'like', "%{$search}%");
            });
        }

        // Fitur pengurutan
        $sortField = $request->get('sort', 'nama');
        $sortOrder = $request->get('order', 'asc');
        $allowedSorts = ['nama', 'tanggal_lahir', 'jenis_kelamin', 'created_at'];

        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        }

        $lansias = $query->paginate(10)->withQueryString();

        return view('lansia.index', compact('lansias'));
    }

    /**
     * Menampilkan form untuk menambah data lansia baru.
     */
    public function create()
    {
        return view('lansia.create');
    }

    /**
     * Menyimpan data lansia baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'riwayat_penyakit' => 'nullable|string',
            'golongan_darah' => 'nullable|string|max:5',
        ]);

        // Simpan ke database
        Lansia::create($validated);

        return redirect()->route('lansia.index')
            ->with('success', 'Data lansia berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail data lansia tertentu.
     */
    public function show(Lansia $lansia)
    {
        // Muat relasi catatan kesehatan
        $lansia->load('catatanKesehatans');
        return view('lansia.show', compact('lansia'));
    }

    /**
     * Menampilkan form untuk mengedit data lansia.
     */
    public function edit(Lansia $lansia)
    {
        return view('lansia.edit', compact('lansia'));
    }

    /**
     * Memperbarui data lansia di database.
     */
    public function update(Request $request, Lansia $lansia)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'riwayat_penyakit' => 'nullable|string',
            'golongan_darah' => 'nullable|string|max:5',
        ]);

        // Perbarui data di database
        $lansia->update($validated);

        return redirect()->route('lansia.index')
            ->with('success', 'Data lansia berhasil diperbarui!');
    }

    /**
     * Menghapus data lansia dari database.
     */
    public function destroy(Lansia $lansia)
    {
        // Hapus data dari database
        $lansia->delete();

        return redirect()->route('lansia.index')
            ->with('success', 'Data lansia berhasil dihapus!');
    }
}
