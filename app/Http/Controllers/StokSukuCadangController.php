<?php

namespace App\Http\Controllers;

use App\Models\GroupAnggaran;
use App\Models\StokSukuCadang;
use App\Models\SukuCadang;
use Illuminate\Http\Request;

class StokSukuCadangController extends Controller
{

    public function index()
    {
        $stokSukuCadangs = StokSukuCadang::orderBy('nama_suku_cadang', 'asc')->get();
        return view('sukuCadang.index', compact('stokSukuCadangs'));
    }

    public function create()
    {
        $groupAnggarans = GroupAnggaran::where('tipe_belanja', 'Suku Cadang')->get();
        return view('sukuCadang.create', compact('groupAnggarans'));
    }

    public function store(Request $request)
    {
        $this->validateRequest($request);
        $request['stok_awal'] = $request['stok'];
        StokSukuCadang::create($request->all());
        return redirect()->route('sukuCadang.index')->with('success', 'Data suku cadang berhasil ditambahkan');
    }

    public function edit($id)
    {
        $stokSukuCadang = StokSukuCadang::findOrFail($id);
        return view('sukuCadang.edit', compact('stokSukuCadang'));
    }

    public function update(Request $request, $id)
    {
        $this->validateRequest($request);
        $request['stok_awal'] = $request['stok'];
        $stokSukuCadang = StokSukuCadang::findOrFail($id);
        $stokSukuCadang->update($request->all());

        $sukuCadangs = SukuCadang::all();
        $stokSukuCadangs = StokSukuCadang::orderBy('group_anggaran_id', 'asc')->get();
        foreach ($stokSukuCadangs as $stokSukuCadang) {
            $stokSukuCadang->update([
                'stok' => $stokSukuCadang->stok_awal,
            ]);
        }

        foreach ($sukuCadangs as $sukuCadang) {
            $stokSukuCadang = $stokSukuCadangs->where('id', '=', $sukuCadang->stok_suku_cadang_id)->first();
            $stokSukuCadang->update([
                'stok' => $stokSukuCadang->stok - $sukuCadang->jumlah,
            ]);
        }

        return redirect()->route('sukuCadang.index')->with('success', 'Data suku cadang berhasil diperbarui');
    }

    public function destroy($id)
    {
        StokSukuCadang::destroy($id);
        return redirect()->route('sukuCadang.index')->with('success', 'Data suku cadang berhasil dihapus');
    }

    private function validateRequest(Request $request)
    {
        $request->validate($this->rules(), $this->messages());
    }

    private function rules()
    {
        return [
            'nama_suku_cadang' => 'required',
            'stok' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
        ];
    }

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
