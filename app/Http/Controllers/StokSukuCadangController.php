<?php

namespace App\Http\Controllers;

use App\Models\GroupAnggaran;
use App\Models\StokSukuCadang;
use App\Models\SukuCadang;
use Illuminate\Http\Request;

class StokSukuCadangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $sukuCadangs = SukuCadang::all();
        $stokSukuCadangs = StokSukuCadang::orderBy('group_anggaran_id', 'asc')->get();
        // foreach ($stokSukuCadangs as $stokSukuCadang) {
        //     $stokSukuCadang->update([
        //         'stok' => $stokSukuCadang->stok_awal,
        //     ]);
        // }

        // foreach ($sukuCadangs as $sukuCadang) {
        //     $stokSukuCadang = $stokSukuCadangs->where('id', '=', $sukuCadang->stok_suku_cadang_id)->first();
        //     $stokSukuCadang->update([
        //         'stok' => $stokSukuCadang->stok - $sukuCadang->jumlah,
        //     ]);
        // }
        
        // -- Step 1: Add the column as nullable
        // ALTER TABLE `suku_cadangs` ADD `tanggal_belanja` DATE NULL AFTER `total_harga`;

        // -- Step 2: Update the new column with data from belanjas table
        // UPDATE suku_cadangs sc
        // INNER JOIN belanjas b ON sc.belanja_id = b.id
        // SET sc.tanggal_belanja = b.tanggal_belanja;

        // -- Step 3: Handle any remaining NULL values (if necessary)
        // UPDATE suku_cadangs
        // SET tanggal_belanja = '1970-01-01'
        // WHERE tanggal_belanja IS NULL;

        // -- Step 4: Alter the column to NOT NULL (if required)
        // ALTER TABLE `suku_cadangs` MODIFY `tanggal_belanja` DATE NOT NULL;

        return view('sukuCadang.index', compact('stokSukuCadangs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groupAnggarans = GroupAnggaran::where('tipe_belanja', 'Suku Cadang')->get();
        return view('sukuCadang.create', compact('groupAnggarans'));
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
