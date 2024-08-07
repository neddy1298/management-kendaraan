<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\GroupAnggaran;
use App\Models\MasterAnggaran;
use App\Models\PaguAnggaran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LaporanController extends Controller
{
    public function index()
    {
        $paguAnggarans = PaguAnggaran::select('tahun')->get();
        $months = [
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];
        return view('laporan.index', compact('paguAnggarans', 'months'));
    }

    public function export(Request $request)
    {
        $tahun = $request->input('tahun');
        $bulanStart = $request->input('bulan_start');
        $bulanEnd = $request->input('bulan_end');

        $query = PaguAnggaran::query();

        if ($tahun && $tahun !== 'all') {
            $query->where('tahun', $tahun);
        }

        if ($bulanStart > $bulanEnd) {
            $temp = $bulanStart;
            $bulanStart = $bulanEnd;
            $bulanEnd = $temp;
        }

        $startDate = Carbon::createFromDate($tahun !== 'all' ? $tahun : now()->year, $bulanStart, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($tahun !== 'all' ? $tahun : now()->year, $bulanEnd, 1)->endOfMonth();
        $endDateMinusOneMonth = $endDate->copy()->subMonth()->endOfMonth();

        $paguAnggarans = $query->with(['masterAnggarans.groupAnggarans' => function ($query) use ($startDate, $endDate, $endDateMinusOneMonth) {
            $query->withSum(['belanjas as belanjas_current' => function ($query) use ($endDate) {
                $query->whereMonth('tanggal_belanja', '=', $endDate->month)
                    ->whereYear('tanggal_belanja', '=', $endDate->year);
            }], 'total_belanja')
                ->withSum(['belanjas as belanjas_before' => function ($query) use ($startDate, $endDateMinusOneMonth) {
                    $query->whereBetween('tanggal_belanja', [$startDate, $endDateMinusOneMonth]);
                }], 'total_belanja');
        }])->get();
        return view('laporan.print', compact('paguAnggarans', 'startDate', 'endDate'));
    }
}
