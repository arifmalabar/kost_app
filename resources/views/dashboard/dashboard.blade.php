@extends('layout/layout')
@section('status')
    active
@endsection
@section('judul')
    Dashboard
@endsection
@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Penghuni Kost</span>
                            <span class="info-box-number jml-penghuni">0</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Rumah Kost</span>
                            <span class="info-box-number jml-rumahkost">0</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Kamar Kost</span>
                            <span class="info-box-number jml-kamarkost">0</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <!-- Info Boxes Style 2 -->
                    <div class="info-box mb-3 bg-purple">
                        <span class="info-box-icon"><i class="fas fa-tag"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Hutang</span>
                            <span class="info-box-number jml-cicilan">Rp 4.5000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-success">
                        <span class="info-box-icon"><i class="far fa-heart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Lunas</span>
                            <span class="info-box-number jml-lunas">Rp 109.000.000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                    <div class="info-box mb-3 bg-danger">
                        <span class="info-box-icon"><i class="fas fa-cloud-download-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sisa Bayar</span>
                            <span class="info-box-number jml-sisa">Rp 9.000.000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">
                            <h4 class="card-title">Grafik Terhutang Dan Terbayar</h4>
                            <div class="card-tools">
                                <!--<button class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#modalShortingHutang"><i class="fa fa-sort"></i>&nbsp;Shorting</button>
                                <button class="btn btn-primary btn-sm" style="color: white"><i
                                        class="fa fa-retweet"></i>&nbsp;Refresh</button>-->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="barChart"
                                    style="min-height: 200px; height: 180px; max-height: 250px; max-width: 100%; display: block;"
                                    width="467" height="275" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-users"></i>&nbsp;Penghuni Baru</h3>
                            <div class="card-tools">
                                <!--<button class="btn btn-success btn-sm"><i class="fa fa-sort"></i>&nbsp;Shorting</button>-->
                            </div>
                        </div>
                        <div class="card-body" style="height: 280px; overflow : auto">
                            <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Gedung</th>
                                        <th>Kamar</th>
                                        <th>Tgl Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-signal"></i>&nbsp;Ketersediaan Kamar</h3>
                            <div class="card-tools">
                                <!--<button class="btn btn-success btn-sm"><i class="fa fa-sort"></i>&nbsp;Shorting</button>-->
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="donutChart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalShortingHutang" tabindex="-1" aria-labelledby="modalShortingHutangLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalShortingHutangLabel">Pilih Bulan dan Tahun</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="formShorting">
                            <div class="form-group">
                                <label for="bulan">Bulan :</label>
                                <select class="form-control field-bulan" id="bulan" name="bulan">
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun :</label>
                                <input type="number" class="form-control field-tahun" id="tahun" name="tahun"
                                    placeholder="Masukkan tahun">
                                    <input type="hidden" value="{{ csrf_token() }}" class="field-token">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn-submit" id="submitShortingHutang">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('assets/script/app/dashboard/index.js') }}" type="module"></script>
@endsection
