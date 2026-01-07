<?php

namespace App\Http\Controllers;

use App\Models\Lansia;
use Illuminate\Http\Request;

class LansiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lansia::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('riwayat_penyakit', 'like', "%{$search}%");
            });
        }

        // Sorting functionality
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('lansia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'riwayat_penyakit' => 'nullable|string',
            'golongan_darah' => 'nullable|string|max:5',
        ]);

        Lansia::create($validated);

        return redirect()->route('lansia.index')
            ->with('success', 'Data lansia berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lansia $lansia)
    {
        $lansia->load('catatanKesehatans');
        return view('lansia.show', compact('lansia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lansia $lansia)
    {
        return view('lansia.edit', compact('lansia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lansia $lansia)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date|before_or_equal:today',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat' => 'required|string',
            'no_hp' => 'nullable|string|max:20',
            'riwayat_penyakit' => 'nullable|string',
            'golongan_darah' => 'nullable|string|max:5',
        ]);

        $lansia->update($validated);

        return redirect()->route('lansia.index')
            ->with('success', 'Data lansia berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lansia $lansia)
    {
        $lansia->delete();

        return redirect()->route('lansia.index')
            ->with('success', 'Data lansia berhasil dihapus!');
    }
}
