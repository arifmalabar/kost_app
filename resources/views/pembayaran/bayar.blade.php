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
                                    <p class="view-nik">undefined</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Nama:</label>
                                    <p class="view-nama">undefined</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Gedung</label>
                                    <p class="view-gedung">undefined</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Ruangan</label>
                                    <p class="view-ruang">undefined</p>
                                </div>
                                <div class="col-md-12">
                                    <label>Total Tagihan</label>
                                    <p class="view-tagihan" style="color:red;"></p>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <br>
                                    <a href="" class="btn btn-outline-warning btn-sm" style="width: 100%"><i class="fa fa-edit"></i>Ubah Akun</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"><br><h4>Bayar Tagihan</h4></div>
                        <input type="hidden" class="csrf" value="{{ csrf_token() }}">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Tahun</label>
                                <div class="col-sm-8">
                                    <select name="" id="" class="form-control field-tahun select2">
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Bulan</label>
                                <div class="col-sm-8">
                                    <select name="" id="" class="form-control field-bulan">
                                        <option value="01">Januari(Sdh Bayar)</option>
                                        <option value="02">Februari(Sdh Bayar)</option>
                                        <option value="03">Maret(Sdh Bayar)</option>
                                        <option value="04">April(Sdh Bayar)</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">Nopember</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Total Bayar</label>
                                <div class="col-sm-8">
                                  <input type="number" class="form-control field-total" id="" placeholder="Masukan Total Bayar">
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
                            <button class="btn btn-success pull-right btn-proses"  style="justify-content: right">Bayar</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Riwayat Pembayaran</h4>
                        </div>
                        <div class="col-md-12">
                            <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nominal Bayar</th>
                                        <th>Sisa Bayar</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Tanggal Tagihan</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--<tr>
                                        <td>1</td>
                                        <td>Rp 650.000</td>
                                        <td>Rp 0</td>
                                        <td>Sat 12 Dec 2022</td>
                                        <td><center><span class="badge badge-success">Lunas</span></center></td>
                                        <td><center><a href="" class="btn btn-primary btn-sm"><i class="fa fa-print"></i>&nbsp;Cetak Struk</a></center></td>
                                    </tr>-->
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
    <script src="{{ asset('assets/script/app/bayar/index.js') }}" type="module"></script>
@endsection
@section('jscript')
<script>
    $(function () {
        $('.select2').select2()
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection