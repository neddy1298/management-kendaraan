<?php

namespace App\Http\Controllers;

use App\Models\GroupAnggaran;
use App\Models\MasterAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupAnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupAnggarans = GroupAnggaran::with('masterAnggaran')->orderBy('created_at', 'desc')->get();
        return view('groupAnggaran.index', compact('groupAnggarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $masterAnggarans = MasterAnggaran::orderBy('created_at', 'desc')->get();
        return view('groupAnggaran.create', compact('masterAnggarans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $groupAnggaran = $this->validateGroupAnggaran($request);

        DB::transaction(function () use ($groupAnggaran) {
            GroupAnggaran::create($groupAnggaran);
        });

        return to_route('groupAnggaran.index')->with('success', 'Group Anggaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $groupAnggaran = GroupAnggaran::with('masterAnggaran')->findOrFail($id);
        $masterAnggarans = MasterAnggaran::all();
        return view('groupAnggaran.edit', compact('groupAnggaran', 'masterAnggarans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $groupAnggaran = $this->validateGroupAnggaran($request);

        DB::transaction(function () use ($groupAnggaran, $id) {
            GroupAnggaran::findOrFail($id)->update($groupAnggaran);
        });

        return to_route('groupAnggaran.index')->with('success', 'Group Anggaran berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $groupAnggaran = GroupAnggaran::findOrFail($id);

            if ($groupAnggaran) {
                $groupAnggaran->delete();
            } else {
                throw new \Exception('Data tidak ditemukan.');
            }
        });

        return to_route('groupAnggaran.index')->with('success', 'Group Anggaran berhasil dihapus.');
    }

    /**
     * Validate Group Anggaran data.
     */
    protected function validateGroupAnggaran(Request $request)
    {
        return $request->validate([
            'nama_group' => 'required|string|max:255',
            'kode_rekening' => 'required|string|max:255',
            'master_anggaran_id' => 'required|integer',
            'anggaran_bahan_bakar_minyak' => 'nullable|integer',
            'anggaran_pelumas_mesin' => 'nullable|integer',
            'anggaran_suku_cadang' => 'nullable|integer',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);
    }
}
