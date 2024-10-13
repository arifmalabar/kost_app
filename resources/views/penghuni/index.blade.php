@extends('layout.layout')
@section('css')
    <style>
        sup {
            color: red;
        }
    </style>
@endsection
@section('judul')
    Setting Gedung
@endsection
@section('content')
    <h1>Data Penghuni</h1>
    <table>
        <thead>
            <tr>
                <th>NIK</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Alamat</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach($penghuni as $huni)
                <tr>
                    <td>{{ $huni->NIK }}</td>
                    <td>{{ $huni->nama }}</td>
                    <td>{{ $huni->email }}</td>
                    <td>{{ $huni->no_telp }}</td>
                    <td>{{ $huni->alamat }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
