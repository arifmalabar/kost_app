@extends('layout.layout')
@section('judul')
    Setting Ruangan
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="card-title">Informasi Ruangan</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-sm position-absolute" style="z-index: 10;" data-toggle="modal"
                                data-target="#tambahRuanganModal">
                                <i class="fa fa-plus"></i>&nbsp;Tambah Ruangan
                            </button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 150px">Kode Kamar</th>
                                        <th style="width: 140px">Kode Gedung</th>
                                        <th style="width: 20px">Nama Ruangan</th>
                                        <th style="width: 20px">No Ruangan</th>
                                        <th style="width: 20px">Kapasitas Ruangan</th>
                                        <th style="text-align: center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $d->kode_kamar }}</td>
                                            <td>{{ $d->kode_gedung }}</td>
                                            <td>{{ $d->nama_ruang }}</td>
                                            <td>{{ $d->no_ruang }}</td>
                                            <td>{{ $d->kapasitas }}</td>
                                            <td>
                                                <center>
                                                    <a href="#" class="btn btn-outline-info btn-sm"><i
                                                            class="fas fa-pencil-alt"></i>&nbsp;Ubah</a>
                                                    <a href="#" class="btn btn-outline-danger btn-sm"><i
                                                            class="fas fa-trash-alt"></i>&nbsp;Hapus</a>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="tambahRuanganModal" tabindex="-1" role="dialog" aria-labelledby="tambahRuanganModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRuanganModalLabel">Tambah Ruangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahRuang" action="{{ url('/setting_ruangan/store') }}" method="POST">
                        @csrf
                        <!--<div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Kode Kamar" name="kode_kamar" required>
                        </div>-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Kode Gedung" name="kode_gedung"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nama Ruangan" name="nama_ruang"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-door-closed"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nomor Ruangan" name="no_ruang" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-door-closed"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Kapasitas Ruangan" name="kapasitas"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" form="formTambahRuang">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jscript')
    <script>
        $(function() {
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
