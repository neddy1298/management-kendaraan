<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Maintenance;
use App\Models\MtGroup;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraans = Kendaraan::all();
        return view('kendaraan.index', compact('kendaraans'));
    }

    public function create()
    {
        $mt_groups = MtGroup::all();
        return view('kendaraan.create', compact('mt_groups'));
    }

    public function store(Request $request){
        $request->validate([
            'nomor_registrasi' => 'required|string|max:255',
            'merk_kendaraan' => 'required|string|max:255',
            'jenis_kendaraan' => 'required|string|max:255',
            'cc_kendaraan' => 'required|integer',
            'bbm_kendaraan' => 'required|string|max:255',
            'roda_kendaraan' => 'required|integer',
            'berlaku_sampai' => 'required|date_format:d/m/Y',
            'mt_group' => 'required|integer',

        ],[
            'required' => 'Kolom :attribut wajib diisi.',
            'integer' => 'Kolom :attribut harus berupa angka.',
            'date_format' => 'Kolom :attribut tidak sesuai format dd/mm/yyyy.',
        ]);

        $berlaku_sampai = \DateTime::createFromFormat('d/m/Y', $request->berlaku_sampai)->format('d-m-Y');
        $data_kendaraan = $request->except('mt_group');

        
        $data_kendaraan['berlaku_sampai'] = $berlaku_sampai;
        $kendaraan = Kendaraan::create($data_kendaraan);
        
        $data_maintenance['nomor_registrasi'] = $request->nomor_registrasi;
        $data_maintenance['mt_group'] = $request->mt_group;
        $data_maintenance['_token'] = $request->_token;
        $data_maintenance = Maintenance::create($data_maintenance);

        if ($kendaraan->wasRecentlyCreated) {
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
        $maintenance = Maintenance::join('tbl_mt_group', 'tbl_maintenance.mt_group', '=', 'tbl_mt_group.id')
        ->where('nomor_registrasi', $kendaraan->nomor_registrasi)
        ->select('tbl_maintenance.nomor_registrasi','tbl_mt_group.id', 'tbl_mt_group.nama_group')
        ->first();
    
        $mt_groups = MtGroup::all();

        // dump($maintenance);
    
        return view('kendaraan.edit', compact('kendaraan', 'mt_groups', 'maintenance'));
    }

    public function update(Request $request, $id){
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


        $berlaku_sampai = \DateTime::createFromFormat('d/m/Y', $request->berlaku_sampai)->format('d-m-Y');
        $data = $request->all();

        $data['berlaku_sampai'] = $berlaku_sampai;

        $kendaraan = Kendaraan::find($id);
        $kendaraan->update($request->all());

        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil diperbarui.');

        // return redirect()->back();
    }

    public function destroy($id){

        // TODO: Delete data kendaraan
        $kendaraan = Kendaraan::find($id);

        $kendaraan->delete();

        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil dihapus.');

        return redirect()->back();
    }
}
