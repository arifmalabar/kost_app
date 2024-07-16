@extends('layout.layout')
@section('judul')
    Tambah Penghuni
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="card-title">Informasi Penghuni</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahGedungModal">
                                <i class="fa fa-plus"></i>&nbsp;Tambah Penghuni Baru
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">Kode</th>
                                        <th style="width: 150px">Nama Penghuni</th>
                                        <th style="width: 20px">Nomer telepon</th>
                                        <th style="width: 140px">Kode kamar</th>
                                        <th style="width: 300px">Alamat penghuni</th>
                                        <th style="text-align: center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dimas Rizky</td>
                                        <td>0888382813123</td>
                                        <td>1</td>
                                        <td>Peterongan</td>
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
                    <h5 class="modal-title" id="tambahGedungModalLabel">Tambah Penghuni baru</h5>
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
                            <input type="text" class="form-control" placeholder="Kode Penghuni" id="#">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nama Penghuni" id="#">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-phone-square"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Nomer Telepon" id="#">
                        </div>
                        <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
    </div>
    <select class="form-control" id="kodeKamar">
        <option value="" disabled selected>Pilih Kode Kamar</option>
        <option value="kamar1">Kamar 1</option>
        <option value="kamar2">Kamar 2</option>
        <option value="kamar3">Kamar 3</option>
        <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
    </select>
</div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Alamat penghuni" id="#">
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

        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
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
