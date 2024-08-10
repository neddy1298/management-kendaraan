<?php

namespace App\Http\Controllers;

use App\Models\MasterAnggaran;
use App\Models\PaguAnggaran;
use Illuminate\Http\Request;

class MasterAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masterAnggarans = MasterAnggaran::with('paguAnggaran')->orderBy('created_at', 'desc')->get();
        return view('masterAnggaran.index', compact('masterAnggarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paguAnggarans = PaguAnggaran::all();
        return view('masterAnggaran.create', compact('paguAnggarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $masterAnggaran = $this->validateMasterAnggaran($request);

        MasterAnggaran::create($masterAnggaran);

        return to_route('masterAnggaran.index')
            ->with('success', 'Anggaran Berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $masterAnggaran = MasterAnggaran::findOrFail($id);
        return view('masterAnggaran.edit', compact('masterAnggaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $masterAnggaran = $this->validateMasterAnggaran($request);

        $masterAnggaranModel = MasterAnggaran::findOrFail($id);
        $masterAnggaranModel->update($masterAnggaran);

        return to_route('masterAnggaran.index')
            ->with('success', 'Anggaran Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $masterAnggaran = MasterAnggaran::findOrFail($id);

        if ($masterAnggaran) {
            $masterAnggaran->delete();
            return to_route('masterAnggaran.index')->with('success', 'Data berhasil dihapus.');
        } else {
            return to_route('masterAnggaran.index')->with('error', 'Data tidak ditemukan.');
        }
    }

    /**
     * Validate Master Anggaran data.
     */
    protected function validateMasterAnggaran(Request $request)
    {
        return $request->validate([
            'pagu_anggaran_id' => 'required|integer',
            'kode_rekening' => 'required|string|max:255',
            'nama_rekening' => 'required|string|max:255',
            'anggaran' => 'required|integer',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);
    }
}
