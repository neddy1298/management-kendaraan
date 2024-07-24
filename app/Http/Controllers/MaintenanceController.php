<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Maintenance;
use App\Models\MtGroup;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('maintenance.index', [
            'maintenances' => Maintenance::join('tbl_mt_group', 'tbl_maintenance.mt_group', '=', 'tbl_mt_group.id')
                ->select('tbl_maintenance.nomor_registrasi', 'tbl_mt_group.*')
                ->get(),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        return view('maintenance.show', [
            'maintenance' => $maintenance,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $maintenance = Maintenance::find($id);
        return view('maintenance.edit', compact('maintenance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // TODO: Implement update method
        $request->validate([
            'belanja_bahan_bakar_minyak' => 'required',
            'belanja_pelumas_mesin' => 'required',
            'belanja_suku_cadang' => 'required',

        ], [
            'required' => 'Kolom :attribut wajib diisi.',
            //'integer' => 'Kolom :attribut harus berupa angka.',

        ]);


        $Maintenance = Maintenance::find($id);
        $Maintenance->update($request->all());

        return redirect()->route('maintenance.index')->with('success', 'Data berhasil diperbarui.');
        
    }
}
