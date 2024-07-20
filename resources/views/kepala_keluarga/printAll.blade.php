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
            <h1>Data Kartu Keluarga</h1>
        </div>
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NKK</th>
                    <th>Nama</th>
                    <th>RT/RW</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0 @endphp
                @foreach ($datas as $data)
                    <tr>
                        <td>{{ $no += 1 }} </td>
                        <td>{{ $data->nkk }}</td>
                        <td>{{ $data->nama_kepala_keluarga }}</td>
                        <td>{{ $data->rt }}/{{ $data->rw }}</td>
                        <td>{{ $data->alamat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p>&copy; Data Kartu Keluarga</p>
        </div>
    </div>
</body>

</html>
