<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use Illuminate\Http\Request;

class IbuHamilController extends Controller
{
    /**
     * Menampilkan daftar semua data ibu hamil.
     */
    public function index(Request $request)
    {
        $query = IbuHamil::query();

        // Fitur pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nama_suami', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Fitur pengurutan
        $sortField = $request->get('sort', 'nama');
        $sortOrder = $request->get('order', 'asc');
        $allowedSorts = ['nama', 'tanggal_lahir', 'usia_kehamilan', 'hpl', 'created_at'];

        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        }

        $ibuHamils = $query->paginate(10)->withQueryString();

        return view('ibu-hamil.index', compact('ibuHamils'));
    }

    /**
     * Menampilkan form untuk menambah data ibu hamil baru.
     */
    public function create()
    {
        return view('ibu-hamil.create');
    }

    /**
     * Menyimpan data ibu hamil baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'usia_kehamilan' => 'nullable|integer|min:1|max:42',
            'hpl' => 'nullable|date|after:today',
            'golongan_darah' => 'nullable|string|max:5',
            'nama_suami' => 'nullable|string|max:255',
        ]);

        // Simpan ke database
        IbuHamil::create($validated);

        return redirect()->route('ibu-hamil.index')
            ->with('success', 'Data ibu hamil berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail data ibu hamil tertentu.
     */
    public function show(IbuHamil $ibuHamil)
    {
        // Muat relasi catatan kesehatan
        $ibuHamil->load('catatanKesehatans');
        return view('ibu-hamil.show', compact('ibuHamil'));
    }

    /**
     * Menampilkan form untuk mengedit data ibu hamil.
     */
    public function edit(IbuHamil $ibuHamil)
    {
        return view('ibu-hamil.edit', compact('ibuHamil'));
    }

    /**
     * Memperbarui data ibu hamil di database.
     */
    public function update(Request $request, IbuHamil $ibuHamil)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'usia_kehamilan' => 'nullable|integer|min:1|max:42',
            'hpl' => 'nullable|date',
            'golongan_darah' => 'nullable|string|max:5',
            'nama_suami' => 'nullable|string|max:255',
        ]);

        // Perbarui data di database
        $ibuHamil->update($validated);

        return redirect()->route('ibu-hamil.index')
            ->with('success', 'Data ibu hamil berhasil diperbarui!');
    }

    /**
     * Menghapus data ibu hamil dari database.
     */
    public function destroy(IbuHamil $ibuHamil)
    {
        // Hapus data dari database
        $ibuHamil->delete();

        return redirect()->route('ibu-hamil.index')
            ->with('success', 'Data ibu hamil berhasil dihapus!');
    }
}
