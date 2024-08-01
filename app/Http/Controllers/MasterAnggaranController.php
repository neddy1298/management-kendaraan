<?php

namespace App\Http\Controllers;

use App\Models\MasterAnggaran;
use Illuminate\Http\Request;

class MasterAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $masterAnggarans = MasterAnggaran::all();
        return view('masterAnggaran.index', compact('masterAnggarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('masterAnggaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'kode_rekening' => 'required',
            'nama_rekening' => 'required',
            'anggaran' => 'required',
        ]);

        MasterAnggaran::create($request->all());

        return redirect()->route('masterAnggaran.index')
            ->with('success', 'Anggaran Berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $masterAnggaran = MasterAnggaran::find($id);
        return view('masterAnggaran.edit', compact('masterAnggaran'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_rekening' => 'required',
            'nama_rekening' => 'required',
            'anggaran' => 'required',
        ]);

        $masterAnggaran = MasterAnggaran::find($id);
        $masterAnggaran->update($request->all());

        return redirect()->route('masterAnggaran.index')
            ->with('success', 'Anggaran Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $masterAnggaran = MasterAnggaran::find($id);

        if ($masterAnggaran) {
            $masterAnggaran->delete();
            return redirect()->route('masterAnggaran.index')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->route('masterAnggaran.index')->with('error', 'Data tidak ditemukan.');
        }
    }
}
