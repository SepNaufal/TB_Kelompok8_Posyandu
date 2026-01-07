<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Balita::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nama_ortu', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        // Sorting functionality
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('balita.create');
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
            'nama_ortu' => 'required|string|max:255',
            'alamat' => 'required|string',
            'berat_badan' => 'nullable|numeric|min:0|max:50',
            'tinggi_badan' => 'nullable|numeric|min:0|max:150',
            'nik' => 'nullable|string|size:16',
        ]);

        Balita::create($validated);

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Balita $balita)
    {
        $balita->load('catatanKesehatans');
        return view('balita.show', compact('balita'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Balita $balita)
    {
        return view('balita.edit', compact('balita'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Balita $balita)
    {
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

        $balita->update($validated);

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Balita $balita)
    {
        $balita->delete();

        return redirect()->route('balita.index')
            ->with('success', 'Data balita berhasil dihapus!');
    }
}
