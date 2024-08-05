<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $selectedYear = $request->input('year', Carbon::now()->format('Y'));
        $selectedMonth = $request->input('month', 'all');

        $query = Maintenance::with(['kendaraan', 'kendaraan.unitKerja', 'belanja']);

        $belanja_tahun_ini = 0;

        foreach ($query->get() as $maintenance) {
            $belanja_tahun_ini += $maintenance->belanja()
                ->whereYear('tanggal_belanja', $selectedYear)
                ->sum('belanja_bahan_bakar_minyak')
                + $maintenance->belanja()
                ->whereYear('tanggal_belanja', $selectedYear)
                ->sum('belanja_pelumas_mesin')
                + $maintenance->belanja()
                ->whereYear('tanggal_belanja', $selectedYear)
                ->sum('belanja_suku_cadang');
        }

        if ($selectedMonth !== 'all') {
            $query->whereYear('tanggal_maintenance', $selectedYear)
                ->whereMonth('tanggal_maintenance', $selectedMonth);
        } else {
            $query->whereYear('tanggal_maintenance', $selectedYear);
        }

        $maintenances = $query->orderBy('tanggal_maintenance', 'desc')->get();

        $belanja_bulan_ini = 0;
        $isExpire = 0;

        foreach ($maintenances as $maintenance) {
            $belanja_bulan_ini += $maintenance->belanja->sum('belanja_bahan_bakar_minyak')
                + $maintenance->belanja->sum('belanja_pelumas_mesin')
                + $maintenance->belanja->sum('belanja_suku_cadang');

            $isExpire += $maintenance->kendaraan->berlaku_sampai < Carbon::now() ? 1 : 0;
        }

        $years = $this->getAvailableYears();
        $months = [
            'all' => 'Semua Bulan',
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        return view('maintenance.index', compact('maintenances', 'isExpire', 'belanja_bulan_ini', 'belanja_tahun_ini', 'years', 'months', 'selectedYear', 'selectedMonth'));
    }

    private function getAvailableYears()
    {
        $years = Maintenance::selectRaw('YEAR(tanggal_maintenance) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return $years;
    }


    /**
     * Get belanja details for a specific maintenance_id.
     *
     * @param  string  $maintenance_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBelanjaDetails($maintenance_id)
    {
        $belanjas = Belanja::where('maintenance_id', $maintenance_id)->get();

        // dd($maintenance_id);
        return response()->json($belanjas);
    }


    public function exportToExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $maintenances = Maintenance::all();

        // header
        $sheet->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nomor Registrasi')
            ->setCellValue('C1', 'Unit Kerja')
            ->setCellValue('D1', 'Total Belanja')
            ->setCellValue('E1', 'Kadaluarsa Pajak')
            ->setCellValue('F1', 'Bulan');

        // data
        $row = 2;
        foreach ($maintenances as $index => $maintenance) {
            $sheet->setCellValue('A' . $row, $index + 1)
                ->setCellValue('B' . $row, $maintenance->kendaraan->nomor_registrasi)
                ->setCellValue('C' . $row, $maintenance->kendaraan->unitKerja->nama_unit_kerja)
                ->setCellValue('D' . $row, $this->Rupiah($maintenance->totalSemuaBelanja()))
                ->setCellValue('E' . $row, \Carbon\Carbon::parse($maintenance->berlaku_sampai)->translatedFormat('d F Y'))
                ->setCellValue('F' . $row, \Carbon\Carbon::parse($maintenance->tanggal_maintenance)->translatedFormat('F Y'));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Kendaraan ' . date('d-m-Y') . '.xlsx';

        // Mengatur headers untuk unduhan file
        //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        //header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }

    private function Rupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
