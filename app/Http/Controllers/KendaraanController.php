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
