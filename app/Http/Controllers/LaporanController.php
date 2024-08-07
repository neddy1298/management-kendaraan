<?php

namespace App\Http\Controllers;

use App\Models\GroupAnggaran;
use App\Models\MasterAnggaran;
use App\Models\PaguAnggaran;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index');
    }

    public function exportToExcel()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $masteAnggarans = MasterAnggaran::all();
        $paguAnggarans = PaguAnggaran::all();
        $groupAnggarans = GroupAnggaran::all();

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
                'size' => 12,
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
                    'argb' => 'FF808080',
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
        $rupiahFormat = [
            'numberFormat' => [
                'formatCode' => '[$Rp-421] #,##0',
            ],
        ];
        $sheet->getStyle('D17:N17' . ($row - 1))->applyFromArray($rupiahFormat);

        // Looping isi tabel
        $row = 17;
        $index = 1;

        // Heading 1
        foreach ($paguAnggarans as $paguAnggaran) {
            $sheet->setCellValue("A$row", $index);
            $sheet->setCellValue("B$row", $paguAnggaran->kode_rekening);
            $sheet->getStyle("A$row:N$row")->applyFromArray($styleHeading1);
            $row++;
            $index++;

            // Heading 2
            foreach ($masteAnggarans as $masteAnggaran) {
                $row++;
                $sheet->setCellValue("B$row", $masteAnggaran->kode_rekening);
                $sheet->getStyle("B$row:N$row")->applyFromArray($styleHeading2);
                $row++;

                // Heading 3
                foreach ($groupAnggarans as $groupAnggaran) {
                    $sheet->setCellValue("C$row", $groupAnggaran->nama_group);
                    $sheet->setCellValue("D$row", $groupAnggaran->total_anggaran);
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
                'startColor' => ['argb' => '4863A0'],
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
