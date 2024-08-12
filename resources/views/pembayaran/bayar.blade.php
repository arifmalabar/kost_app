@extends('layout.layout')
@section('judul')
    Bayar
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Formulir Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12"><h4>Data Penghuni Ruangan</h4></div>
                        <div class="col-md-5">
                            <label>Foto KTP/Identitas Lain</label>
                            <img src="https://www.jitoe.com/wp-content/uploads/2022/10/KTP-Hilang-atau-Ingin-Ubah-Data-akan-Dirujuk-Buat-KTP-Digital.png" width="400px" height="280px" alt="KTP" srcset="">
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>NIK:</label>
                                    <p>{{$data->NIK}}</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Nama:</label>
                                    <p>{{ $data ->nama }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Gedung</label>
                                    <p>{{ $data->ruangan->gedung->nama_gedung }}</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Ruangan</label>
                                    <p>{{ $data->ruangan->nama_ruang }}</p>
                                </div>
                                <div class="col-md-12">
                                    <label>Total Tagihan</label>
                                    <p style="color:red;"><b>Rp {{ number_format($data->harga, 2, ',', '.') }}-</b> </p>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <br>
                                    <a href="" class="btn btn-outline-warning btn-sm" style="width: 100%"><i class="fa fa-edit"></i>Ubah Akun</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"><br><h4>Bayar Tagihan</h4></div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Tahun</label>
                                <div class="col-sm-8">
                                    <select name="" id="" class="form-control">
                                        <option value="2022">2022</option>
                                        <option value="2021">2021 (Lunas)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Bulan</label>
                                <div class="col-sm-8">
                                    <select name="" id="" class="form-control">
                                        <option value="1">Januari(Sdh Bayar)</option>
                                        <option value="2">Februari(Sdh Bayar)</option>
                                        <option value="3">Maret(Sdh Bayar)</option>
                                        <option value="4">April(Sdh Bayar)</option>
                                        <option value="5">Mei</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Total Bayar</label>
                                <div class="col-sm-8">
                                  <input type="number" class="form-control" id="" placeholder="Masukan Total Bayar">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Metode Pembayaran</label>
                                <div class="col-sm-8">
                                  <input type="radio" name="transfer"  id="transfer"> <label for="transfer">Transfer/Non Tunai/Jenis Lain</label>&nbsp;
                                  <input type="radio" name="transfer"  id="tunai"> <label for="tunai">Tunai</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 input-bukti">
                            
                        </div>
                        <div class="col-md-11">
                            <button class="btn btn-danger" style="position: absolute; right: 1px">Batal</button>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-success pull-right" style="justify-content: right">Bayar</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Riwayat Pembayaran</h4>
                        </div>
                        <div class="col-md-12">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nominal Bayar</th>
                                        <th>Sisa Bayar</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Rp 650.000</td>
                                        <td>Rp 0</td>
                                        <td>Sat 12 Dec 2022</td>
                                        <td><center><span class="badge badge-success">Lunas</span></center></td>
                                        <td><center><a href="" class="btn btn-primary btn-sm"><i class="fa fa-print"></i>&nbsp;Cetak Struk</a></center></td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-success btn-sm" style="position: absolute; top: 1px"><i class="fa fa-sort"></i> Shorting</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('vendor/script/pembayaran/index.js') }}" type="module"></script>
@endsection
@section('jscript')
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
@endsection