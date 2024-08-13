@extends('layout.layout')

@section('judul')
    Setting Gedung
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="card-title">Informasi Gedung</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-success btn-sm position-absolute" style="z-index: 10;" data-toggle="modal"
                                data-target="#tambahGedungModal">
                                <i class="fa fa-plus"></i>&nbsp;Tambah Gedung
                            </button>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">Kode Gedung</th>
                                        <th style="width: 120px">Nama Gedung</th>
                                        <th style="width: 120px">Alamat Gedung</th>
                                        <th style="text-align: center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $d->kode_gedung }}</td>
                                            <td>{{ $d->nama_gedung }}</td>
                                            <td>{{ $d->alamat_gedung }}</td>
                                            <td>
                                                <center>
                                                    <a href="{{ route('gedung.edit', $d->kode_gedung) }}"
                                                        class="btn btn-outline-info btn-sm">
                                                        <i class="fas fa-pencil-alt"></i>&nbsp;Ubah
                                                    </a>
                                                    <form action="{{ route('gedung.delete', $d->kode_gedung) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                            <i class="fas fa-trash-alt"></i>&nbsp;Hapus
                                                        </button>
                                                    </form>
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

    <!-- Modal Tambah Gedung -->
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
                    <form id="formTambahGedung" action="{{ url('/setting_gedung/store') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control" name="kode_gedung" placeholder="Kode Gedung"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nama_gedung" placeholder="Nama Gedung"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                            </div>
                            <input type="text" class="form-control" name="alamat_gedung" placeholder="Alamat" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" form="formTambahGedung">Simpan</button>
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
