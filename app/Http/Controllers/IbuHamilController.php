<?php

namespace App\Http\Controllers;

use App\Models\IbuHamil;
use Illuminate\Http\Request;

class IbuHamilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = IbuHamil::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nama_suami', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Sorting functionality
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ibu-hamil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

        IbuHamil::create($validated);

        return redirect()->route('ibu-hamil.index')
            ->with('success', 'Data ibu hamil berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(IbuHamil $ibuHamil)
    {
        $ibuHamil->load('catatanKesehatans');
        return view('ibu-hamil.show', compact('ibuHamil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(IbuHamil $ibuHamil)
    {
        return view('ibu-hamil.edit', compact('ibuHamil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IbuHamil $ibuHamil)
    {
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

        $ibuHamil->update($validated);

        return redirect()->route('ibu-hamil.index')
            ->with('success', 'Data ibu hamil berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IbuHamil $ibuHamil)
    {
        $ibuHamil->delete();

        return redirect()->route('ibu-hamil.index')
            ->with('success', 'Data ibu hamil berhasil dihapus!');
    }
}
