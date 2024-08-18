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
                            <div class="position-absolute" style="z-index: 10; width: 100%">
                                <select name="" id="sort-gedung" title="Pilih" class="form-control select2bs4 col-md-3">
                                    <option value="0" hidden selected>Pilih Gedung</option>
                                </select>
                                
                            </div>
                            <button class="position-absolute btn btn-success button-sort" style="z-index: 10; left: 325px">Sorting</button>
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