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
                <td colspan="5">Nama Gedung: {{ $detail_gedung->nama_gedung }}</td>
            </tr>
            <tr>
                <td colspan="5">Alamat: {{ $detail_gedung->alamat_gedung }}</td>
            </tr>
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Pendapatan Seharusnya</th>
                <th>Pendapatan Saat Ini</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no =1;
            @endphp
            @foreach ($pendapatan as $item)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{ $item->bulan }}</td>
                    <td>Rp {{ number_format($item->pendapatan_seharusnya, 2, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->pendapatan_saat_ini, 2, ',', '.') }}
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>