@extends('layout.layout')
@section('judul')
    Grafik Penghuni
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Grafik Penghuni Setiap Gedung</h3>
                            <div class="card-tools">
                                <!--<button class="btn btn-success btn-sm"><i class="fa fa-sort"></i>Sorting</button>-->
                            </div>  
                        </div>
                        <div class="card-body">
                            <canvas id="stackedBarChart" style="min-height: 350px; height: 350px; max-height: 350px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Data Penghuni Setiap Gedung</h3>
                            <div class="card-tools">
                                <!--<button class="btn btn-success btn-sm"><i class="fa fa-sort"></i>Sorting</button>-->
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gedung</th>
                                        <th>Total Kamar</th>
                                        <th>Kamar Kosong</th>
                                        <th>Total Penghuni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
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
    <script src="{{ asset('assets/script/app/grafik_penghuni/index.js') }}" type="module"></script>
@endsection