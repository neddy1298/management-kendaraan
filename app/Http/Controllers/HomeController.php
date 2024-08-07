<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Kendaraan;
use App\Models\MasterAnggaran;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $master_anggaran = MasterAnggaran::orderBy('created_at', 'desc')->first();
        $kendaraans = Kendaraan::orderBy('created_at', 'desc')->get();
        $belanja_bulanan = Belanja::whereMonth('tanggal_belanja', date('m'))->sum('belanja_bahan_bakar_minyak', 'belanja_pelumas_mesin', 'belanja_suku_cadang');
        $belanja_tahunan = Belanja::whereYear('tanggal_belanja', date('Y'))->sum('belanja_bahan_bakar_minyak', 'belanja_pelumas_mesin', 'belanja_suku_cadang');

        $isExpire = 0;

        foreach ($kendaraans as $kendaraan) {
            if ($kendaraan->berlaku_sampai->isPast()) {
                $isExpire++;
            }
        }
        $kendaraan = $kendaraans->count();
        $belanjas = Belanja::whereBetween('tanggal_belanja', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->orderBy('created_at', 'desc')->get();

        return view('home', compact('kendaraan', 'belanjas', 'master_anggaran', 'isExpire', 'belanja_bulanan', 'belanja_tahunan'));
    }
}
