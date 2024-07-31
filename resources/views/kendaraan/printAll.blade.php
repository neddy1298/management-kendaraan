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
        margin: auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .header,
    .footer {
        text-align: center;
        padding: 15px;
        background-color: #3d6df2;
        color: #fff;
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
        margin-bottom: 20px;
    }

    .data-table th,
    .data-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }

    .data-table th {
        background-color: #3d6df2;
        color: #fff;
        font-weight: bold;
    }

    .data-table td {
        background-color: #fff;
    }

    .data-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .data-table tr:hover {
        background-color: #f1f1f1;
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
                    <th>Jenis Kendaraan</th>
                    <th>CC Kendaraan</th>
                    <th>BBM Kendaraan</th>
                    <th>Roda Kendaraan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }} </td>
                        <td>{{ $data->nomor_registrasi }}</td>
                        <td>{{ $data->merk_kendaraan }}</td>
                        <td>{{ $data->jenis_kendaraan }}</td>
                        <td>{{ $data->cc_kendaraan }} CC</td>
                        <td>{{ $data->bbm_kendaraan }}</td>
                        <td>{{ $data->roda_kendaraan }}</td>
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
