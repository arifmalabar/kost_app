<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Excel</title>
</head>
<body>
    <table border="1" style="margin: 20px; border-collapse: collapse">
        <thead>
            <tr>
                <td colspan="5">Nama Gedung: {{ $data_gedung->nama_gedung }}</td>
            </tr>
            <tr>
                <td colspan="5">Alamat: {{ $data_gedung->alamat_gedung }}</td>
            </tr>
            <tr>
                <td>No</td>
                <td>NIK</td>
                <td>Nama</td>
                <td>Ruangan</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1?>
            @foreach ($data_penghuni as $it)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $it->NIK }}</td>
                    <td>{{ $it->nama }}</td>
                    <td>{{ $it->nama_ruang }}</td>
                    <td>{{ $it->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>