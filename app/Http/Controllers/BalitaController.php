<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    /**
     * Menampilkan daftar semua data balita.
     */
    public function index(Request $request)
    {
        $query = Balita::query();

        // Fitur pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nama_ortu', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Fitur pengurutan
        $sortField = $request->get('sort', 'nama');
        $sortOrder = $request->get('order', 'asc');
        $allowedSorts = ['nama', 'tanggal_lahir', 'jenis_kelamin', 'nama_ortu', 'created_at'];

        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        }

        $balitas = $query->paginate(10)->withQueryString();

        return view('balita.index', compact('balitas'));
    }

    /**
     * Menampilkan form untuk menambah data balita baru.
     */
    public function create()
    {
        return view('balita.create');
    }

    /**
     * Menyimpan data balita baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:L,P',
            'nama_ortu' => 'required|string|max:255',
            'alamat' => 'required|string',
            'berat_badan' => 'nullable|numeric|min:0|max:50',
            'tinggi_badan' => 'nullable|numeric|min:0|max:150',
            'nik' => 'nullable|string|size:16',
        ]);

        // Simpan ke database
        Balita::create($validated);

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail data balita tertentu.
     */
    public function show(Balita $balita)
    {
        // Muat relasi catatan kesehatan
        $balita->load('catatanKesehatans');
        return view('balita.show', compact('balita'));
    }

    /**
     * Menampilkan form untuk mengedit data balita.
     */
    public function edit(Balita $balita)
    {
        return view('balita.edit', compact('balita'));
    }

    /**
     * Memperbarui data balita di database.
     */
    public function update(Request $request, Balita $balita)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:L,P',
            'nama_ortu' => 'required|string|max:255',
            'alamat' => 'required|string',
            'berat_badan' => 'nullable|numeric|min:0|max:50',
            'tinggi_badan' => 'nullable|numeric|min:0|max:150',
            'nik' => 'nullable|string|size:16',
        ]);

        // Perbarui data di database
        $balita->update($validated);

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil diperbarui!');
    }

    /**
     * Menghapus data balita dari database.
     */
    public function destroy(Balita $balita)
    {
        // Hapus data dari database
        $balita->delete();

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil dihapus!');
    }
}
