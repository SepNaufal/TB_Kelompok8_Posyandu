<?php

namespace App\Http\Controllers;

use App\Models\Kader;
use Illuminate\Http\Request;

class KaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Kader::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('jabatan', 'like', "%{$search}%");
            });
        }

        // Sorting functionality
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kader.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'jabatan' => 'required|in:Ketua,Sekretaris,Bendahara,Anggota',
            'tanggal_bergabung' => 'nullable|date|before_or_equal:today',
            'aktif' => 'boolean',
        ]);

        $validated['aktif'] = $request->has('aktif');

        Kader::create($validated);

        return redirect()->route('kader.index')
            ->with('success', 'Data kader berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kader $kader)
    {
        $kader->load('jadwalPosyandus');
        return view('kader.show', compact('kader'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kader $kader)
    {
        return view('kader.edit', compact('kader'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kader $kader)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'jabatan' => 'required|in:Ketua,Sekretaris,Bendahara,Anggota',
            'tanggal_bergabung' => 'nullable|date|before_or_equal:today',
            'aktif' => 'boolean',
        ]);

        $validated['aktif'] = $request->has('aktif');

        $kader->update($validated);

        return redirect()->route('kader.index')
            ->with('success', 'Data kader berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kader $kader)
    {
        $kader->delete();

        return redirect()->route('kader.index')
            ->with('success', 'Data kader berhasil dihapus!');
    }
}
