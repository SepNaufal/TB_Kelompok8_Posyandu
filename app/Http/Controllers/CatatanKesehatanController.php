<?php

namespace App\Http\Controllers;

use App\Models\CatatanKesehatan;
use App\Models\Balita;
use App\Models\IbuHamil;
use App\Models\Lansia;
use Illuminate\Http\Request;

class CatatanKesehatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = CatatanKesehatan::with('catatantable');

        // Filter by type
        if ($request->has('type') && $request->type != '') {
            $typeMap = [
                'balita' => 'App\Models\Balita',
                'ibu_hamil' => 'App\Models\IbuHamil',
                'lansia' => 'App\Models\Lansia',
            ];
            if (isset($typeMap[$request->type])) {
                $query->where('catatantable_type', $typeMap[$request->type]);
            }
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('catatan', 'like', "%{$search}%")
                    ->orWhere('tindakan', 'like', "%{$search}%");
            });
        }

        // Sorting functionality
        $sortField = $request->get('sort', 'tanggal');
        $sortOrder = $request->get('order', 'desc');
        $allowedSorts = ['tanggal', 'created_at'];

        if (in_array($sortField, $allowedSorts)) {
            $query->orderBy($sortField, $sortOrder === 'desc' ? 'desc' : 'asc');
        }

        $catatans = $query->paginate(10)->withQueryString();

        return view('catatan.index', compact('catatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->get('type', 'balita');
        $id = $request->get('id');

        $subject = null;
        if ($type === 'balita' && $id) {
            $subject = Balita::find($id);
        } elseif ($type === 'ibu_hamil' && $id) {
            $subject = IbuHamil::find($id);
        } elseif ($type === 'lansia' && $id) {
            $subject = Lansia::find($id);
        }

        $balitas = Balita::orderBy('nama')->get();
        $ibuHamils = IbuHamil::orderBy('nama')->get();
        $lansias = Lansia::orderBy('nama')->get();

        return view('catatan.create', compact('type', 'subject', 'balitas', 'ibuHamils', 'lansias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date|before_or_equal:today',
            'catatan' => 'required|string',
            'tindakan' => 'nullable|string',
            'tekanan_darah_sistol' => 'nullable|numeric|min:50|max:250',
            'tekanan_darah_diastol' => 'nullable|numeric|min:30|max:150',
            'berat_badan' => 'nullable|numeric|min:0|max:200',
            'tinggi_badan' => 'nullable|numeric|min:0|max:250',
            'suhu_tubuh' => 'nullable|numeric|min:30|max:45',
            'catatantable_type' => 'required|in:App\Models\Balita,App\Models\IbuHamil,App\Models\Lansia',
            'catatantable_id' => 'required|integer',
        ]);

        // Verify the record exists
        $modelClass = $validated['catatantable_type'];
        $subject = $modelClass::find($validated['catatantable_id']);

        if (!$subject) {
            return back()->withErrors(['catatantable_id' => 'Data tidak ditemukan.']);
        }

        CatatanKesehatan::create($validated);

        return redirect()->route('catatan.index')
            ->with('success', 'Catatan kesehatan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(CatatanKesehatan $catatan)
    {
        $catatan->load('catatantable');
        return view('catatan.show', compact('catatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CatatanKesehatan $catatan)
    {
        $catatan->load('catatantable');

        $balitas = Balita::orderBy('nama')->get();
        $ibuHamils = IbuHamil::orderBy('nama')->get();
        $lansias = Lansia::orderBy('nama')->get();

        return view('catatan.edit', compact('catatan', 'balitas', 'ibuHamils', 'lansias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CatatanKesehatan $catatan)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date|before_or_equal:today',
            'catatan' => 'required|string',
            'tindakan' => 'nullable|string',
            'tekanan_darah_sistol' => 'nullable|numeric|min:50|max:250',
            'tekanan_darah_diastol' => 'nullable|numeric|min:30|max:150',
            'berat_badan' => 'nullable|numeric|min:0|max:200',
            'tinggi_badan' => 'nullable|numeric|min:0|max:250',
            'suhu_tubuh' => 'nullable|numeric|min:30|max:45',
            'catatantable_type' => 'required|in:App\Models\Balita,App\Models\IbuHamil,App\Models\Lansia',
            'catatantable_id' => 'required|integer',
        ]);

        $catatan->update($validated);

        return redirect()->route('catatan.index')
            ->with('success', 'Catatan kesehatan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CatatanKesehatan $catatan)
    {
        $catatan->delete();

        return redirect()->route('catatan.index')
            ->with('success', 'Catatan kesehatan berhasil dihapus!');
    }
}
