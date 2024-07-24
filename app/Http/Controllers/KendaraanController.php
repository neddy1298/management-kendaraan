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
        $request->validate([
            'nomor_registrasi' => 'required|string|max:255',
            'merk_kendaraan' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'cc_kendaraan' => 'required|integer',
            'bbm_kendaraan' => 'required|string|max:255',
            'roda_kendaraan' => 'required|integer',
            'berlaku_sampai' => 'required|date_format:d/m/Y',

        ],[
            'required' => 'Kolom :attribut wajib diisi.',
            'integer' => 'Kolom :attribut harus berupa angka.',
            'date_format' => 'Kolom :attribut tidak sesuai format dd/mm/yyyy.',
        ]);

        // $data = $request->all();
        $data = $request->except('_token');

        $Kendaraan = Kendaraan::create($data);

        if ($Kendaraan->wasRecentlyCreated) {
            return redirect()->route('kendaraan.index')->with('success', 'Data berhasil disimpan.');
        } else {
            return redirect()->route('kendaraan.index')->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
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
        $request->validate([
            'nomor_registrasi' => 'required|string|max:255',
            'merk_kendaraan' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'cc_kendaraan' => 'required|integer',
            'bbm_kendaraan' => 'required|string|max:255',
            'roda_kendaraan' => 'required|integer',
            'berlaku_sampai' => 'required|date_format:d/m/Y',
        ], [
            'required' => 'Kolom :attribute wajib diisi.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'date_format' => 'Kolom :attribute tidak sesuai format dd/mm/yyyy.',
        ]);

        $kendaraan = Kendaraan::find($id);
        $kendaraan->update($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil diperbarui.');

        return redirect()->back();
    }

    public function destroy($id){
        // TODO: Delete data kendaraan
        $kendaraan = Kendaraan::find($id);
        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil dihapus.');

        return redirect()->back();
    }
}
