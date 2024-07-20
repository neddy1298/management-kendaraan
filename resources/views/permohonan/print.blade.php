<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Print</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
        }

        .header,
        .footer {
            text-align: center;
            margin-bottom: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .data-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Permohonan KTP</h1>
        </div>
        <table class="data-table">
            <tr>
                <th>NIK</th>
                <th>NKK</th>
                <th>Nama</th>
                <th>Jenis Permohonan</th>
                <th>Tanggal Permohonan</th>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td>{{ $data->nik }}</td>
                <td>{{ $data->nkk }}</td>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->jenis_permohonan }}</td>
                <td>{{ $data->created_at }}</td>
                <td>{{ $data->keterangan }}</td>
            </tr>
        </table>
        <div class="footer">
            <p>&copy; 2024 Permohonan KTP</p>
        </div>
    </div>
</body>

</html>
