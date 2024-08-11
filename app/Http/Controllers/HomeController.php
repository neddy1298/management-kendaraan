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
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        $master_anggaran = MasterAnggaran::latest()->first();
        $kendaraans = Kendaraan::all();

        $belanja_bulanan = Belanja::whereMonth('tanggal_belanja', $currentMonth)
            ->sum('belanja_bahan_bakar_minyak', 'belanja_pelumas_mesin', 'belanja_suku_cadang');

        $belanja_tahunan = Belanja::whereYear('tanggal_belanja', $currentYear)
            ->sum('belanja_bahan_bakar_minyak', 'belanja_pelumas_mesin', 'belanja_suku_cadang');

        $isExpire = $kendaraans->filter(function ($kendaraan) {
            return $kendaraan->berlaku_sampai->isPast();
        })->count();

        $kendaraan = $kendaraans->count();

        $belanjas = Belanja::whereBetween('tanggal_belanja', [$startOfMonth, $endOfMonth])
            ->latest()
            ->get();

        return view('home', compact('kendaraan', 'belanjas', 'master_anggaran', 'isExpire', 'belanja_bulanan', 'belanja_tahunan'));
    }
}
