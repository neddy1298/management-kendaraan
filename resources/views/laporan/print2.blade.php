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
        <div class="header print-only">
            <h4>PEMERINTAHAN KOTA BOGOR<br>KARTU KENDALI KEGIATAN<br>TAHUN ANGGARAN {{ $tahun }}</h4>
            <table class="header-table">
                <tr>
                    <td>Sub Unit</td>
                    <td style="font-weight: 400">: DINAS PERHUBUNGAN KOTA BOGOR</td>
                </tr>
                <tr>
                    <td>Nama Program</td>
                    <td style="font-weight: 400">: PROGRAM PENUNJANG URUSAN PEMERINTAHAN DAERAH KABUPATEN/KOTA</td>
                </tr>
                <tr>
                    <td>Nama Kegiatan</td>
                    <td style="font-weight: 400">: Pemeliharaan Barang Milik Daerah Penunjang Urusan Pemerintahan
                        Daerah</td>
                </tr>
                <tr>
                    <td>Sub Kegiatan</td>
                    <td style="font-weight: 400">: Penyediaan Jasa Pemeliharaan, Biaya Pemeliharaan, Pajak, dan
                        Perizinan Kendaraan Dinas
                        Operasional atau Lapangan</td>
                </tr>
                <tr>
                    <td>Nama PPTK</td>
                    <td style="font-weight: 400">: Firza Firani Rizal, S.Kom, M.Ak.</td>
                </tr>
                <tr>
                    <td>Bulan</td>
                    <td style="font-weight: 400">: {{ $endDate->translatedformat('F Y') }}</td>
                </tr>
            </table>
        </div>

        <table id="data-table" class="data-table">
            <thead>
                <tr>
                    <th style="width: 15px" rowspan="2">No Urut</th>
                    <th style="width: 90px" rowspan="2">Kode Rekening</th>
                    <th style="width: 300px" rowspan="2">Nama Rekening</th>
                    <th style="width: 200px" rowspan="2">Jumlah</th>
                    <th style="width: 300px" colspan="3">Januari</th>
                    <th style="width: 300px" colspan="3">Februari</th>
                    <th style="width: 300px" colspan="3">Maret</th>
                    <th style="width: 300px" colspan="3">April</th>
                    <th style="width: 300px" colspan="3">Mei</th>
                    <th style="width: 300px" colspan="3">Juni</th>
                    <th style="width: 300px" colspan="3">Juli</th>
                    <th style="width: 300px" colspan="3">Agustus</th>
                    <th style="width: 300px" colspan="3">September</th>
                    <th style="width: 300px" colspan="3">Oktober</th>
                    <th style="width: 300px" colspan="3">November</th>
                    <th style="width: 300px" colspan="3">Desember</th>
                </tr>
                <tr>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
                    <td style="width: 100px; text-align: center">SPJ</td>
                    <td style="width: 100px; text-align: center">Silpa</td>
                    <td style="width: 100px; text-align: center">Anggaran Kas</td>
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
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->maret, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->april, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->mei, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->juni, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->juli, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->agustus, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->september, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->oktober, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->november, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right">Rp
                                {{ number_format($paguAnggaran->anggaranPerbulan->desember, 0, ',', '.') }}</td>
                            <td></td>
                            <td></td>
                        </tr>
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

                            @endphp
                            <tr>
                                <td></td>
                                <td></td>
                                <td>{{ $groupAnggaran->nama_group }}</td>
                                <td style="text-align: right">
                                    @if ($groupAnggaran->anggaran_total != 0)
                                        Rp {{ number_format($groupAnggaran->anggaran_total, 0, ',', '.') }}
                                    @endif
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->januari, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaJanuari, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->januari - $belanjaJanuari, 0, ',', '.') }}
                                </td>
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->februari, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaFebruari, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->februari - $belanjaFebruari, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->maret, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaMaret, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->maret - $belanjaMaret, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->april, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaApril, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->april - $belanjaApril, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->mei, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaMei, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->mei - $belanjaMei, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->juni, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaJuni, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->juni - $belanjaJuni, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->juli, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaJuli, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->juli - $belanjaJuli, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->agustus, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaAgustus, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->agustus - $belanjaAgustus, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->september, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaSeptember, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->september - $belanjaSeptember, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->oktober, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaOktober, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->oktober - $belanjaOktober, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->november, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaNovember, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->november - $belanjaNovember, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right">Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->desember, 0, ',', '.') }}</td>
                                <td style="text-align: right">Rp
                                    {{ number_format($belanjaDesember, 0, ',', '.') }}</td>
                                </td>
                                <td>Rp
                                    {{ number_format($groupAnggaran->anggaranPerbulan->desember - $belanjaDesember, 0, ',', '.') }}
                                </td>
                            </tr>
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
