@extends('layout.layout')
@section('css')
    <style>
        sup {
            color: red;
        }
    </style>
@endsection
@section('judul')
    Tagihan
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="card-title">Tagihan Pembayaran Kost Bulan Ini</h4>
                    <div class="card-tools">
                        <a href="#" data-toggle="modal" data-target="#modal-lg" class="btn btn-info text-white btn-sm"><i
                            class="fa fa-plus"></i>&nbsp; Generate Tagihan</a>
                             <!-- Modal -->
                             <button class="btn btn-success btn-sm" data-toggle="modal"
                             data-target="#modalShortingHutang"><i class="fa fa-sort"></i>&nbsp;Shorting</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-absolute" style="z-index: 10; width: 100%">
                                <select name="" id="sort-gedung" title="Pilih" class="form-control select2bs4 col-md-3">
                                    <option value="0" hidden selected>Pilih Gedung</option>
                                </select>
                               
                                
                            </div>
                            <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Buat Tagihan</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Tahun <sup>*</sup></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                      </div>
                                                    <input type="number" placeholder="Masukan Tahun" name="field-tahun" id="field-tahun" class="form-control">
                                                      <input type="hidden" name="" id="csrf" value="{{ csrf_token() }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Bulan <sup>*</sup></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                    </div>
                                                    <select name="" id="field-bulan" class="form-control">
                                                        <option value="">Pilih Bulan</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Gedung <sup>*</sup></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                    </div>
                                                    <select name="" id="field-gedung" class="form-control">
                                                        <option value="">Pilih Gedung</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-success btn-buattagihan"><i class="fa fa-plus"></i>&nbsp;Buat Tagihan</button>
                                    </div>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                              <!-- /.modal -->
                            <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Penghuni</th>
                                        <th>Gedung</th>
                                        <th>Ruang</th>
                                        <th>Tanggal Tagihan</th>
                                        <th>Total Tagihan</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--<tr>
                                        <td>1</td>
                                        <td>Zaidan S</td>
                                        <td>Gedung1</td>
                                        <td>G1 01</td>
                                        <td>Rp 1.000.000</td>
                                        <td>
                                            <center>
                                                <a href="/bayar" class="btn btn-outline-info btn-sm"><i
                                                        class="fas fa-dollar-sign"></i>&nbsp;Bayar</a>
                                                <a href="https://wa.me/+6283192962102?text=*Pembayaran Kost A.N Ridho Belum Lunas* Segera lunasi pembayaran"
                                                    class="btn btn-sm btn-outline-success"><i class="fa fa-phone"></i>
                                                    Hubungi</a>
                                            </center>
                                        </td>
                                    </tr>-->
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                                            <input type="text" value="{{ date('Y') }}" class="form-control field-tahun" id="tahun" name="tahun"
                                                placeholder="Masukkan tahun">
                                                <input type="hidden" value="{{ csrf_token() }}" class="field-token">
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary btn-sorting" data-dismiss="modal" id="submitShortingHutang">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('assets/script/app/tagihan/index.js') }}" type="module"></script>
@endsection
@section('jscript')
    
    <script>
        
        $(function() {
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            
        });
    </script>
@endsection
