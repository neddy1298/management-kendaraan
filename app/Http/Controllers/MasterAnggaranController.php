<?php

namespace App\Http\Controllers;

use App\Models\AnggaranPerbulan;
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
        $validatedData = $this->validateMasterAnggaran($request);

        $angaranPerbulan = AnggaranPerbulan::create([
            'januari' => $validatedData['januari'],
            'februari' => $validatedData['februari'],
            'maret' => $validatedData['maret'],
            'april' => $validatedData['april'],
            'mei' => $validatedData['mei'],
            'juni' => $validatedData['juni'],
            'juli' => $validatedData['juli'],
            'agustus' => $validatedData['agustus'],
            'september' => $validatedData['september'],
            'oktober' => $validatedData['oktober'],
            'november' => $validatedData['november'],
            'desember' => $validatedData['desember'],
        ]);

        $validatedData['anggaran_perbulan_id'] = $angaranPerbulan->id;

        MasterAnggaran::create(collect($validatedData)->except(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'])->toArray());

        return to_route('masterAnggaran.index')
            ->with('success', 'Anggaran Berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $masterAnggaran = MasterAnggaran::with('anggaranPerbulan')->findOrFail($id);
        $paguAnggarans = PaguAnggaran::all();
        return view('masterAnggaran.edit', compact('masterAnggaran', 'paguAnggarans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $this->validateMasterAnggaran($request);

        $masterAnggaran = MasterAnggaran::findOrFail($id);

        $masterAnggaran->anggaranPerbulan->update([
            'januari' => $validatedData['januari'],
            'februari' => $validatedData['februari'],
            'maret' => $validatedData['maret'],
            'april' => $validatedData['april'],
            'mei' => $validatedData['mei'],
            'juni' => $validatedData['juni'],
            'juli' => $validatedData['juli'],
            'agustus' => $validatedData['agustus'],
            'september' => $validatedData['september'],
            'oktober' => $validatedData['oktober'],
            'november' => $validatedData['november'],
            'desember' => $validatedData['desember'],
        ]);

        $masterAnggaran->update(collect($validatedData)->except(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'])->toArray());

        return to_route('masterAnggaran.index')
            ->with('success', 'Anggaran Berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $masterAnggaran = MasterAnggaran::findOrFail($id);
        $anggaranPerbulan = AnggaranPerbulan::findOrFail($masterAnggaran->anggaran_perbulan_id);

        if ($masterAnggaran) {
            $anggaranPerbulan->delete();
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
            'januari' => 'nullable|integer',
            'februari' => 'nullable|integer',
            'maret' => 'nullable|integer',
            'april' => 'nullable|integer',
            'mei' => 'nullable|integer',
            'juni' => 'nullable|integer',
            'juli' => 'nullable|integer',
            'agustus' => 'nullable|integer',
            'september' => 'nullable|integer',
            'oktober' => 'nullable|integer',
            'november' => 'nullable|integer',
            'desember' => 'nullable|integer',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);
    }
}
