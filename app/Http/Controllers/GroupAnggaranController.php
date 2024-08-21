<?php

namespace App\Http\Controllers;

use App\Models\AnggaranPerbulan;
use App\Models\GroupAnggaran;
use App\Models\MasterAnggaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupAnggaranController extends Controller
{

    public function index()
    {
        $groupAnggarans = GroupAnggaran::with('masterAnggaran')->orderBy('created_at', 'desc')->get();
        return view('groupAnggaran.index', compact('groupAnggarans'));
    }

    public function create()
    {
        $masterAnggarans = MasterAnggaran::orderBy('created_at', 'desc')->get();
        return view('groupAnggaran.create', compact('masterAnggarans'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateGroupAnggaran($request);

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

        GroupAnggaran::create(collect($validatedData)->except(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'])->toArray());

        return to_route('groupAnggaran.index')->with('success', 'Group Anggaran berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $groupAnggaran = GroupAnggaran::with('masterAnggaran', 'anggaranPerbulan')->findOrFail($id);
        $masterAnggarans = MasterAnggaran::all();
        return view('groupAnggaran.edit', compact('groupAnggaran', 'masterAnggarans'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $this->validateGroupAnggaran($request);

        $groupAnggaran = GroupAnggaran::findOrFail($id);

        $groupAnggaran->anggaranPerbulan->update([
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

        $groupAnggaran->update(collect($validatedData)->except(['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'])->toArray());

        return to_route('groupAnggaran.index')->with('success', 'Group Anggaran berhasil diubah.');
    }

    public function destroy($id)
    {
        $groupAnggaran = GroupAnggaran::findOrFail($id);

        DB::transaction(function () use ($groupAnggaran) {
            $groupAnggaran->anggaranPerbulan->delete();
            $groupAnggaran->delete();
        });

        return to_route('groupAnggaran.index')->with('success', 'Group Anggaran berhasil dihapus.');
    }

    protected function validateGroupAnggaran(Request $request)
    {
        return $request->validate([
            'nama_group' => 'required|string|max:255',
            'kode_rekening' => 'required|string|max:255',
            'master_anggaran_id' => 'required|integer',
            'anggaran_bahan_bakar_minyak' => 'nullable|integer',
            'anggaran_pelumas_mesin' => 'nullable|integer',
            'anggaran_suku_cadang' => 'nullable|integer',
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
