<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Print</title>
    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .page-break-after {
                page-break-after: always;
            }

            .no-print {
                display: none;
            }

            .print-only {
                display: block;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }

            thead {
                display: table-header-group;
            }

            tfoot {
                display: table-footer-group;
            }
        }

        @page {
            size: landscape;
            margin: 1cm;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            -webkit-print-color-adjust: exact;
        }

        .container {
            width: 100%;
            margin: auto;
        }

        .header {
            text-align: center;
            color: #000000;
        }

        .header h4 {
            margin: 0 0 50px 0;
            font-size: 16px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .header-table td {
            padding: 2px;
            text-align: left;
            font-size: 12px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #000000;
            padding: 4px;
            text-align: left;
        }

        .data-table th {
            font-weight: bold;
            text-align: center;
        }

        .pagu-anggaran {
            background-color: #aae5ff;
        }

        .master-anggaran {
            background-color: #fbdd9d;
        }

        .footer {
            text-align: center;
            padding: 10px;
            color: #000000;
            position: running(footer);
        }

        @page {
            @bottom-center {
                content: element(footer);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header print-only">
            <h4>PEMERINTAHAN KOTA BOGOR<br>KARTU KENDALI KEGIATAN<br>TAHUN ANGGARAN {{ $tahun }}</h4>
            <table class="header-table">
                <tr>
                    <td style="width: 150px;">Sub Unit</td>
                    <td>: DINAS PERHUBUNGAN KOTA BOGOR</td>
                </tr>
                <tr>
                    <td>Nama Program</td>
                    <td>: PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA</td>
                </tr>
                <tr>
                    <td>Nama Kegiatan</td>
                    <td>: Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan Daerah</td>
                </tr>
                <tr>
                    <td>Sub Kegiatan</td>
                    <td>: Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak, dan Perizinan Kendaraan Dinas
                        Operasional atau Lapangan</td>
                </tr>
                <tr>
                    <td>Nama PPTK</td>
                    <td>: Firza Firani Rizal, S.Kom, M.Ak.</td>
                </tr>
                <tr>
                    <td>Bulan</td>
                    <td>: {{ $endDate->translatedformat('F Y') }}</td>
                </tr>
            </table>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 5px" rowspan="3">No Urut</th>
                    <th style="width: 120px" rowspan="3">Kode Rekening</th>
                    <th style="width: 200px" rowspan="3">Nama Rekening</th>
                    <th style="width: 150px" rowspan="2" colspan="2">Pagu Anggaran Kegiatan</th>
                    <th colspan="8">Realisasi Kegiatan</th>
                    <th style="width: 130px" rowspan="3">Sisa Pagu Anggaran (Rp)</th>
                </tr>
                <tr>
                    <th colspan="2">S/D BULAN LALU</th>
                    <th colspan="4">BULAN INI</th>
                    <th colspan="2">S/D BULAN INI</th>
                </tr>
                <tr>
                    <th>UP/GU/TU</th>
                    <th>LS</th>
                    <th>UP/GU/TU</th>
                    <th>LS</th>
                    <th>UP</th>
                    <th>GU</th>
                    <th>TU</th>
                    <th>LS</th>
                    <th>UP/GU/TU</th>
                    <th>LS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($paguAnggarans as $index => $paguAnggaran)
                    <tr class="pagu-anggaran">
                        <td style="text-align: center">{{ $index + 1 }} </td>
                        <td>{{ $paguAnggaran->kode_rekening }}</td>
                        <td>{{ $paguAnggaran->nama_rekening }}</td>
                        <td style="text-align: right">
                            @if ($paguAnggaran->anggaran != 0)
                                Rp {{ number_format($paguAnggaran->anggaran, 0, ',', '.') }}
                            @endif
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @php
                        $sumMasterAnggaran = 0;
                        $sumMasterBelanjaBefore = 0;
                        $sumMasterBelanjaCurrent = 0;
                        $sumMasterBelanjaTotal = 0;
                    @endphp
                    @foreach ($paguAnggaran->masterAnggarans as $masterAnggaran)
                        <tr class="master-anggaran">
                            <td></td>
                            <td>{{ $masterAnggaran->kode_rekening }}</td>
                            <td>{{ $masterAnggaran->nama_rekening }}</td>
                            <td style="text-align: right">
                                @if ($masterAnggaran->anggaran != 0)
                                    Rp {{ number_format($masterAnggaran->anggaran, 0, ',', '.') }}
                                @endif

                                @php
                                    $sumMasterAnggaran += $masterAnggaran->anggaran;
                                @endphp
                            </td>
                            <td></td>
                            <td style="text-align: right">
                                @php
                                    $sumBelanjaBefore = 0;
                                @endphp
                                @foreach ($masterAnggaran->groupAnggarans as $groupAnggaran)
                                    @php
                                        $sumBelanjaBefore += $groupAnggaran->belanjas_before;
                                    @endphp
                                @endforeach
                                @php
                                    $sumMasterBelanjaBefore += $sumBelanjaBefore;
                                @endphp
                                @if ($sumBelanjaBefore != 0)
                                    Rp {{ number_format($sumBelanjaBefore, 0, ',', '.') }}
                                @endif
                            </td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">
                                @php
                                    $sumBelanjaCurrent = 0;
                                @endphp
                                @foreach ($masterAnggaran->groupAnggarans as $groupAnggaran)
                                    @php
                                        $sumBelanjaCurrent += $groupAnggaran->belanjas_current;
                                    @endphp
                                @endforeach
                                @php
                                    $sumMasterBelanjaCurrent += $sumBelanjaCurrent;
                                @endphp
                                @if ($sumBelanjaCurrent != 0)
                                    Rp {{ number_format($sumBelanjaCurrent, 0, ',', '.') }}
                                @endif
                            </td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">
                                @php
                                    $sumBelanjaTotal = $sumBelanjaBefore + $sumBelanjaCurrent;
                                @endphp
                                @php
                                    $sumMasterBelanjaTotal += $sumBelanjaTotal;
                                @endphp
                                @if ($sumBelanjaTotal != 0)
                                    Rp {{ number_format($sumBelanjaTotal, 0, ',', '.') }}
                                @endif
                            </td>
                            <td></td>
                            <td style="text-align: right">
                                @if ($masterAnggaran->anggaran - $sumBelanjaTotal != 0)
                                    Rp {{ number_format($masterAnggaran->anggaran - $sumBelanjaTotal, 0, ',', '.') }}
                                @endif
                            </td>
                        </tr>
                        @foreach ($masterAnggaran->groupAnggarans as $groupAnggaran)
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $groupAnggaran->nama_group }}</td>
                                <td style="text-align: right">
                                    @if ($groupAnggaran->anggaran_total != 0)
                                        Rp {{ number_format($groupAnggaran->anggaran_total, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td></td>
                                <td style="text-align: right">
                                    @if ($groupAnggaran->belanjas_before != 0)
                                        Rp {{ number_format($groupAnggaran->belanjas_before ?? 0, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right">
                                    @if ($groupAnggaran->belanjas_current != 0)
                                        Rp {{ number_format($groupAnggaran->belanjas_current ?? 0, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right">
                                    @if (($groupAnggaran->belanjas_before ?? 0) + ($groupAnggaran->belanjas_current ?? 0) != 0)
                                        Rp
                                        {{ number_format(($groupAnggaran->belanjas_before ?? 0) + ($groupAnggaran->belanjas_current ?? 0), 0, ',', '.') }}
                                    @endif
                                </td>
                                <td></td>
                                <td style="text-align: right">
                                    @if (
                                        $groupAnggaran->anggaran_total -
                                            (($groupAnggaran->belanjas_before ?? 0) + ($groupAnggaran->belanjas_current ?? 0)) !=
                                            0)
                                        Rp
                                        {{ number_format($groupAnggaran->anggaran_total - (($groupAnggaran->belanjas_before ?? 0) + ($groupAnggaran->belanjas_current ?? 0)), 0, ',', '.') }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach

                    <tr style="background-color: #cdfaed">
                        <td></td>
                        <td></td>
                        <td>Jumlah</td>
                        <td style="text-align: right">
                            @if ($sumMasterAnggaran != 0)
                                Rp {{ number_format($sumMasterAnggaran ?? 0, 0, ',', '.') }}
                            @endif
                        <td></td>
                        <td style="text-align: right">
                            @if ($sumMasterBelanjaBefore != 0)
                                Rp {{ number_format($sumMasterBelanjaBefore ?? 0, 0, ',', '.') }}
                            @endif
                        </td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right">
                            @if ($sumMasterBelanjaCurrent != 0)
                                Rp {{ number_format($sumMasterBelanjaCurrent ?? 0, 0, ',', '.') }}
                            @endif
                        </td>
                        <td></td>
                        <td></td>
                        <td style="text-align: right">
                            @if ($sumMasterBelanjaTotal != 0)
                                Rp {{ number_format($sumMasterBelanjaTotal ?? 0, 0, ',', '.') }}
                            @endif
                        </td>
                        <td></td>
                        <td style="text-align: right">
                            @if ($sumMasterAnggaran - $sumMasterBelanjaTotal != 0)
                                Rp {{ number_format($sumMasterAnggaran - $sumMasterBelanjaTotal, 0, ',', '.') }}
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>&copy; Laporan Keuangan Dishub Kota Bogor</p>
        </div>
    </div>
</body>

</html>
