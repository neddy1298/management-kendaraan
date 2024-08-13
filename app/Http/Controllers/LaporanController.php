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

        $paguAnggarans = $query->with(['masterAnggarans.groupAnggarans.belanjas', 'masterAnggarans.groupAnggarans' => function ($query) use ($startDate, $endDate, $endDateMinusOneMonth) {
            $query->withSum(['belanjas as belanjas_current' => function ($query) use ($endDate) {
                $query->whereMonth('tanggal_belanja', '=', $endDate->month)
                    ->whereYear('tanggal_belanja', '=', $endDate->year);
            }], 'total_belanja')
                ->withSum(['belanjas as belanjas_before' => function ($query) use ($startDate, $endDateMinusOneMonth) {
                    $query->whereBetween('tanggal_belanja', [$startDate, $endDateMinusOneMonth]);
                }], 'total_belanja');
        }])->get();

        // $belanjas = Belanja::whereBetween('tanggal_belanja', [$startDate, $endDate])->get();
        if ($request->input('jenis_laporan') == 1) {
            return view('laporan.print', compact('paguAnggarans', 'tahun', 'startDate', 'endDate'));
        } else {
            $monthlyBelanja = [];
            for ($month = 1; $month <= 12; $month++) {
                $monthStart = Carbon::createFromDate($tahun, $month, 1)->startOfMonth();
                $monthEnd = $monthStart->copy()->endOfMonth();

                $monthlySum = $paguAnggarans->flatMap(function ($paguAnggaran) {
                    return $paguAnggaran->masterAnggarans->flatMap(function ($masterAnggaran) {
                        return $masterAnggaran->groupAnggarans->flatMap(function ($groupAnggaran) {
                            return $groupAnggaran->belanjas;
                        });
                    });
                })
                    ->whereBetween('tanggal_belanja', [$monthStart, $monthEnd])
                    ->sum('total_belanja');

                $monthlyBelanja[$month] = number_format($monthlySum, 0, ',', '.');
            }
            // dd($monthlyBelanja);
            return view('laporan.print2', compact('paguAnggarans', 'tahun', 'startDate', 'endDate'));
        }
    }

    public function print2(Request $request)
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

        $paguAnggarans = $query->with(['anggaranPerbulan', 'masterAnggarans.groupAnggarans' => function ($query) use ($startDate, $endDate, $endDateMinusOneMonth) {
            $query->withSum(['belanjas as belanjas_current' => function ($query) use ($endDate) {
                $query->whereMonth('tanggal_belanja', '=', $endDate->month)
                    ->whereYear('tanggal_belanja', '=', $endDate->year);
            }], 'total_belanja')
                ->withSum(['belanjas as belanjas_before' => function ($query) use ($startDate, $endDateMinusOneMonth) {
                    $query->whereBetween('tanggal_belanja', [$startDate, $endDateMinusOneMonth]);
                }], 'total_belanja');
        }])->get();

        return view('laporan.print2', compact('paguAnggarans', 'tahun', 'startDate', 'endDate'));
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
            'A10' => 'Bulan                     : ' . $endDate->translatedformat('F Y')
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
            'D14' => '  UP/GU/TU  ',
            'E14' => '  LS  ',
            'F12' => 'Realisasi Kegiatan (SP2D) (Rp)',
            'F13' => 'S/D Bulan Lalu',
            'F14' => '  UP/GU/TU  ',
            'G14' => '  LS  ',
            'H13' => 'Bulan Ini',
            'H14' => '  UP  ',
            'I14' => '  GU  ',
            'J14' => '  TU  ',
            'K14' => '  LS  ',
            'L13' => 'S/D Bulan Ini',
            'L14' => '  UP/GU/TU  ',
            'M14' => '  LS  ',
            'N12' => 'Sisa Pagu Anggaran (Rp)'
        ];
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Style Tabel
        $styleHeading1 = [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => '64B5F6',
                ],
            ],
        ];
        $styleHeading2 = [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'B7CEEC',
                ],
            ],
        ];
        $styleJumlah = [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => 'A5D6A7',
                ],
            ],
        ];

        // Rupiah format
        $rupiahFormat = [
            'numberFormat' => [
                'formatCode' => '[$Rp-421] #,##0',
            ],
        ];
        $sheet->getStyle('D17:N17' . ($row - 1))->applyFromArray($rupiahFormat);

        // Looping isi tabel
        $row = 17;

        // Heading 1
        foreach ($paguAnggarans as $index => $paguAnggaran) {
            $sheet->setCellValue("A$row", $index + 1);
            $sheet->setCellValue("B$row", $paguAnggaran->kode_rekening);
            $sheet->setCellValue("C$row", $paguAnggaran->nama_rekening);
            if ($paguAnggaran->anggaran != 0) {
                $sheet->setCellValue("D$row", $paguAnggaran->anggaran);
                $sheet->getStyle("D$row")->applyFromArray($rupiahFormat);
            }
            $sheet->getStyle("A$row:N$row")->applyFromArray($styleHeading1);


            $sumMasterAnggaran = 0;
            $sumMasterBelanjaBefore = 0;
            $sumMasterBelanjaCurrent = 0;
            $sumMasterBelanjaTotal = 0;

            // Heading 2
            foreach ($paguAnggaran->masterAnggarans as $masterAnggaran) {
                $row++;
                $sheet->setCellValue("B$row", $masterAnggaran->kode_rekening);
                $sheet->setCellValue("C$row", $masterAnggaran->nama_rekening);
                if ($masterAnggaran->anggaran != 0) {
                    $sheet->setCellValue("D$row", $masterAnggaran->anggaran);
                    $sheet->getStyle("D$row")->applyFromArray($rupiahFormat);
                }
                $sumMasterAnggaran += $masterAnggaran->anggaran;
                $sheet->getStyle("B$row:N$row")->applyFromArray($styleHeading2);


                $sumBelanjaBefore = 0;
                foreach ($masterAnggaran->groupAnggarans as $groupAnggaran) {
                    $sumBelanjaBefore += $groupAnggaran->belanjas_before;
                }
                $sumMasterBelanjaBefore += $sumBelanjaBefore;
                if ($sumBelanjaBefore != 0) {
                    $sheet->setCellValue("F$row", $sumBelanjaBefore);
                    $sheet->getStyle("F$row")->applyFromArray($rupiahFormat);
                }


                $sumBelanjaCurrent = 0;
                foreach ($masterAnggaran->groupAnggarans as $groupAnggaran) {
                    $sumBelanjaCurrent += $groupAnggaran->belanjas_current;
                }
                $sumMasterBelanjaCurrent += $sumBelanjaCurrent;
                if ($sumBelanjaCurrent != 0) {
                    $sheet->setCellValue("I$row", $sumBelanjaCurrent);
                    $sheet->getStyle("I$row")->applyFromArray($rupiahFormat);
                }


                $sumBelanjaTotal = $sumBelanjaBefore + $sumBelanjaCurrent;
                $sumMasterBelanjaTotal += $sumBelanjaTotal;
                if ($sumBelanjaTotal != 0) {
                    $sheet->setCellValue("L$row", $sumBelanjaTotal);
                    $sheet->getStyle("L$row")->applyFromArray($rupiahFormat);
                }
                if ($masterAnggaran->anggaran - $sumBelanjaTotal != 0) {
                    $sheet->setCellValue("N$row", $masterAnggaran->anggaran - $sumBelanjaTotal);
                    $sheet->getStyle("N$row")->applyFromArray($rupiahFormat);
                }
                $row++;

                // Heading 3
                foreach ($masterAnggaran->groupAnggarans as $groupAnggaran) {
                    $sheet->setCellValue("C$row", $groupAnggaran->nama_group);
                    if ($groupAnggaran->anggaran_total != 0) {
                        $sheet->setCellValue("D$row", $groupAnggaran->anggaran_total);
                        $sheet->getStyle("D$row")->applyFromArray($rupiahFormat);
                    }
                    if ($groupAnggaran->belanjas_before != 0) {
                        $sheet->setCellValue("F$row", $groupAnggaran->belanjas_before);
                        $sheet->getStyle("F$row")->applyFromArray($rupiahFormat);
                    }
                    if ($groupAnggaran->belanjas_current != 0) {
                        $sheet->setCellValue("I$row", $groupAnggaran->belanjas_current);
                        $sheet->getStyle("I$row")->applyFromArray($rupiahFormat);
                    }
                    if (($groupAnggaran->belanjas_before) + ($groupAnggaran->belanjas_current) != 0) {
                        $sheet->setCellValue("L$row", (($groupAnggaran->belanjas_before) + ($groupAnggaran->belanjas_current)));
                        $sheet->getStyle("L$row")->applyFromArray($rupiahFormat);
                    }
                    if ($groupAnggaran->anggaran_total - (($groupAnggaran->belanjas_before) + ($groupAnggaran->belanjas_current)) != 0) {
                        $sheet->setCellValue("N$row", ($groupAnggaran->anggaran_total - (($groupAnggaran->belanjas_before) + ($groupAnggaran->belanjas_current))));
                        $sheet->getStyle("N$row")->applyFromArray($rupiahFormat);
                    }
                    $row++;
                }
            }

            $sheet->setCellValue("C$row", "Jumlah");

            if ($sumMasterAnggaran != 0) {
                $sheet->setCellValue("D$row", ($sumMasterAnggaran));
                $sheet->getStyle("D$row")->applyFromArray($rupiahFormat);
            }

            if ($sumMasterBelanjaBefore != 0) {
                $sheet->setCellValue("F$row", ($sumMasterBelanjaBefore));
                $sheet->getStyle("F$row")->applyFromArray($rupiahFormat);
            }

            if ($sumMasterBelanjaCurrent != 0) {
                $sheet->setCellValue("I$row", ($sumMasterBelanjaCurrent));
                $sheet->getStyle("I$row")->applyFromArray($rupiahFormat);
            }

            if ($sumMasterBelanjaTotal != 0) {
                $sheet->setCellValue("L$row", ($sumMasterBelanjaTotal));
                $sheet->getStyle("L$row")->applyFromArray($rupiahFormat);
            }

            if ($sumMasterAnggaran - $sumMasterBelanjaTotal != 0) {
                $sheet->setCellValue("N$row", ($sumMasterAnggaran - $sumMasterBelanjaTotal));
                $sheet->getStyle("N$row")->applyFromArray($rupiahFormat);
            }

            $sheet->getStyle("A$row:N$row")->applyFromArray($styleJumlah);

            $row++;
            $row++;
        }


        $row += 2; // Add a couple of empty rows for spacing

        // Left Signature (Mengetahui, Pengguna Anggaran)
        $sheet->setCellValue("B$row", "Mengetahui,");
        $sheet->mergeCells("B$row:C$row");
        $sheet->getStyle("B$row:C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $row++;
        $sheet->setCellValue("B$row", "Pengguna Anggaran");
        $sheet->mergeCells("B$row:C$row");
        $sheet->getStyle("B$row:C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $row += 4; // Leave some space for the signature
        $sheet->setCellValue("B$row", "(MARSE HENDRA SAPUTRA. S.STP)");
        $sheet->mergeCells("B$row:C$row");
        $sheet->getStyle("B$row:C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("B$row:C$row")->getFont()->setUnderline(true);

        $row++;
        $sheet->setCellValue("B$row", "NIP: 198103101999121001");
        $sheet->mergeCells("B$row:C$row");
        $sheet->getStyle("B$row:C$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Right Signature (Pejabat Pelaksana Teknis Kegiatan)
        $row -= 6; // Go back to the same row as "Mengetahui,"
        $sheet->setCellValue("L$row", 'Bogor,    ' . \Carbon\Carbon::now()->translatedformat('F Y'));
        $sheet->mergeCells("L$row:M$row");
        $sheet->getStyle("L$row:M$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $row++;
        $sheet->setCellValue("L$row", "Pejabat Pelaksana Teknis Kegiatan");
        $sheet->mergeCells("L$row:M$row");
        $sheet->getStyle("L$row:M$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $row += 4; // Leave some space for the signature
        $sheet->setCellValue("L$row", "(FIRZA FIRANI RIZAL, S.Kom.,M.Ak.)");
        $sheet->mergeCells("L$row:M$row");
        $sheet->getStyle("L$row:M$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("L$row:M$row")->getFont()->setUnderline(true);

        $row++;
        $sheet->setCellValue("L$row", "NIP: 197509152010012008");
        $sheet->mergeCells("L$row:M$row");
        $sheet->getStyle("L$row:M$row")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

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
                'color' => ['argb' => 'FFFFFF'],
                'size' => 15,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '1A237E'],
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
