
@extends('layout.layout')
@section('judul')
    Tagihan
@endsection
@section('content')
    <section class="content">
        
        <div class="container-fluid">
            
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="card-title">Tagihan Pembayaran Kost Bulan Ini</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <a href="" class="btn btn-success btn-sm position-absolute" style="top:1px"><i class="fa fa-sort"></i>&nbsp; Shorting</a>
                            <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Penghuni</th>
                                        <th>Gedung</th>
                                        <th>Ruang</th>
                                        <th>Total Tagihan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Zaidan S</td>
                                        <td>Gedung1</td>
                                        <td>G1 01</td>
                                        <td>Rp 1.000.000</td>
                                        <td><center>
                                            <a href="/bayar" class="btn btn-outline-info btn-sm"><i class="fas fa-dollar-sign"></i>&nbsp;Bayar</a>
                                            <a href="https://wa.me/+6283192962102?text=*Pembayaran Kost A.N Ridho Belum Lunas* Segera lunasi pembayaran" class="btn btn-sm btn-outline-success"><i class="fa fa-phone"></i> Hubungi</a>
                                        </center></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
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