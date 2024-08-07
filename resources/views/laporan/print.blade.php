<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Print</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 95%;
            margin: auto;
        }

        .header,
        .footer {
            text-align: center;
            padding: 15px;
            color: #000000;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .header h1,
        .footer p {
            margin: 0;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #000000;
            padding: 5px;
            text-align: left;
        }

        .data-table th {
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="container">
        <div style="text-align: center">
            <h4>PEMERINTAHAN KOTA BOGOR</br>KARTU KENDALI KEGIATAN</br>TAHUN ANGGARAN {{ date('Y') }}</h4>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 10px" rowspan="3">No Urut</th>
                    <th rowspan="3">Kode Rekening</th>
                    <th rowspan="3">Nama Rekening</th>
                    <th rowspan="2" colspan="2">Pagu Anggaran Kegiatan</th>
                    <th colspan="8">Realisasi Kegiatan</th>
                    <th rowspan="3" style="width: 150px">Sisa Pagu Anggaran (Rp)</th>
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
                    <tr style="background-color: #00b1fd">
                        <td style="text-align: center">{{ $index + 1 }} </td>
                        <td>{{ $paguAnggaran->kode_rekening }}</td>
                        <td>{{ $paguAnggaran->nama_rekening }}</td>
                        <td style="text-align: right">Rp {{ number_format($paguAnggaran->anggaran, 0, ',', '.') }}
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
                        <tr style="background-color: #fdad00">
                            <td></td>
                            <td>{{ $masterAnggaran->kode_rekening }}</td>
                            <td>{{ $masterAnggaran->nama_rekening }}</td>
                            <td style="text-align: right">Rp {{ number_format($masterAnggaran->anggaran, 0, ',', '.') }}
                            </td>
                            <td></td>
                            <td style="text-align: right">Rp
                                @php
                                    $sumBelanjaBefore = 0;
                                @endphp
                                @foreach ($masterAnggaran->groupAnggarans as $groupAnggaran)
                                    @php
                                        $sumBelanjaBefore += $groupAnggaran->belanjas_before;
                                    @endphp
                                @endforeach
                                {{ number_format($sumBelanjaBefore, 0, ',', '.') }}
                            </td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                @php
                                    $sumBelanjaCurrent = 0;
                                @endphp
                                @foreach ($masterAnggaran->groupAnggarans as $groupAnggaran)
                                    @php
                                        $sumBelanjaCurrent += $groupAnggaran->belanjas_current;
                                    @endphp
                                @endforeach
                                {{ number_format($sumBelanjaCurrent, 0, ',', '.') }}
                            </td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                @php
                                    $sumBelanjaTotal = 0;
                                @endphp
                                @foreach ($masterAnggaran->groupAnggarans as $groupAnggaran)
                                    @php
                                        $sumBelanjaTotal +=
                                            $groupAnggaran->belanjas_before + $groupAnggaran->belanjas_current;
                                    @endphp
                                @endforeach
                                {{ number_format($sumBelanjaTotal, 0, ',', '.') }}
                            </td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($masterAnggaran->anggaran - $sumBelanjaTotal, 0, ',', '.') }}
                            </td>
                        </tr>
                        @foreach ($masterAnggaran->groupAnggarans as $groupAnggaran)
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $groupAnggaran->nama_group }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaran_total, 0, ',', '.') }}</td>
                                <td></td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->belanjas_before ?? 0, 0, ',', '.') }}</td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->belanjas_current ?? 0, 0, ',', '.') }}</td>
                                <td></td>
                                <td></td>
                                <td style="text-align: right">Rp
                                    {{ number_format(($groupAnggaran->belanjas_before ?? 0) + ($groupAnggaran->belanjas_current ?? 0), 0, ',', '.') }}
                                </td>
                                <td></td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaran_total - (($groupAnggaran->belanjas_before ?? 0) + ($groupAnggaran->belanjas_current ?? 0)), 0, ',', '.') }}
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
