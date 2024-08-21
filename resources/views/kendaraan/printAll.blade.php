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
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .data-table th, .data-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .data-table th {
            background-color: #f2f2f2;
        }
        .data-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .data-table tr:hover {
            background-color: #f1f1f1;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer p {
            margin: 0;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Data Kendaraan</h1>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor Registrasi</th>
                    <th>Merk Kendaraan</th>
                    <th>Jenis Kendaran</th>
                    <th>CC Kendaraan</th>
                    <th>Jenis BBM</th>
                    <th>Roda</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kendaraans as $index => $kendaraan)
                    <tr>
                        <td>{{ $index + 1 }} </td>
                        <td>{{ $kendaraan->nomor_registrasi }}</td>
                        <td>{{ $kendaraan->merk_kendaraan }}</td>
                        <td>{{ $kendaraan->jenis_kendaraan }}</td>
                        <td>{{ $kendaraan->cc_kendaraan }}</td>
                        <td>{{ $kendaraan->bbm_kendaraan }}</td>
                        <td>{{ $kendaraan->roda_kendaraan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p>&copy; Data Kendaraan Dishub Kota Bogor</p>
        </div>
    </div>
</body>

</html>
