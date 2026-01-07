<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use Illuminate\Http\Request;

class KaderController extends Controller
{
    /**
     * Menampilkan daftar semua data kader.
     */
    public function index(Request $request)
    {
        $query = Kader::query();

        // Fitur pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%");
            });
        }

        // Fitur pengurutan
        $sortField = $request->get('sort', 'nama');
        $sortOrder = $request->get('order', 'asc');
        $allowedSorts = ['nama', 'jabatan', 'tanggal_bergabung', 'aktif', 'created_at'];

        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        }

        $kaders = $query->paginate(10)->withQueryString();

        return view('kader.index', compact('kaders'));
    }

    /**
     * Menampilkan form untuk menambah data kader baru.
     */
    public function create()
    {
        return view('kader.create');
    }

    /**
     * Menyimpan data kader baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'jabatan' => 'required|in:Ketua,Sekretaris,Bendahara,Anggota',
            'tanggal_bergabung' => 'nullable|date|before_or_equal:today',
            'aktif' => 'boolean',
        ]);

        // Set status aktif berdasarkan checkbox
        $validated['aktif'] = $request->has('aktif');

        // Simpan ke database
        Kader::create($validated);

        return redirect()->route('kader.index')
            ->with('success', 'Data kader berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail data kader tertentu.
     */
    public function show(Kader $kader)
    {
        // Muat relasi jadwal posyandu
        $kader->load('jadwalPosyandus');
        return view('kader.show', compact('kader'));
    }

    /**
     * Menampilkan form untuk mengedit data kader.
     */
    public function edit(Kader $kader)
    {
        return view('kader.edit', compact('kader'));
    }

    /**
     * Memperbarui data kader di database.
     */
    public function update(Request $request, Kader $kader)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'jabatan' => 'required|in:Ketua,Sekretaris,Bendahara,Anggota',
            'tanggal_bergabung' => 'nullable|date|before_or_equal:today',
            'aktif' => 'boolean',
        ]);

        // Set status aktif berdasarkan checkbox
        $validated['aktif'] = $request->has('aktif');

        // Perbarui data di database
        $kader->update($validated);

        return redirect()->route('kader.index')
            ->with('success', 'Data kader berhasil diperbarui!');
    }

    /**
     * Menghapus data kader dari database.
     */
    public function destroy(Kader $kader)
    {
        // Hapus data dari database
        $kader->delete();

        return redirect()->route('kader.index')
            ->with('success', 'Data kader berhasil dihapus!');
    }
}
