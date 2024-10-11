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
                            <h3 class="card-title">Grafik Pendapatan</h3>
                            <button style="position:absolute; right: 5px;" class="btn btn-success btn-sm"><i class="fa fa-sort"></i>&nbsp;Shorting</button>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Pendapatan</h3>
                            <button style="position:absolute; right: 5px;" class="btn btn-success btn-sm"><i class="fa fa-sort"></i>&nbsp;Shorting</button>
                        </div>
                        <div class="card-body">
                            <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Bulan</th>
                                        <th>Tahun</th>
                                        <th>Pendapatan Seharusnya</th>
                                        <th>Pendapatan Saat Ini</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Pendapatan</h3>
                            <button style="position:absolute; right: 5px;" class="btn btn-success btn-sm"><i class="fa fa-sort"></i>&nbsp;Shorting</button>
                        </div>
                        <div class="card-body">
                            <table id="example1" style="text-align: center" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gedung</th>
                                        <th>Pendapatan</th>
                                        <th>Pendapatan Seharusnya</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody id="data-pendapatan-gedung">
                                    
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
    <script src="{{ mix('js/laporan_pendapatan.js') }}"></script>
    <script src="{{ asset('assets/script/app/Pendapatan/index.js') }}" type="module"></script>
    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true, "lengthChange": true, "autoWidth": false,
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          
        });
      </script>
@endsection