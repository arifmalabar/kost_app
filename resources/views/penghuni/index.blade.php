@extends('layout.layout')
@section('css')
    <style>
        sup {
            color: red;
        }
    </style>
@endsection

@section('judul')
    Data Penghuni
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="card-title">Data Penghuni</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
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
                </div>
            </div>
        </div>
    </section>
@endsection
