<?php

namespace App\Http\Controllers;

use App\Models\GroupAnggaran;
use App\Models\MasterAnggaran;
use Illuminate\Http\Request;

class GroupAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupAnggarans = GroupAnggaran::all();
        return view('groupAnggaran.index', compact('groupAnggarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $masterAnggarans = MasterAnggaran::all();
        return view('groupAnggaran.create', compact('masterAnggarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $groupAnggaran = $request->validate([
            'nama_group' => 'required|string|max:255',
            'kode_rekening' => 'required|string|max:255',
            'master_anggaran_id' => 'required|integer',
            'anggaran_bahan_bakar_minyak' => 'required|integer',
            'anggaran_pelumas_mesin' => 'required|integer',
            'anggaran_suku_cadang' => 'required|integer',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);

        GroupAnggaran::create($groupAnggaran);

        return redirect()->route('groupAnggaran.index')->with('success', 'Group Anggaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupAnggaran $groupAnggaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $groupAnggaran = GroupAnggaran::find($id)->with('masterAnggaran')->first();

        $masterAnggarans = MasterAnggaran::all();
        return view('groupAnggaran.edit', compact('groupAnggaran', 'masterAnggarans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $groupAnggaran = $request->validate([
            'nama_group' => 'required|string|max:255',
            'kode_rekening' => 'required|string|max:255',
            'master_anggaran_id' => 'required|integer',
            'anggaran_bahan_bakar_minyak' => 'required|integer',
            'anggaran_pelumas_mesin' => 'required|integer',
            'anggaran_suku_cadang' => 'required|integer',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);

        GroupAnggaran::find($id)->update($groupAnggaran);

        return redirect()->route('groupAnggaran.index')->with('success', 'Group Anggaran berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        GroupAnggaran::find($id)->delete();

        return redirect()->route('groupAnggaran.index')->with('success', 'Group Anggaran berhasil dihapus.');
    }
}
