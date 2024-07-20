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
            width: 100%;
            margin: auto;
            padding: auto;
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
            text-align: center;
        }

        .data-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="header">
            <h1>Data Permohonan KTP</h1>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>NKK</th>
                    <th>Nama</th>
                    <th>Jenis Permohonan</th>
                    <th>Tanggal Permohonan</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0 @endphp
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $no += 1 }} </td>
                        <td>{{ $data->nik }}</td>
                        <td>{{ $data->nkk }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->jenis_permohonan }}</td>
                        <td>{{ $data->created_at }}</td>
                        <td>{{ $data->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p>&copy; Data Permohonan KTP</p>
        </div>
    </div>
</body>

</html>
