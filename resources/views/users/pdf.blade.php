<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }
    </style>
</head>

<body>
    <h2>Data Pengguna</h2>
    <table>
        <tr>
            <th>NIK</th>
            <td>{{ $user->nik }}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>{{ $user->nama }}</td>
        </tr>
        <tr>
            <th>Tempat, Tanggal Lahir</th>
            <td>{{ $user->tempat_lahir }}, {{ $user->tanggal_lahir }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>{{ $user->jenis_kelamin }}</td>
        </tr>
        <tr>
            <th>Agama</th>
            <td>{{ $user->agama }}</td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $user->alamat }}</td>
        </tr>
        <tr>
            <th>Hobi</th>
            <td>{{ implode(', ', json_decode($user->hobi, true) ?? []) }}</td>
        </tr>
    </table>

    @if($user->photo)
        <h3>Foto Pengguna:</h3>
        <img src="{{ public_path('storage/' . $user->photo) }}" style="width: 150px; height: auto;">
    @endif
</body>

</html>