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
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahGedungModal">
                                <i class="fa fa-plus"></i>&nbsp;Tambah Ruangan
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">NO</th>
                                        <th style="width: 30px">Kode</th>
                                        <th style="width: 150px">Nama Ruangan</th>
                                        <th style="width: 20px">Kapasitas</th>
                                        <th style="text-align: center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>R001
                                        </td>
                                        <td>Ruangan1
                                        </td>
                                        <td>2 Orang</td>
                                        <td>
                                            <center>
                                                <a href="#" class="btn btn-outline-info btn-sm"><i
                                                        class="fas fa-pencil-alt"></i>&nbsp;Ubah</a>
                                                <a href="#" class="btn btn-outline-danger btn-sm"><i
                                                        class="fas fa-trash-alt"></i>&nbsp;Hapus</a>
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="tambahGedungModal" tabindex="-1" role="dialog" aria-labelledby="tambahGedungModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahGedungModalLabel">Tambah Gedung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formTambahGedung">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Kode Gedung" id="#">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nama Gedung" id="#">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-building"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Kapasitas Gedung" id="#">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Jumlah Lantai" id="#">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Alamat" id="#">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jscript')
    <script>
        function simpan() {
            $('#tambahGedungModal').modal('hide');
        }
    </script>
@endsection
