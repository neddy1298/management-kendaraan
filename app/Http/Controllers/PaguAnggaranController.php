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
        $paguAnggarans = PaguAnggaran::all();

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
        $paguAnggaran = $request->validate([
            'kode_rekening' => 'required',
            'nama_rekening' => 'required',
            'anggaran' => 'required',
            'tahun' => 'required',
        ], [
            'kode_rekening.required' => 'Kode Rekening wajib diisi',
            'nama_rekening.required' => 'Nama Rekening wajib diisi',
            'anggaran.required' => 'Anggaran wajib diisi',
            'tahun.required' => 'Tahun wajib diisi',
        ]);

        PaguAnggaran::create($paguAnggaran);

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
        $request->validate([
            'kode_rekening' => 'required',
            'nama_rekening' => 'required',
            'anggaran' => 'required',
            'tahun' => 'required',
        ], [
            'kode_rekening.required' => 'Kode Rekening wajib diisi',
            'nama_rekening.required' => 'Nama Rekening wajib diisi',
            'anggaran.required' => 'Anggaran wajib diisi',
            'tahun.required' => 'Tahun wajib diisi',
        ]);

        $paguAnggaran = PaguAnggaran::findOrFail($id);
        $paguAnggaran->update($request->all());

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
}
