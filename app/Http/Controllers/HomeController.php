<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Kendaraan;
use App\Models\MasterAnggaran;
use App\Models\PaguAnggaran;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // $master_anggaran = ;
        $paguAnggaran = PaguAnggaran::where('tahun', $currentYear)->sum('anggaran');
        $kendaraans = Kendaraan::all();

        $belanja_bulanan = Belanja::whereMonth('tanggal_belanja', $currentMonth)
            ->sum('total_belanja');

        $belanja_tahunan = Belanja::whereYear('tanggal_belanja', $currentYear)
            ->sum('total_belanja');

        $isExpire = $kendaraans->filter(function ($kendaraan) {
            return $kendaraan->berlaku_sampai->isPast();
        })->count();

        $kendaraan = $kendaraans->count();

        $belanjas = Belanja::whereBetween('tanggal_belanja', [$startOfMonth, $endOfMonth])
            ->latest()
            ->get();

        return view('home', compact('kendaraan', 'belanjas', 'paguAnggaran', 'isExpire', 'belanja_bulanan', 'belanja_tahunan'));
    }
}
