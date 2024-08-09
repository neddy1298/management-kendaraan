<?php

namespace App\Http\Controllers;

use App\Models\StokSukuCadang;
use Illuminate\Http\Request;

class StokSukuCadangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stokSukuCadangs = StokSukuCadang::all();
        return view('sukuCadang.index', compact('stokSukuCadangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sukuCadang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_suku_cadang' => 'required',
            'stok' => 'required',
            'harga' => 'required',
        ], [
            'nama_suku_cadang.required' => 'Nama suku cadang harus diisi',
            'stok.required' => 'Stok harus diisi',
            'harga.required' => 'Harga harus diisi',
        ]);

        StokSukuCadang::create($request->all());
        return redirect()->route('sukuCadang.index')->with('success', 'Data suku cadang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(StokSukuCadang $stokSukuCadang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $stokSukuCadang = StokSukuCadang::findOrFail($id);
        return view('sukuCadang.edit', compact('stokSukuCadang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_suku_cadang' => 'required',
            'stok' => 'required',
            'harga' => 'required',
        ], [
            'nama_suku_cadang.required' => 'Nama suku cadang harus diisi',
            'stok.required' => 'Stok harus diisi',
            'harga.required' => 'Harga harus diisi',
        ]);

        $stokSukuCadang = StokSukuCadang::findOrFail($id);
        $stokSukuCadang->update($request->all());
        
        return redirect()->route('sukuCadang.index')->with('success', 'Data suku cadang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StokSukuCadang $stokSukuCadang)
    {
        //
    }
}
