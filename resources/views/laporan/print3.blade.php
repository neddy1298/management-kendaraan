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
            /* Adjust this value based on the height of your first header row */
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
            <h4>Realisasi dan Estimasi Kendaraan <br>Tahun {{ $tahun }} </h4>
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
                    <th style="width: 100px" rowspan="2">Pagu Anggaran</th>
                    @foreach ($months as $index => $month)
                        <th style="width: 300px" colspan="3" class="color-{{ $index + 1 }}">
                            {{ $month }}</th>
                    @endforeach
                    <th style="width: 100px" rowspan="2">Jumlah Realisasi</th>
                    <th style="width: 100px" rowspan="2">Sisa Pagu</th>
                </tr>
                <tr>
                    @foreach ($months as $index => $month)
                        <td style="width: 100px; text-align: center" class="color-{{ $index + 1 }}">BBM</td>
                        <td style="width: 100px; text-align: center" class="color-{{ $index + 1 }}">Pelumas</td>
                        <td style="width: 100px; text-align: center" class="color-{{ $index + 1 }}">Suku Cadang</td>
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
                    @php
                        $total_belanja = 0;
                        $groupAnggaranKendaraans = $semuaGroupAnggaranKendaraans->where('kendaraan_id', $kendaraan->id);
                    @endphp
                    <tr>
                        <td style="text-align: center">{{ $index + 1 }}</td>
                        <td style="text-align: center">{{ $kendaraan->nomor_registrasi }}</td>
                        <td style="text-align: center" class="color-{{ $kendaraan->cc_kendaraan <= 150 ? 1 : 2 }}">
                            {{ $kendaraan->cc_kendaraan }}
                        </td>
                        <td style="text-align: right">
                            Rp
                            {{ number_format($kendaraan->anggaran_pertahun_kendaraan, 0, ',', '.') }} </td>
                        @foreach (range(1, 12) as $month)
                            @php
                                $filteredBelanja = $kendaraan->belanjas->whereBetween('tanggal_belanja', [
                                    $tahun . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01',
                                    $tahun . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-31',
                                ]);

                                $total_bbm = $filteredBelanja->sum('belanja_bahan_bakar_minyak');
                                $total_pelumas = $filteredBelanja->sum('belanja_pelumas_mesin');
                                $total_suku_cadang = $filteredBelanja->sum('belanja_suku_cadang');

                                $total_belanja += $total_bbm + $total_pelumas + $total_suku_cadang;
                            @endphp
                            @if ($total_bbm != 0)
                                <td style="text-align: right" class="color-{{ $month }}">
                                    Rp {{ number_format($total_bbm, 0, ',', '.') }}
                                </td>
                            @else
                                <td class="color-{{ $month }}"></td>
                            @endif
                            @if ($total_pelumas != 0)
                                <td style="text-align: right" class="color-{{ $month }}">
                                    Rp {{ number_format($total_pelumas, 0, ',', '.') }}
                                </td>
                            @else
                                <td class="color-{{ $month }}"></td>
                            @endif
                            @if ($total_suku_cadang != 0)
                                <td style="text-align: right" class="color-{{ $month }}">
                                    Rp {{ number_format($total_suku_cadang, 0, ',', '.') }}
                                </td>
                            @else
                                <td class="color-{{ $month }}"></td>
                            @endif
                        @endforeach
                        <td style="text-align: right">
                            Rp {{ number_format($total_belanja, 0, ',', '.') }}
                        </td>
                        <td style="text-align: right">
                            Rp
                            {{ number_format($kendaraan->anggaran_pertahun_kendaraan - $total_belanja, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
