<?php

namespace App\Http\Controllers;

use App\Models\Belanja;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;


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

        $maintenances = $query->orderBy('tanggal_maintenance', 'desc')->with('laporanBulanan', 'kendaraan')->get();

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


        // judul
        $sheet->setCellValue('A1', 'RKA BBM DAN PEMELIHARAAN 2024');
        $sheet->setCellValue('A2', 'Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak dan Perizinan Kendaraan Dinas Operasional atau Lapangan');

        $highestColumn = 'J';
        $sheet->mergeCells('A1:' . $highestColumn . '1');
        $sheet->mergeCells('A2:' . $highestColumn . '2');


        // style
        $sheet->getStyle('A1:A2')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);
        foreach (range('A2', 'J2') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }


        // Bagian pertama dari tabel
        $header1 = [
            'A4' => 'No',
            'B4' => 'Kode Rekening',
            'C4' => 'Uraian',
            'D4' => 'Volume',
            'E4' => 'Satuan',
            'F4' => 'Volume',
            'G4' => 'Satuan',
            'H4' => 'Harga',
            'I4' => 'Jumlah',
            'J4' => 'Vol'
        ];

        // Bagian bulanan dari tabel
        $months = [
            'L4' => 'Januari', 'M4' => 'SPJ', 'N4' => 'Silpa',
            'P4' => 'Februari', 'Q4' => 'SPJ', 'R4' => 'Silpa',
            'T4' => 'Maret', 'U4' => 'SPJ', 'V4' => 'Silpa',
            'X4' => 'April', 'Y4' => 'SPJ', 'Z4' => 'Silpa',
            'AB4' => 'Mei', 'AC4' => 'SPJ', 'AD4' => 'Silpa',
            'AF4' => 'Juni', 'AG4' => 'SPJ', 'AH4' => 'Silpa',
            'AJ4' => 'Juli', 'AK4' => 'SPJ', 'AL4' => 'Silpa',
            'AN4' => 'Agustus', 'AO4' => 'SPJ', 'AP4' => 'Silpa',
            'AR4' => 'September', 'AS4' => 'SPJ', 'AT4' => 'Silpa',
            'AV4' => 'Oktober', 'AW4' => 'SPJ', 'AX4' => 'Silpa',
            'AZ4' => 'November', 'BA4' => 'SPJ', 'BB4' => 'Silpa',
            'BD4' => 'Desember', 'BE4' => 'SPJ', 'BF4' => 'Silpa'
        ];

        // Menggabungkan header pertama dan header bulan
        $headers = array_merge($header1, $months, ['BH4' => 'Total Pagu']);

        // Mengisi nilai sel dengan loop
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }


        // sytle    
        $headerStyleArray = [
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => '0F046A'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        // header style
        $sheet->getStyle('A4:BH4')->applyFromArray($headerStyleArray);

        // Auto size columns
        foreach (range('A4', 'BH4') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }


        // data & border
        $row = 5;
        $alternate = false;
        $borderStyleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'],
                ],
            ],
        ];

        foreach ($maintenances as $index => $maintenance) {
            $currentRow = $row + $index;

            $sheet->setCellValue('A' . $currentRow, $index + 1)
                ->setCellValue('B' . $currentRow, $maintenance->kendaraan->nomor_registrasi)
                ->setCellValue('C' . $currentRow, $maintenance->kendaraan->unitKerja->nama_unit_kerja)
                ->setCellValue('D' . $currentRow, $maintenance->totalSemuaBelanja())
                ->setCellValue('E' . $currentRow, \Carbon\Carbon::parse($maintenance->berlaku_sampai)->translatedFormat('d F Y'))
                ->setCellValue('F' . $currentRow, \Carbon\Carbon::parse($maintenance->tanggal_maintenance)->translatedFormat('F Y'))
                ->setCellValue('G' . $currentRow, $index)
                ->setCellValue('H' . $currentRow, $index)
                ->setCellValue('I' . $currentRow, $index)
                ->setCellValue('J' . $currentRow, $index)
                //->setCellValue('K' . $currentRow, $index)
                ->setCellValue('L' . $currentRow, $index)
                ->setCellValue('M' . $currentRow, $index)
                ->setCellValue('N' . $currentRow, $index)
                //->setCellValue('O' . $currentRow, $index)
                ->setCellValue('P' . $currentRow, $index)
                ->setCellValue('Q' . $currentRow, $index)
                ->setCellValue('R' . $currentRow, $index)
                //->setCellValue('S' . $currentRow, $index)
                ->setCellValue('T' . $currentRow, $index)
                ->setCellValue('U' . $currentRow, $index)
                ->setCellValue('V' . $currentRow, $index)
                //->setCellValue('W' . $currentRow, $index)
                ->setCellValue('X' . $currentRow, $index)
                ->setCellValue('Y' . $currentRow, $index)
                ->setCellValue('Z' . $currentRow, $index)
                //->setCellValue('AA' . $currentRow, $index)
                ->setCellValue('AB' . $currentRow, $index)
                ->setCellValue('AC' . $currentRow, $index)
                ->setCellValue('AD' . $currentRow, $index)
                //->setCellValue('AE' . $currentRow, $index)
                ->setCellValue('AF' . $currentRow, $index)
                ->setCellValue('AG' . $currentRow, $index)
                ->setCellValue('AH' . $currentRow, $index)
                //->setCellValue('AI' . $currentRow, $index)
                ->setCellValue('AJ' . $currentRow, $index)
                ->setCellValue('AK' . $currentRow, $index)
                ->setCellValue('AL' . $currentRow, $index)
                //->setCellValue('AM' . $currentRow, $index)
                ->setCellValue('AN' . $currentRow, $index)
                ->setCellValue('AO' . $currentRow, $index)
                ->setCellValue('AP' . $currentRow, $index)
                //->setCellValue('AQ' . $currentRow, $index)
                ->setCellValue('AR' . $currentRow, $index)
                ->setCellValue('AS' . $currentRow, $index)
                ->setCellValue('AT' . $currentRow, $index)
                //->setCellValue('AU' . $currentRow, $index)
                ->setCellValue('AV' . $currentRow, $index)
                ->setCellValue('AW' . $currentRow, $index)
                ->setCellValue('AX' . $currentRow, $index)
                //->setCellValue('AY' . $currentRow, $index)
                ->setCellValue('AZ' . $currentRow, $index)
                ->setCellValue('BA' . $currentRow, $index)
                ->setCellValue('BB' . $currentRow, $index)
                //->setCellValue('BC' . $currentRow, $index)
                ->setCellValue('BD' . $currentRow, $index)
                ->setCellValue('BE' . $currentRow, $index)
                ->setCellValue('BF' . $currentRow, $index)
                //->setCellValue('BG' . $currentRow, $index)
                ->setCellValue('BH' . $currentRow, $index);

            // koversi ke rupiah
            $columns = ['H', 'I', 'L', 'M', 'N', 'P', 'Q', 'R'];
            foreach ($columns as $column) {
                $sheet->getStyle($column . $currentRow)->getNumberFormat()->setFormatCode('[$Rp-421]#,##0');
            }

            // warna
            $fillColor = $alternate ? 'D3D3D3' : 'FFFFFF';
            $sheet->getStyle("A$currentRow:J$currentRow")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($fillColor);

            $sheet->getStyle("A$currentRow:J$currentRow")->applyFromArray($borderStyleArray);
            $alternate = !$alternate;


            // perbulan
            $months = [
                'januari'   => ['color' => '98AFC7', 'range' => "L$currentRow:N$currentRow"],
                'februari'  => ['color' => '728FCE', 'range' => "P$currentRow:R$currentRow"],
                'maret'     => ['color' => 'B38481', 'range' => "T$currentRow:V$currentRow"],
                'april'     => ['color' => 'BDEDFF', 'range' => "X$currentRow:Z$currentRow"],
                'mei'       => ['color' => 'F2D4D7', 'range' => "AB$currentRow:AD$currentRow"],
                'juni'      => ['color' => '93E9BE', 'range' => "AF$currentRow:AH$currentRow"],
                'juli'      => ['color' => '00A36C', 'range' => "AJ$currentRow:AL$currentRow"],
                'agustus'   => ['color' => '64E986', 'range' => "AN$currentRow:AP$currentRow"],
                'september' => ['color' => 'D462FF', 'range' => "AR$currentRow:AT$currentRow"],
                'oktober'   => ['color' => 'FFF0DB', 'range' => "AV$currentRow:AX$currentRow"],
                'november'  => ['color' => 'FFF380', 'range' => "AZ$currentRow:BB$currentRow"],
                'desember'  => ['color' => 'CA762B', 'range' => "BD$currentRow:BF$currentRow"],
            ];

            foreach ($months as $month => $data) {
                $sheet->getStyle($data['range'])->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($data['color']);
            }

            // total pagu
            $fillColor = 'FF8674';
            $sheet->getStyle("BH$currentRow")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB($fillColor);
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Maintenance Kendaraan Dishub Kota Bogor ' . date('d-m-Y') . '.xlsx';

        // headers untuk unduhan file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit();

        // composer require phpoffice/phpspreadsheet
    }
}
