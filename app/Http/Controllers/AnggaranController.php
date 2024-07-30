<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\MasterAnggaran;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    public function create()
    {
        if(MasterAnggaran::count() > 0){
            return redirect()->route('anggaran.edit');
        }
        return view('anggaran.create');
    }

    public function store(Request $request)
    {
        if(MasterAnggaran::count() > 0){
            return redirect()->route('anggaran.edit');
        }
        $request->validate([
            'kode_rekening' => 'required',
            'nama_rekening' => 'required',
            'anggaran' => 'required',
        ]);

        MasterAnggaran::create($request->all());

        return redirect()->route('home')
            ->with('success', 'Anggaran Berhasil dibuat.');
    }

    public function edit()
    {
        $anggaran = MasterAnggaran::all()->first();
        return view('anggaran.edit', compact('anggaran'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'kode_rekening' => 'required',
            'nama_rekening' => 'required',
            'anggaran' => 'required',
        ]);
        
        $anggaran = MasterAnggaran::find($id);
        $anggaran->update($request->all());

        return redirect()->route('home')
            ->with('success', 'Anggaran Berhasil dibuat.');
    }
}
