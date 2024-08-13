@extends('layout.layout')
@section('judul')
    Pembayaran
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h4 class="card-title">Daftar Penghuni Ruang</h4>
                        </div>
                        <div class="card-body">

                            <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>NIK</th>
                                        <th>Nama Penghuni</th>
                                        <th>Ruang</th>
                                        <th>Gedung</th>
                                        <th>Opsi</th>
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
@section('jscript')
<script src="{{ asset("assets/script/app/Pembayaran/index.js") }}" type="module"></script>
<script> 
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      
    });
  </script>
@endsection