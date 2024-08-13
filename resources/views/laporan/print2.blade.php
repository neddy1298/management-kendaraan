<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Print</title>

    <style>
        @media print {
            body {
                width: auto;
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
        <div class="header print-only"><br>
            <h4>RKA BBM DAN PEMELIHARAAN {{ $tahun }} <br><br> Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan,
                Pajak dan Perizinan Kendaraan Dinas Operasional atau
                Lapangan</h4>
        </div>
        <table id="data-table" class="data-table">
            <thead>
                <tr>
                    <th style="width: 15px" rowspan="2">No Urut</th>
                    <th style="width: 90px" rowspan="2">Kode Rekening</th>
                    <th style="width: 300px" rowspan="2">Nama Rekening</th>
                    <th style="width: 50px" rowspan="2">Volume</th>
                    <th style="width: 200px" rowspan="2">Jumlah</th>
                    <th style="width: 300px" colspan="3">Januari</th>
                    <th style="width: 300px" colspan="4">Februari</th>
                    <th style="width: 300px" colspan="4">Maret</th>
                    <th style="width: 300px" colspan="4">April</th>
                    <th style="width: 300px" colspan="4">Mei</th>
                    <th style="width: 300px" colspan="4">Juni</th>
                    <th style="width: 300px" colspan="4">Juli</th>
                    <th style="width: 300px" colspan="4">Agustus</th>
                    <th style="width: 300px" colspan="4">September</th>
                    <th style="width: 300px" colspan="4">Oktober</th>
                    <th style="width: 300px" colspan="4">November</th>
                    <th style="width: 300px" colspan="4">Desember</th>
                </tr>
                <tr>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">Feb+Silpa</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">Mar+Silpa</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">Apr+Silpa</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">Mei+Silpa</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">Jun+Silpa</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">Jul+Silpa</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">Agu+Silpa</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">Sep+Silpa</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">Okt+Silpa</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">Nov+Silpa</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">Des+Silpa</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($paguAnggarans as $index => $paguAnggaran)
                    @foreach ($paguAnggaran->masterAnggarans as $index2 => $masterAnggaran)
                        <tr>
                            <td></td>
                        </tr>
                        <tr class="master-anggaran">
                            <td style="text-align: center">{{ $index2 + 1 }}</td>
                            <td>{{ $masterAnggaran->kode_rekening }}</td>
                            <td style="font-weight: bold">{{ $masterAnggaran->nama_rekening }}</td>
                            <td></td>
                            <td style="text-align: right">
                                @if ($masterAnggaran->anggaran != 0)
                                    Rp {{ number_format($masterAnggaran->anggaran, 0, ',', '.') }}
                                @endif
                            </td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->januari, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->februari, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->maret, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->april, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->mei, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->juni, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->juli, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->agustus, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->september, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->oktober, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->november, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->desember, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
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
                                if ($groupAnggaran->tipe_belanja == 'Bahan Bakar Minyak') {
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
                                    $jansilpa = $groupAnggaran->anggaranPerbulan->januari - $belanjaJanuari;
                                    $febsilpa =
                                        $jansilpa + $groupAnggaran->anggaranPerbulan->februari - $belanjaFebruari;
                                    $maretsilpa = $febsilpa + $groupAnggaran->anggaranPerbulan->maret - $belanjaMaret;
                                    $aprilsilpa = $maretsilpa + $groupAnggaran->anggaranPerbulan->april - $belanjaApril;
                                    $meisilpa = $aprilsilpa + $groupAnggaran->anggaranPerbulan->mei - $belanjaMei;
                                    $junisilpa = $meisilpa + $groupAnggaran->anggaranPerbulan->juni - $belanjaJuni;
                                    $julisilpa = $junisilpa + $groupAnggaran->anggaranPerbulan->juli - $belanjaJuli;
                                    $agusilpa =
                                        $julisilpa + $groupAnggaran->anggaranPerbulan->agustus - $belanjaAgustus;
                                    $sepsilpa =
                                        $agusilpa + $groupAnggaran->anggaranPerbulan->september - $belanjaSeptember;
                                    $oktsilpa = $sepsilpa + $groupAnggaran->anggaranPerbulan->oktober - $belanjaOktober;
                                    $novsilpa =
                                        $oktsilpa + $groupAnggaran->anggaranPerbulan->november - $belanjaNovember;
                                    $dessilpa =
                                        $novsilpa + $groupAnggaran->anggaranPerbulan->desember - $belanjaDesember;
                                }
                            @endphp
                            @if ($groupAnggaran->tipe_belanja == 'Pelumas Mesin')
                                @if ($jarak == 0)
                                    <tr>
                                        <td style="border: none"></td>
                                    </tr>
                                    <tr class="master-anggaran">
                                        <td></td>
                                        <td></td>
                                        <td style="font-weight: bold">Belanja Pelumas Kendaraan Ops Dinas Perhubungan
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
                                    @php
                                        $jarak += 1;
                                    @endphp
                                @endif
                            @endif
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="font-weight: bold">
                                    {{ $groupAnggaran->nama_group }}</td>
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
                                    right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->januari, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaJanuari, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->januari - $belanjaJanuari, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->februari, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">
                                    @if ($febsilpa != 0)
                                        Rp {{ number_format($febsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaFebruari, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->februari - $belanjaFebruari, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->maret, 0, ',', '.') }}</td>
                                <td style="text-align: right">
                                    @if ($maretsilpa != 0)
                                        Rp {{ number_format($maretsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaMaret, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->maret - $belanjaMaret, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->april, 0, ',', '.') }}</td>
                                <td style="text-align: right">
                                    @if ($aprilsilpa != 0)
                                        Rp {{ number_format($aprilsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaApril, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->april - $belanjaApril, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->mei, 0, ',', '.') }}</td>
                                <td style="text-align: right">
                                    @if ($meisilpa != 0)
                                        Rp {{ number_format($meisilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaMei, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->mei - $belanjaMei, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->juni, 0, ',', '.') }}</td>
                                <td style="text-align: right">
                                    @if ($junisilpa != 0)
                                        Rp {{ number_format($junisilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaJuni, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->juni - $belanjaJuni, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->juli, 0, ',', '.') }}</td>
                                <td style="text-align: right">
                                    @if ($julisilpa != 0)
                                        Rp {{ number_format($julisilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaJuli, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->juli - $belanjaJuli, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->agustus, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">
                                    @if ($agusilpa != 0)
                                        Rp {{ number_format($agusilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaAgustus, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->agustus - $belanjaAgustus, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->september, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">
                                    @if ($sepsilpa != 0)
                                        Rp {{ number_format($sepsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaSeptember, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->september - $belanjaSeptember, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->oktober, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">
                                    @if ($oktsilpa != 0)
                                        Rp {{ number_format($oktsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaOktober, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->oktober - $belanjaOktober, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->november, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">
                                    @if ($novsilpa != 0)
                                        Rp {{ number_format($novsilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaNovember, 0, ',', '.') }}</td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->november - $belanjaNovember, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->desember, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">
                                    @if ($dessilpa != 0)
                                        Rp {{ number_format($dessilpa, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaDesember, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->desember - $belanjaDesember, 0, ',', '.') }}
                                </td>
                            </tr>
                            @foreach ($groupAnggaran->stokSukuCadang as $sukuCadang)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $sukuCadang->nama_suku_cadang }}
                                    </td>
                                    <td style="text-align: right">{{ $sukuCadang->stok_awal }}</td>
                                    <td style="text-align: right">
                                        Rp
                                        {{ number_format($sukuCadang->stok_awal * $sukuCadang->harga, 0, ',', '.') }}
                                    <td style="text-align: right">{{ $sukuCadang->stok_awal }}</td>
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
