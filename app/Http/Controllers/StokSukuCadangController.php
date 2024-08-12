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
        $stokSukuCadangs = StokSukuCadang::orderBy('created_at', 'desc')->get();
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
        $this->validateRequest($request);
        $request['stok_awal'] = $request['stok'];
        StokSukuCadang::create($request->all());
        return redirect()->route('sukuCadang.index')->with('success', 'Data suku cadang berhasil ditambahkan');
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
        $this->validateRequest($request);

        $stokSukuCadang = StokSukuCadang::findOrFail($id);
        $stokSukuCadang->update($request->all());

        return redirect()->route('sukuCadang.index')->with('success', 'Data suku cadang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        StokSukuCadang::destroy($id);
        return redirect()->route('sukuCadang.index')->with('success', 'Data suku cadang berhasil dihapus');
    }

    /**
     * Validate the request.
     */
    private function validateRequest(Request $request)
    {
        $request->validate($this->rules(), $this->messages());
    }

    /**
     * Validation rules.
     */
    private function rules()
    {
        return [
            'nama_suku_cadang' => 'required',
            'stok' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ];
    }

    /**
     * Validation messages.
     */
    private function messages()
    {
        return [
            'nama_suku_cadang.required' => 'Nama suku cadang harus diisi',
            'stok.required' => 'Stok harus diisi',
            'stok.integer' => 'Stok harus berupa angka',
            'stok.min' => 'Stok minimal 1',
            'harga.required' => 'Harga harus diisi',
            'harga.numeric' => 'Harga harus berupa angka',
            'harga.min' => 'Harga minimal 0',
        ];
    }
}
