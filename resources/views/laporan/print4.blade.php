<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Print</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            -webkit-print-color-adjust: exact;
        }

        .container {
            width: 100%;
            overflow-y: auto;
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
            position: sticky;
            top: 0;
            z-index: 2;
        }

        .header-table td {
            padding: 2px;
            text-align: left;
            font-size: 10px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8px;
            table-layout: fixed;
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
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .data-table thead tr:nth-child(2) th {
            top: 25px;
        }

        /* Color classes */
        .color-1 {
            background-color: #FFCCCC;
        }

        .color-2 {
            background-color: #FFE5CC;
        }

        .color-3 {
            background-color: #FFFFCC;
        }

        .color-4 {
            background-color: #CCFFCC;
        }

        .color-5 {
            background-color: #CCE5FF;
        }

        .color-6 {
            background-color: #E5CCFF;
        }

        .color-7 {
            background-color: #FFCCE5;
        }

        .color-8 {
            background-color: #E5FFCC;
        }

        .color-9 {
            background-color: #CCFFFF;
        }

        .color-10 {
            background-color: #FFCCE5;
        }

        .color-11 {
            background-color: #E5CCFF;
        }

        .color-12 {
            background-color: #FFCCFF;
        }

        /* Ensure color classes work with sticky positioning */
        .data-table th[class*="color-"] {
            background-color: inherit;
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
        <div class="header print-only"><br>
            <h4>Realisasi Suku Cadang Kendaraan <br>Tahun {{ $tahun }} </h4>
        </div>
        <table id="data-table" class="data-table">
            @php
                $months = [
                    'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember',
                ];
            @endphp
            <thead>
                <tr>
                    <th style="width: 15px" rowspan="2">No Urut</th>
                    <th style="width: 90px" rowspan="2">Plat Nomer</th>
                    <th style="width: 90px" rowspan="2">CC Kendaraan</th>
                    @foreach ($months as $index => $month)
                        <th style="width: 300px" colspan="2" class="color-{{ $index + 1 }}">
                            {{ $month }}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach ($months as $index => $month)
                        <td style="width: auto; text-align: center" class="color-{{ $index + 1 }}">Suku Cadang</td>
                        <td style="width: 10px; text-align: center" class="color-{{ $index + 1 }}">Jumlah</td>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $roda_group = 0;
                @endphp
                @foreach ($kendaraans as $index => $kendaraan)
                    @if ($kendaraan->roda_kendaraan == 2)
                        @if ($roda_group == 0)
                            <tr style="background-color: #b7c7ff">
                                <td></td>
                                <td style="text-align: center">
                                    <strong>Roda {{ $kendaraan->roda_kendaraan }}</strong>
                                </td>
                                <td colspan="40"></td>
                            </tr>
                            @php
                                $roda_group++;
                            @endphp
                        @endif
                    @elseif ($kendaraan->roda_kendaraan == 4)
                        @if ($roda_group == 1)
                            <tr style="background-color: #b7c7ff">
                                <td></td>
                                <td style="text-align: center">
                                    <strong>Roda {{ $kendaraan->roda_kendaraan }}</strong>
                                </td>
                                <td colspan="40"></td>
                            </tr>
                            @php
                                $roda_group++;
                            @endphp
                        @endif
                    @elseif ($kendaraan->roda_kendaraan == 6)
                        @if ($roda_group == 2)
                            <tr style="background-color: #b7c7ff">
                                <td></td>
                                <td style="text-align: center">
                                    <strong>Roda {{ $kendaraan->roda_kendaraan }}</strong>
                                </td>
                                <td colspan="40"></td>
                            </tr>
                            @php
                                $roda_group++;
                            @endphp
                        @endif
                    @elseif ($kendaraan->roda_kendaraan == 10)
                        @if ($roda_group == 3)
                            <tr style="background-color: #b7c7ff">
                                <td></td>
                                <td style="text-align: center">
                                    <strong>Roda {{ $kendaraan->roda_kendaraan }}</strong>
                                </td>
                                <td colspan="40"></td>
                            </tr>
                            @php
                                $roda_group++;
                            @endphp
                        @endif
                    @endif
                    <tr>
                        <td style="text-align: center">{{ $index + 1 }}</td>
                        <td style="text-align: center"><a style="text-decoration: none; color: black" target="_blank"
                                href="{{ route('kendaraan.edit', $kendaraan->id) }}">{{ $kendaraan->nomor_registrasi }}</a>
                        </td>
                        <td style="text-align: center">
                            {{ $kendaraan->cc_kendaraan }}
                        </td>
                        @foreach (range(1, 12) as $month)
                            @php
                                $startDate = $tahun . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01';
                                $endDate = $tahun . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-31';

                                $filteredBelanja = $kendaraan->belanjas->whereBetween('tanggal_belanja', [
                                    $startDate,
                                    $endDate,
                                ]);
                            @endphp

                            <td class="color-{{ $month }}">
                                @foreach ($filteredBelanja as $belanja)
                                    @if ($belanja->belanja_suku_cadang > 0)
                                        @foreach ($sukuCadangs->where('belanja_id', $belanja->id) as $suku_cadang)
                                            {{ $suku_cadang->nama_suku_cadang }}
                                            <br><br>
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>

                            <td style="width: 10px; text-align: center" class="color-{{ $month }}">
                                @foreach ($filteredBelanja as $belanja)
                                    @if ($belanja->belanja_suku_cadang > 0)
                                        @foreach ($sukuCadangs->where('belanja_id', $belanja->id) as $suku_cadang)
                                            {{ $suku_cadang->jumlah }}
                                            <br><br>
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
