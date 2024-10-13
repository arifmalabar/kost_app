@extends('layout.layout')
@section('status')
    active
@endsection
@section('judul')
    Laporan Pendapatan
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Pendapatan Gedung {{ $detail_gedung->nama_gedung }}</h3>
                            <a href="/cetak_laporan_gedung/{{$detail_gedung->kode_gedung}}" style="position:absolute; right: 5px;" class="btn btn-success btn-sm"><i class="fa fa-print"></i>&nbsp;Cetak Laporan</a>
                        </div>
                        <div class="card-body">
                            <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                                <thead>
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
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $(function () {
          $("#example2").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          
        });
      </script>
@endsection