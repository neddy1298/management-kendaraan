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

    public function print(Request $request)
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
        return view('laporan.print', compact('paguAnggarans', 'tahun', 'startDate', 'endDate'));
    }



    public function exportToExcel(Request $request)
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

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Judul
        $titles = [
            'A1' => 'PEMERINTAH KOTA BOGOR',
            'A2' => 'KARTU KENDALI KEGIATAN',
            'A3' => 'TAHUN ANGGARAN ' . date('Y'),
            'A5' => 'Sub Unit                : DINAS PERHUBUNGAN KOTA BOGOR',
            'A6' => 'Nama Program    : PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA',
            'A7' => 'Nama Kegiatan    : Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah',
            'A8' => 'Sub Kegiatan        : Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak, dan Perizinan Kendaraan Dinas Operasional atau Lapangan',
            'A9' => 'Nama PPTK           : Firza Firani Rizal, S.Kom, M.Ak.',
            'A10' => 'Bulan                     : ' . date('F Y')
        ];
        foreach ($titles as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Merge Cell Judul
        for ($row = 1; $row <= 10; $row++) {
            $sheet->mergeCells("A$row:N$row");
        }

        // Style JUdul
        $sheet->getStyle('A1:A3')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Tabel Header
        $headers = [
            'A12' => 'No',
            'B12' => 'Kode Rekening',
            'C12' => 'Nama Rekening',
            'D12' => 'Pagu Anggaran Kegiatan (Rp)',
            'D14' => '    UP/GU/TU    ',
            'E14' => '    LS    ',
            'F12' => 'Realisasi Kegiatan (SP2D) (Rp)',
            'F13' => 'S/D Bulan Lalu',
            'F14' => '    UP/GU/TU    ',
            'G14' => '    LS    ',
            'H13' => 'Bulan Ini',
            'H14' => '    UP    ',
            'I14' => '    GU    ',
            'J14' => '    TU    ',
            'K14' => '    LS    ',
            'L13' => 'S/D Bulan Ini',
            'L14' => '    UP/GU/TU    ',
            'M14' => '    LS    ',
            'N12' => 'Sisa Pagu Anggaran (Rp)'
        ];
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Style Tabel
        $styleHeading1 = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'F9F6EE',
                ],
            ],
        ];
        $styleHeading2 = [
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'FFFFA500',
                ],
            ],
        ];

        // Rupiah format
        // $rupiahFormat = [
        //     'numberFormat' => [
        //         'formatCode' => '[$Rp-421] #,##0',
        //     ],
        // ];
        //  $sheet->getStyle('D17:N17' . ($row - 1))->applyFromArray($rupiahFormat);

        // Looping isi tabel
        $row = 17;

        foreach ($paguAnggarans as $index => $paguAnggaran) {
            $sheet->setCellValue("A$row", $index + 1);
            $sheet->setCellValue("B$row", $paguAnggaran->kode_rekening);
            $sheet->setCellValue("C$row", $paguAnggaran->nama_rekening);
            if ($paguAnggaran->anggaran != 0) {
                $sheet->setCellValue("D$row", 'Rp ' . number_format($paguAnggaran->anggaran, 0, ',', '.'));
            }
            $sheet->getStyle("A$row:N$row")->applyFromArray($styleHeading1);
            $row++;

            $sumMasterAnggaran = 0;
            $sumMasterBelanjaBefore = 0;
            $sumMasterBelanjaCurrent = 0;
            $sumMasterBelanjaTotal = 0;

            foreach ($paguAnggaran->masterAnggarans as $masterAnggaran) {
                $sheet->setCellValue("B$row", $masterAnggaran->kode_rekening);
                $sheet->setCellValue("C$row", $masterAnggaran->nama_rekening);
                if ($masterAnggaran->anggaran != 0) {
                    $sheet->setCellValue("D$row", 'Rp ' . number_format($masterAnggaran->anggaran, 0, ',', '.'));
                }
                $sumMasterAnggaran += $masterAnggaran->anggaran;
                $sheet->getStyle("B$row:N$row")->applyFromArray($styleHeading2);

                $sumBelanjaBefore = 0;
                foreach ($masterAnggaran->groupAnggarans as $groupAnggaran) {
                    $sumBelanjaBefore += $groupAnggaran->belanjas_before;
                }
                $sumMasterBelanjaBefore += $sumBelanjaBefore;
                if ($sumBelanjaBefore != 0) {
                    $sheet->setCellValue("F$row", 'Rp ' . number_format($sumBelanjaBefore, 0, ',', '.'));
                }

                $sumBelanjaCurrent = 0;
                foreach ($masterAnggaran->groupAnggarans as $groupAnggaran) {
                    $sumBelanjaCurrent += $groupAnggaran->belanjas_current;
                }
                $sumMasterBelanjaCurrent += $sumBelanjaCurrent;
                if ($sumBelanjaCurrent != 0) {
                    $sheet->setCellValue("I$row", 'Rp ' . number_format($sumBelanjaCurrent, 0, ',', '.'));
                }

                $sumBelanjaTotal = $sumBelanjaBefore + $sumBelanjaCurrent;
                $sumMasterBelanjaTotal += $sumBelanjaTotal;
                if ($sumBelanjaTotal != 0) {
                    $sheet->setCellValue("L$row", 'Rp ' . number_format($sumBelanjaTotal, 0, ',', '.'));
                }
                if ($masterAnggaran->anggaran - $sumBelanjaTotal != 0) {
                    $sheet->setCellValue("N$row", 'Rp ' . number_format($masterAnggaran->anggaran - $sumBelanjaTotal, 0, ',', '.'));
                }
                $row++;

                foreach ($masterAnggaran->groupAnggarans as $groupAnggaran) {
                    $sheet->setCellValue("C$row", $groupAnggaran->nama_group);
                    if ($groupAnggaran->anggaran_total != 0) {
                        $sheet->setCellValue("D$row", 'Rp ' . number_format($groupAnggaran->anggaran_total, 0, ',', '.'));
                    }
                    if ($groupAnggaran->belanjas_before != 0) {
                        $sheet->setCellValue("F$row", 'Rp ' . number_format($groupAnggaran->belanjas_before ?? 0, 0, ',', '.'));
                    }
                    if ($groupAnggaran->belanjas_current != 0) {
                        $sheet->setCellValue("I$row", 'Rp ' . number_format($groupAnggaran->belanjas_current ?? 0, 0, ',', '.'));
                    }
                    if (($groupAnggaran->belanjas_before ?? 0) + ($groupAnggaran->belanjas_current ?? 0) != 0) {
                        $sheet->setCellValue("L$row", 'Rp ' . number_format(($groupAnggaran->belanjas_before ?? 0) + ($groupAnggaran->belanjas_current ?? 0), 0, ',', '.'));
                    }
                    if ($groupAnggaran->anggaran_total - (($groupAnggaran->belanjas_before ?? 0) + ($groupAnggaran->belanjas_current ?? 0)) != 0) {
                        $sheet->setCellValue("N$row", 'Rp ' . number_format($groupAnggaran->anggaran_total - (($groupAnggaran->belanjas_before ?? 0) + ($groupAnggaran->belanjas_current ?? 0)), 0, ',', '.'));
                    }
                    $row++;
                }
            }
        }

        // Merge Cell Tabel Header
        $mergeCells = [
            'A12:A14',
            'B12:B14',
            'C12:C14',
            'D12:E13',
            'F12:M12',
            'F13:G13',
            'H13:K13',
            'L13:M13',
            'N12:N14'
        ];
        foreach ($mergeCells as $mergeCell) {
            $sheet->mergeCells($mergeCell);
        }

        // Autosize
        foreach (range('A', 'N') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        // Style Header Tabel
        $headerStyleArray = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => '000000'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'A0CFEC'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];

        // Style kode rekening
        $sheet->getStyle('A17:B' . $sheet->getHighestRow())->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        $sheet->getStyle('A12:N14')->applyFromArray($headerStyleArray);

        // Border style
        $sheet->getStyle('A15:N' . ($row - 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
        ]);

        // Nama file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Maintenance Kendaraan Dinas Perhubungan Kota Bogor ' . date('d-F-Y') . '.xlsx';

        // Headers untuk unduhan file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();
    }
}
