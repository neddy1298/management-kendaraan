<?php

namespace App\Http\Controllers;

use App\Models\KepalaKeluarga;
use App\Models\Penduduk;
use App\Models\PermohonanKtp;
use Illuminate\Http\Request;

class KepalaKeluargaController extends Controller
{
    public function index()
    {
        $kepala_keluargas = KepalaKeluarga::all();
        return view('kepala_keluarga.index', compact('kepala_keluargas'));
    }

    public function create()
    {
        return view('kepala_keluarga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nkk' => 'required|unique:tbl_kepala_keluarga,nkk',
            'nama_kepala_keluarga' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'alamat' => 'required',
        ], 
        [
            'required' => 'Kolom :attribute wajib diisi.',
            'unique' => 'Nomor Kartu Keluarga sudah terdaftar.'
        ]);

        KepalaKeluarga::create($request->all());

        return redirect()->route('kepala_keluarga.index')
            ->with('success', 'Data Kepala Keluarga berhasil ditambahkan');
    }

    public function edit($nkk)
    {
        $kepala_keluarga = KepalaKeluarga::findOrFail($nkk);
        return view('kepala_keluarga.edit', compact('kepala_keluarga'));
    }

    public function update(Request $request, $nkk)
    {
        $request->validate([
            'nama_kepala_keluarga' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'alamat' => 'required',
        ],
        [
            'required' => 'Kolom :attribute wajib diisi.',
        ]);

        $kepala_keluarga = KepalaKeluarga::findOrFail($nkk);
        $kepala_keluarga->update($request->all());

        return redirect()->route('kepala_keluarga.index')
            ->with('success', 'Data Kepala Keluarga berhasil diperbarui');
    }

    public function destroy($nkk)
    {
        $penduduk = Penduduk::where('nkk', $nkk)->get();
        if ($penduduk->isEmpty()) {
            KepalaKeluarga::destroy($nkk);
            return redirect()->route('kepala_keluarga.index')
            ->with('success', 'Data Kepala Keluarga berhasil dihapus');
        } else {
            return redirect()->route('kepala_keluarga.index')
            ->with('error', 'Data Kepala Keluarga tidak dapat dihapus karena terkait dengan data penduduk');
        }
    }

    public function printAll()
    {
        $datas = KepalaKeluarga::all();
        return view('kepala_keluarga.printAll', compact('datas'));
    }

    public function print($nkk)
    {
        $data = KepalaKeluarga::findOrFail($nkk);
        return view('kepala_keluarga.print', compact('data'));
    }
}
