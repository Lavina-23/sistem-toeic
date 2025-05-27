<!DOCTYPE html>
<html>
<head>
    <title>Data Peserta</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Data Peserta</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>No Induk</th>
                <th>Jurusan</th>
                <th>Program Studi</th>
                <th>Kampus</th>
                <th>No Telp</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peserta as $item)
                <tr>
                    <td>{{ $item->peserta_id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->no_induk }}</td>
                    <td>{{ $item->jurusan }}</td>
                    <td>{{ $item->program_studi }}</td>
                    <td>{{ $item->kampus }}</td>
                    <td>{{ $item->no_telp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
