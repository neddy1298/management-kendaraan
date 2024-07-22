<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;

class HomeController extends Controller
{
    public function index(){

        $kendaraan = Kendaraan::get()->count();

        return view('home', compact('kendaraan'));     
    }
}
