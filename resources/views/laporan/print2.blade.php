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

        /* Rest of your existing styles */
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
        <div class="header print-only"><br>
            <h4>RKA BBM DAN PEMELIHARAAN {{ $tahun }} <br><br> Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan,
                Pajak dan Perizinan Kendaraan Dinas Operasional atau
                Lapangan</h4>
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
                    <th style="width: 90px" rowspan="2">Kode Rekening</th>
                    <th style="width: 300px" rowspan="2">Nama Rekening</th>
                    <th style="width: 50px" rowspan="2">Volume</th>
                    <th style="width: 200px" rowspan="2">Jumlah</th>
                    @foreach ($months as $index => $month)
                        <th style="width: 300px" colspan="{{ $index == 0 ? 3 : 4 }}" class="color-{{ $index + 1 }}">
                            {{ $month }}</th>
                    @endforeach
                    <th style="width: 100px" rowspan="2">Sisa Pagu</th>
                </tr>
                <tr>
                    @foreach ($months as $index => $month)
                        <td style="width: 100px; text-align: center" class="color-{{ $index + 1 }}">Anggaran Kas</td>
                        @if ($index != 0)
                            <td style="width: 100px; text-align: center" class="color-{{ $index + 1 }}">
                                {{ substr($month, 0, 3) }}+Silpa</td>
                        @endif
                        <td style="width: 100px; text-align: center" class="color-{{ $index + 1 }}">SPJ</td>
                        <td style="width: 100px; text-align: center" class="color-{{ $index + 1 }}">Silpa</td>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($paguAnggarans as $index => $paguAnggaran)
                    <tr style="background-color: #d4d4fe">
                        <td style="text-align: center">{{ $index + 1 }}</td>
                        <td>
                            <a style="text-decoration: none; font-weight: bold; color: black"
                                href="{{ route('paguAnggaran.edit', $paguAnggaran->id) }}">{{ $paguAnggaran->kode_rekening }}</a>
                        </td>
                        <td>
                            <a style="text-decoration: none; font-weight: bold; color: black"
                                href="{{ route('paguAnggaran.edit', $paguAnggaran->id) }}">{{ $paguAnggaran->nama_rekening }}</a>
                        </td>
                        <td></td>
                        <td style="text-align: right"> Rp {{ number_format($paguAnggaran->anggaran, 0, ',', '.') }}
                        </td>
                        <td colspan="48"></td>

                    </tr>
                    @foreach ($paguAnggaran->masterAnggarans as $index2 => $masterAnggaran)
                        @php
                            $months = [
                                'januari',
                                'februari',
                                'maret',
                                'april',
                                'mei',
                                'juni',
                                'juli',
                                'agustus',
                                'september',
                                'oktober',
                                'november',
                                'desember',
                            ];
                        @endphp

                        <tr class="master-anggaran">
                            <td style="text-align: center">{{ $index2 + 1 }}</td>
                            <td>
                                <a style="text-decoration: none;font-weight: bold; color: black"
                                    href="{{ route('masterAnggaran.edit', $masterAnggaran->id) }}">{{ $masterAnggaran->kode_rekening }}</a>
                            </td>
                            <td>
                                <a style="text-decoration: none;font-weight: bold; color: black"
                                    href="{{ route('masterAnggaran.edit', $masterAnggaran->id) }}">{{ $masterAnggaran->nama_rekening }}</a>
                            </td>
                            <td></td>
                            <td style="text-align: right">
                                @if ($masterAnggaran->anggaran != 0)
                                    Rp {{ number_format($masterAnggaran->anggaran, 0, ',', '.') }}
                                @endif
                            </td>
                            @foreach ($months as $index => $month)
                                <td style="text-align: right">Rp
                                    {{ number_format($paguAnggaran->anggaranPerbulan->$month, 0, ',', '.') }}</td>
                                @if ($index == 0)
                                    <td></td>
                                    <td></td>
                                @else
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @endif
                            @endforeach
                            <td></td>
                        </tr>
                        @php
                            $jarak = 0;
                        @endphp
                        @foreach ($masterAnggaran->groupAnggarans as $groupAnggaran)
                            @php
                                $belanjaJanuari = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-01-01', $tahun . '-01-31'])
                                    ->sum('total_belanja');
                                $belanjaFebruari = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-02-01', $tahun . '-02-31'])
                                    ->sum('total_belanja');
                                $belanjaMaret = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-03-01', $tahun . '-03-31'])
                                    ->sum('total_belanja');
                                $belanjaApril = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-04-01', $tahun . '-04-31'])
                                    ->sum('total_belanja');
                                $belanjaMei = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-05-01', $tahun . '-05-31'])
                                    ->sum('total_belanja');
                                $belanjaJuni = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-06-01', $tahun . '-06-31'])
                                    ->sum('total_belanja');
                                $belanjaJuli = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-07-01', $tahun . '-07-31'])
                                    ->sum('total_belanja');
                                $belanjaAgustus = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-08-01', $tahun . '-08-31'])
                                    ->sum('total_belanja');
                                $belanjaSeptember = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-09-01', $tahun . '-09-31'])
                                    ->sum('total_belanja');
                                $belanjaOktober = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-10-01', $tahun . '-10-31'])
                                    ->sum('total_belanja');
                                $belanjaNovember = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-11-01', $tahun . '-11-31'])
                                    ->sum('total_belanja');
                                $belanjaDesember = $groupAnggaran->belanjas
                                    ->whereBetween('tanggal_belanja', [$tahun . '-12-01', $tahun . '-12-31'])
                                    ->sum('total_belanja');
                                if (
                                    $groupAnggaran->tipe_belanja == 'Bahan Bakar Minyak' ||
                                    $groupAnggaran->tipe_belanja == 'Suku Cadang'
                                ) {
                                    $jansilpa = 0;
                                    $febsilpa = 0;
                                    $maretsilpa = 0;
                                    $aprilsilpa = 0;
                                    $meisilpa = 0;
                                    $junisilpa = 0;
                                    $julisilpa = 0;
                                    $agusilpa = 0;
                                    $sepsilpa = 0;
                                    $oktsilpa = 0;
                                    $novsilpa = 0;
                                    $dessilpa = 0;
                                } else {
                                    $jansilpa = $groupAnggaran->anggaranPerbulan->januari;
                                    $febsilpa =
                                        $jansilpa + $groupAnggaran->anggaranPerbulan->februari - $belanjaJanuari;
                                    $maretsilpa =
                                        $febsilpa + $groupAnggaran->anggaranPerbulan->maret - $belanjaFebruari;
                                    $aprilsilpa = $maretsilpa + $groupAnggaran->anggaranPerbulan->april - $belanjaMaret;
                                    $meisilpa = $aprilsilpa + $groupAnggaran->anggaranPerbulan->mei - $belanjaApril;
                                    $junisilpa = $meisilpa + $groupAnggaran->anggaranPerbulan->juni - $belanjaMei;
                                    $julisilpa = $junisilpa + $groupAnggaran->anggaranPerbulan->juli - $belanjaJuni;
                                    $agusilpa = $julisilpa + $groupAnggaran->anggaranPerbulan->agustus - $belanjaJuli;
                                    $sepsilpa =
                                        $agusilpa + $groupAnggaran->anggaranPerbulan->september - $belanjaAgustus;
                                    $oktsilpa =
                                        $sepsilpa + $groupAnggaran->anggaranPerbulan->oktober - $belanjaSeptember;
                                    $novsilpa =
                                        $oktsilpa + $groupAnggaran->anggaranPerbulan->november - $belanjaOktober;
                                    $dessilpa =
                                        $novsilpa + $groupAnggaran->anggaranPerbulan->desember - $belanjaNovember;
                                }
                            @endphp
                            @if ($groupAnggaran->tipe_belanja == 'Pelumas Mesin')
                                @if ($jarak == 0)
                                    <tr class="master-anggaran">
                                        <td></td>
                                        <td>{{ $groupAnggaran->kode_rekening }}</td>
                                        <td style="font-weight: bold">Belanja Pelumas Kendaraan Ops Dinas Perhubungan
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="48"></td>
                                    </tr>
                                    @php
                                        $jarak += 1;
                                    @endphp
                                @endif
                            @endif
                            <tr>
                                <td></td>
                                <td></td>

                                <td>
                                    <a style="text-decoration: none;font-weight: bold; color: black"
                                        href="{{ route('groupAnggaran.edit', $groupAnggaran->id) }}">{{ $groupAnggaran->nama_group }}</a>
                                </td>
                                <td style="text-align: right">
                                    @php
                                        $hargaSatuan = 0;
                                    @endphp
                                    @if ($groupAnggaran->tipe_belanja == 'Bahan Bakar Minyak' || $groupAnggaran->tipe_belanja == 'Pelumas Mesin')
                                        {{ $hargaSatuan = $groupAnggaran->kendaraans->count() }} Unit
                                    @endif
                                </td>
                                <td style="text-align: right">
                                    @if ($groupAnggaran->anggaran_total != 0)
                                        Rp {{ number_format($groupAnggaran->anggaran_total, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align:
                                    right" class="color-1">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->januari, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right" class="color-1">Rp
                                    {{ number_format($belanjaJanuari, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right" class="color-1">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->januari - $belanjaJanuari, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right" class="color-2">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->februari, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right" class="color-2">
                                    @if ($febsilpa != 0)
                                        Rp {{ number_format($febsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-2">Rp
                                    {{ number_format($belanjaFebruari, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right" class="color-2">Rp
                                    @if ($febsilpa != 0)
                                        {{ number_format($febsilpa - $belanjaFebruari, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->februari - $belanjaFebruari, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-3">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->maret, 0, ',', '.') }}</td>
                                <td style="text-align: right" class="color-3">
                                    @if ($maretsilpa != 0)
                                        Rp {{ number_format($maretsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-3">Rp
                                    {{ number_format($belanjaMaret, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right" class="color-3">Rp
                                    @if ($maretsilpa != 0)
                                        {{ number_format($maretsilpa - $belanjaMaret, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->maret - $belanjaMaret, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-4">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->april, 0, ',', '.') }}</td>
                                <td style="text-align: right" class="color-4">
                                    @if ($aprilsilpa != 0)
                                        Rp {{ number_format($aprilsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-4">Rp
                                    {{ number_format($belanjaApril, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right" class="color-4">Rp
                                    @if ($aprilsilpa != 0)
                                        {{ number_format($aprilsilpa - $belanjaApril, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->april - $belanjaApril, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-5">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->mei, 0, ',', '.') }}</td>
                                <td style="text-align: right" class="color-5">
                                    @if ($meisilpa != 0)
                                        Rp {{ number_format($meisilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-5">Rp
                                    {{ number_format($belanjaMei, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right" class="color-5">Rp
                                    @if ($meisilpa != 0)
                                        {{ number_format($meisilpa - $belanjaMei, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->mei - $belanjaMei, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-6">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->juni, 0, ',', '.') }}</td>
                                <td style="text-align: right" class="color-6">
                                    @if ($junisilpa != 0)
                                        Rp {{ number_format($junisilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-6">Rp
                                    {{ number_format($belanjaJuni, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right" class="color-6">Rp
                                    @if ($junisilpa != 0)
                                        {{ number_format($junisilpa - $belanjaJuni, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->juni - $belanjaJuni, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-7">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->juli, 0, ',', '.') }}</td>
                                <td style="text-align: right" class="color-7">
                                    @if ($julisilpa != 0)
                                        Rp {{ number_format($julisilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-7">Rp
                                    {{ number_format($belanjaJuli, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right" class="color-7">Rp
                                    @if ($julisilpa != 0)
                                        {{ number_format($julisilpa - $belanjaJuli, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->juli - $belanjaJuli, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-8">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->agustus, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right" class="color-8">
                                    @if ($agusilpa != 0)
                                        Rp {{ number_format($agusilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-8">Rp
                                    {{ number_format($belanjaAgustus, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right" class="color-8">Rp
                                    @if ($agusilpa != 0)
                                        {{ number_format($agusilpa - $belanjaAgustus, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->agustus - $belanjaAgustus, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-9">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->september, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right" class="color-9">
                                    @if ($sepsilpa != 0)
                                        Rp {{ number_format($sepsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-9">Rp
                                    {{ number_format($belanjaSeptember, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right" class="color-9">Rp
                                    @if ($sepsilpa != 0)
                                        {{ number_format($sepsilpa - $belanjaSeptember, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->september - $belanjaSeptember, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-10">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->oktober, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right" class="color-10">
                                    @if ($oktsilpa != 0)
                                        Rp {{ number_format($oktsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-10">Rp
                                    {{ number_format($belanjaOktober, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right" class="color-10">Rp
                                    @if ($oktsilpa != 0)
                                        {{ number_format($oktsilpa - $belanjaOktober, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->oktober - $belanjaOktober, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-11">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->november, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right" class="color-11">
                                    @if ($novsilpa != 0)
                                        Rp {{ number_format($novsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-11">Rp
                                    {{ number_format($belanjaNovember, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right" class="color-11">Rp
                                    @if ($novsilpa != 0)
                                        {{ number_format($novsilpa - $belanjaNovember, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->november - $belanjaNovember, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-12">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->desember, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right" class="color-12">
                                    @if ($dessilpa != 0)
                                        Rp {{ number_format($dessilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right" class="color-12">Rp
                                    {{ number_format($belanjaDesember, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right" class="color-12">Rp
                                    @if ($dessilpa != 0)
                                        {{ number_format($dessilpa - $belanjaDesember, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->desember - $belanjaDesember, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">
                                    Rp
                                    @if ($dessilpa != 0)
                                        {{ number_format($dessilpa - $belanjaDesember, 0, ',', '.') }}
                                    @else
                                        {{ number_format($groupAnggaran->anggaranPerbulan->desember - $belanjaDesember, 0, ',', '.') }}
                                    @endif
                                </td>
                            </tr>
                            @php
                                $months = [
                                    '01' => 'Jan',
                                    '02' => 'Feb',
                                    '03' => 'Mar',
                                    '04' => 'Apr',
                                    '05' => 'Mei',
                                    '06' => 'Jun',
                                    '07' => 'Jul',
                                    '08' => 'Agu',
                                    '09' => 'Sep',
                                    '10' => 'Okt',
                                    '11' => 'Nov',
                                    '12' => 'Des',
                                ];
                            @endphp

                            @foreach ($groupAnggaran->stokSukuCadang as $stokSukuCadang)
                                @php
                                    $stokAwal = $stokSukuCadang->stok_awal;
                                    $belanjaSukuCadang = [];
                                    foreach ($months as $month => $abbr) {
                                        $belanjaSukuCadang[$abbr] = $stokSukuCadang->sukuCadangs
                                            ->whereBetween('tanggal_belanja', ["$tahun-$month-01", "$tahun-$month-31"])
                                            ->sum('jumlah');
                                    }
                                @endphp
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $stokSukuCadang->nama_suku_cadang }}</td>
                                    <td style="text-align: right">{{ $stokAwal }}</td>
                                    <td style="text-align: right">
                                        Rp {{ number_format($stokAwal * $stokSukuCadang->harga, 0, ',', '.') }}
                                    </td>
                                    @php
                                        $colorNum = 0;
                                    @endphp
                                    <td style="text-align: right" class="color-{{ $colorNum + 1 }}">
                                        {{ $stokAwal }}</td>
                                    @foreach ($months as $index => $abbr)
                                        <td style="text-align: right" class="color-{{ $colorNum + 1 }}">
                                            {{ $belanjaSukuCadang[$abbr] }}
                                        </td>
                                        <td style="text-align: right" class="color-{{ $colorNum + 1 }}">
                                            {{ $stokAwal -= $belanjaSukuCadang[$abbr] }}
                                        </td>
                                        <td style="text-align: right" class="color-{{ $colorNum + 2 }}">
                                            {{ $stokAwal }}</td>
                                        <td class="color-{{ $colorNum + 2 }}"></td>
                                        @php
                                            $colorNum += 1;
                                        @endphp
                                    @endforeach
                                </tr>
                            @endforeach
                            @if ($groupAnggaran->tipe_belanja == 'Suku Cadang')
                                <tr>
                                    <td></td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="footer">
            <div style="width: 100%">
                <div style="width: 35%; float: left; text-align: center">
                    <p>Mengetahui,</p>
                    <p>Pengguna Anggaran</p>
                    <br><br><br>
                    <p><u>(MARSE HENDRA SAPUTRA. S.STP)</u></p>
                    <p>NIP: 198103101999121001</p>
                </div>
                <div style="width: 30%"></div>
                <div style="width: 35%; float: right; text-align: center">
                    <p>Bogor, &nbsp;&nbsp;&nbsp;&nbsp;{{ now()->translatedformat('F Y') }}</p>
                    <p>Pejabat Pelaksana Teknis Kegiatan</p>
                    <br><br><br>
                    <p><U>( FIRZA FIRANI RIZAL, S.Kom.,M.Ak. )</U></p>
                    <p>NIP: 197509152010012008</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
