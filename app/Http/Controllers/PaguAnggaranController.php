<?php

namespace App\Http\Controllers;

use App\Models\AnggaranPerbulan;
use App\Models\PaguAnggaran;
use Illuminate\Http\Request;

class PaguAnggaranController extends Controller
{
    
    public function index()
    {
        $paguAnggarans = PaguAnggaran::orderBy('created_at', 'desc')->get();

        return view('paguAnggaran.index', compact('paguAnggarans'));
    }
    
    public function create()
    {
        return view('paguAnggaran.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $this->validatePaguAnggaran($request);

        $anggaranPerbulan = AnggaranPerbulan::create([
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

        $validatedData['anggaran_perbulan_id'] = $anggaranPerbulan->id;

        PaguAnggaran::create(collect($validatedData)->except(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'])->toArray());

        return redirect()->route('paguAnggaran.index')
            ->with('success', 'Pagu Anggaran berhasil ditambahkan');
    }
    
    public function edit(string $id)
    {
        $paguAnggaran = PaguAnggaran::with('anggaranPerbulan')->findOrFail($id);

        return view('paguAnggaran.edit', compact('paguAnggaran'));
    }
    
    public function update(Request $request, string $id)
    {
        $validatedData = $this->validatePaguAnggaran($request);

        $paguAnggaran = PaguAnggaran::findOrFail($id);

        $anggaranPerbulan = AnggaranPerbulan::findOrFail($paguAnggaran->anggaran_perbulan_id);

        $anggaranPerbulan->update([
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

        $paguAnggaran->update(collect($validatedData)->except(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'])->toArray());

        return redirect()->route('paguAnggaran.index')
            ->with('success', 'Pagu Anggaran berhasil diperbarui');
    }
    
    public function destroy(string $id)
    {
        $anggaranPerbulan = PaguAnggaran::findOrFail($id)->anggaranPerbulan;
        $anggaranPerbulan->delete();

        $paguAnggaran = PaguAnggaran::findOrFail($id);
        $paguAnggaran->delete();

        return redirect()->route('paguAnggaran.index')
            ->with('success', 'Pagu Anggaran berhasil dihapus');
    }
    
    protected function validatePaguAnggaran(Request $request)
    {
        return $request->validate([
            'kode_rekening' => 'required|string|max:255',
            'nama_rekening' => 'required|string|max:255',
            'anggaran' => 'required|integer',
            'tahun' => 'required|integer',
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
            'string' => 'Kolom :attribute harus berupa teks.',
            'integer' => 'Kolom :attribute harus berupa angka.',
        ]);
    }
}
