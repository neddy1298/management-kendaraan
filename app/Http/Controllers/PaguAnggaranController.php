<?php

namespace App\Http\Controllers;

use App\Models\PaguAnggaran;
use Illuminate\Http\Request;

class PaguAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paguAnggarans = PaguAnggaran::orderBy('created_at', 'desc')->get();

        return view('paguAnggaran.index', compact('paguAnggarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('paguAnggaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $this->validatePaguAnggaran($request);

        PaguAnggaran::create($validatedData);

        return redirect()->route('paguAnggaran.index')
            ->with('success', 'Pagu Anggaran berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paguAnggaran = PaguAnggaran::findOrFail($id);

        return view('paguAnggaran.edit', compact('paguAnggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $this->validatePaguAnggaran($request);

        $paguAnggaran = PaguAnggaran::findOrFail($id);
        $paguAnggaran->update($validatedData);

        return redirect()->route('paguAnggaran.index')
            ->with('success', 'Pagu Anggaran berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paguAnggaran = PaguAnggaran::findOrFail($id);

        $paguAnggaran->delete();

        return redirect()->route('paguAnggaran.index')
            ->with('success', 'Pagu Anggaran berhasil dihapus');
    }

    /**
     * Validate Pagu Anggaran data.
     */
    protected function validatePaguAnggaran(Request $request)
    {
        return $request->validate([
            'kode_rekening' => 'required|string|max:255',
            'nama_rekening' => 'required|string|max:255',
            'anggaran' => 'required|integer',
            'tahun' => 'required|integer',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);
    }
}
