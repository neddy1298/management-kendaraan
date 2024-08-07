<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Print</title>
    <style>
        @page {
            size: landscape;
            margin: 1cm;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            -webkit-print-color-adjust: exact;
        }

        .container {
            width: 100%;
            margin: auto;
        }

        .header,
        .footer {
            text-align: center;
            padding: 10px;
            color: #000000;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .header h1,
        .footer p {
            margin: 0;
        }

        .header h6 {
            margin: 0;
            text-align: start;
            font-weight: 100;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
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
            background-color: #00b1fd;
        }

        .master-anggaran {
            background-color: #fdad00;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h4>PEMERINTAHAN KOTA BOGOR<br>KARTU KENDALI KEGIATAN<br>TAHUN ANGGARAN {{ $tahun }}</h4>
            <table>
                <tr>
                    <td>
                        <h6>Sub Unit</h6>
                    </td>
                    <td>
                        <h6>&emsp;&emsp;: Test</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Nama Program</h6>
                    </td>
                    <td>
                        <h6>&emsp;&emsp;: Test</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Nama Kegiatan</h6>
                    </td>
                    <td>
                        <h6>&emsp;&emsp;: Test</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Sub Kegiatan</h6>
                    </td>
                    <td>
                        <h6>&emsp;&emsp;: Test</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Sub Kegiatan</h6>
                    </td>
                    <td>
                        <h6>&emsp;&emsp;: Test</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Bulan</h6>
                    </td>
                    <td>
                        <h6>&emsp;&emsp;: {{ $endDate->translatedformat('F Y') }}</h6>
                    </td>
                </tr>
            </table>
        </div>
        <div class="subheader">
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 5px" rowspan="3">No Urut</th>
                    <th style="width: 120px" rowspan="3">Kode Rekening</th>
                    <th style="width: 250px" rowspan="3">Nama Rekening</th>
                    <th rowspan="2" colspan="2">Pagu Anggaran Kegiatan</th>
                    <th colspan="8">Realisasi Kegiatan</th>
                    <th style="width: 150px" rowspan="3">Sisa Pagu Anggaran (Rp)</th>
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
                    @foreach ($paguAnggaran->masterAnggarans as $masterAnggaran)
                        <tr class="master-anggaran">
                            <td></td>
                            <td>{{ $masterAnggaran->kode_rekening }}</td>
                            <td>{{ $masterAnggaran->nama_rekening }}</td>
                            <td style="text-align: right">
                                @if ($masterAnggaran->anggaran != 0)
                                    Rp {{ number_format($masterAnggaran->anggaran, 0, ',', '.') }}
                                @endif
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
                                @if ($sumBelanjaCurrent != 0)
                                    Rp {{ number_format($sumBelanjaCurrent, 0, ',', '.') }}
                                @endif
                            </td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">
                                @php
                                    $sumBelanjaTotal = 0;
                                @endphp
                                @foreach ($masterAnggaran->groupAnggarans as $groupAnggaran)
                                    @php
                                        $sumBelanjaTotal +=
                                            $groupAnggaran->belanjas_before + $groupAnggaran->belanjas_current;
                                    @endphp
                                @endforeach
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
                        <tr>
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
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p>&copy; Data Kendaraan Dishub Kota Bogor</p>
        </div>
    </div>
</body>

</html>
