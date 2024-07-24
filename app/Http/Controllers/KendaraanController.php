<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraans = Kendaraan::all();
        // dump($kendaraans);
        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        return view('kendaraan.create');
    }

    public function store(Request $request){
        // TODO: Store data kendaraan
        // $request->validate([
        //     'nik' => 'required',
        //     'nkk' => 'required',
        //     'jenis_permohonan' => 'required',
        //     'keterangan' => 'required',
        // ],[
        //     'required' => 'Kolom :attribute wajib diisi.',
        //     'numeric' => 'Kolom :attribute harus berupa angka.',
        // ]);

        // $data = $request->all();

        // // Ubah format tanggal lahir
        // $tanggal_lahir = Carbon::createFromFormat('d/m/Y', $request->input('tanggal_lahir'))->format('Y-m-d');
        // $data['tanggal_lahir'] = $tanggal_lahir;

        // $permohonanKtp = PermohonanKtp::create($data);

        // if ($permohonanKtp->wasRecentlyCreated) {
        //     return redirect()->route('permohonan.index')->with('success', 'Permohonan KTP berhasil disimpan.');
        // } else {
        //     return redirect()->route('permohonan.index')->with('error', 'Terjadi kesalahan saat menyimpan permohonan KTP.');
        // }
        return redirect()->back();
    }

    public function printAll(){
        return view('kendaraan.printAll');
    }

    public function edit($id){

        $kendaraan = Kendaraan::find($id);

        return view('kendaraan.edit', compact('kendaraan'));
    }

    public function update(Request $request, $id){
        // TODO: Update data kendaraan
        return redirect()->back();
    }

    public function destroy($id){
        // TODO: Delete data kendaraan
        return redirect()->back();
    }
}
