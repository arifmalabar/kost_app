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
                    <div class="col-md-12">
                        <h4>Data Penghuni Ruangan</h4>
                    </div>

                    <div class="col-md-12">
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
                                <a href="" class="btn btn-outline-warning btn-sm btn-edit" style="width: 100%"><i
                                        class="fa fa-edit"></i>Ubah Akun</a>
                            </div>
                        </div>
                    </div>
                    <!--<div class="container-bayar" style="display: none;">
                            <div class="col-md-12"><br><h4>Bayar Tagihan</h4></div>
                            
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Tahun</label>
                                    <div class="col-sm-8">
                                        <input disabled type="number" name="" id="" placeholder="Tahun" class="form-control field-tahun">
                                        <select name="" id="" class="form-control field-tahun select2bs4">
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Bulan</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" name="" id="" placeholder="Bulan" class="form-control field-bulan">
                                        <select name="" id="" class="form-control field-bulan">
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
                                        <p style="position: absolute; top:10px; left: 20px;">Rp.</p>
                                        <input type="number" style="text-align: right" class="form-control field-total" id="" placeholder="0" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Metode Pembayaran</label>
                                    <div class="col-sm-8">
                                    <input type="radio" name="transfer"  id="transfer"> <label for="transfer">Transfer/Non Tunai/Jenis Lain</label>&nbsp;
                                    <input type="radio" name="transfer" checked  id="tunai"> <label for="tunai">Tunai</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 input-bukti" style="display: none">
                                <div class="form-group row" >
                                    <label for="inputEmail3" class="col-sm-4 col-form-label">Bukti Transfer</label>
                                    <div class="col-sm-8">
                                    <input type="file" class="form-control field-bukti" id="">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <button class="btn btn-success pull-left btn-proses">Bayar</button>
                            </div>
                        </div>-->
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <h4>Riwayat Pembayaran</h4>
                    </div>
                    <div class="col-md-12">
                        <div class="position-absolute" style="z-index: 10; width: 100%">
                            <select name="" id="sort-tahun" title="Pilih"
                                class="form-control select2bs4 col-md-3">
                                <option value="0" hidden selected>Pilih Tahun</option>
                            </select>
                        </div>
                        <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nominal Bayar</th>
                                    <th>Sisa Bayar</th>
                                    <th>Tanggal Buat Tagihan</th>
                                    <th>Tenggat Bayar Tagihan</th>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Bayar Tagihan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Tahun Tagihan</label>
                                <input disabled type="number" name="" id="" class="form-control field-tahun-modal"
                                    placeholder="Tahun Tagihan">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Bulan Tagihan</label>
                                <input disabled="text" name="" id="" class="form-control field-bulan-modal"
                                    placeholder="Bulan Tagihan">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Tagihan</label>
                                <input type="text" name="" id="" value="" class="form-control field-tagihan-modal"
                                    placeholder="Tagihan">
                                <input type="hidden" name="" class="csrf_modal" value="{{ csrf_token() }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger text-white" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success btn-proses">Proses</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</section>
@endsection
@section('js')
<script src="{{ asset('assets/script/app/bayar/index.js') }}" type="module"></script>
@endsection
@section('jscript')
<script>
    $(function () {
        $('.select2').select2();
        $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection