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
                    <div class="card-tools">
                        <button class="btn btn-success btn-sm" style="width: 100%" data-toggle="modal"
                            data-target="#tambahRuanganModal">
                            <i class="fa fa-plus"></i>&nbsp;Tambah Ruangan
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="position-absolute" style="z-index: 10; width: 100%">
                                        <select name="" id="sort-gedung" title="Pilih"
                                            class="form-control select2bs4 col-md-3">
                                            <option value="0" hidden selected>Pilih Gedung</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <table id="example2" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Kode Kamar</th>
                                        <th>Nama Gedung</th>
                                        <th>Nama Kamar</th>
                                        <th>No Kamar</th>
                                        <th>Status</th>
                                        <th style="text-align: center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $d->kode_kamar }}</td>
                                            <td>{{ $d->gedung->nama_gedung }}</td>
                                            <td>{{ $d->nama_ruang }}</td>
                                            <td>{{ $d->no_ruang }}</td>
                                            <td>
                                                @if($d->status == 0)
                                                    <span class="badge badge-danger">Tidak Aktif</span>
                                                @else
                                                    <span class="badge badge-success">Aktif</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($d->status == 0)
                                                    <a href="/setting_ruangan/aktifkan_ruangan/{{ $d->kode_kamar }}" class="btn btn-outline-success btn-sm"><i class="fa fa-lock"></i> Aktifkan Ruangan</a>
                                                @else
                                                <center>
                                                    <button class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                        data-target="#editRuanganModal" data-kode="{{ $d->kode_kamar }}"
                                                        data-gedung="{{ $d->kode_gedung }}"
                                                        data-ruang="{{ $d->nama_ruang }}" data-nomor="{{ $d->no_ruang }}"
                                                        data-kapasitas="{{ $d->kapasitas }}">
                                                        <i class="fas fa-pencil-alt"></i>&nbsp;Ubah
                                                    </button>
                                                    <form action="{{ route('ruangan.delete', $d->kode_kamar) }}"
                                                        method="POST" id="delete-form-{{ $d->kode_kamar }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            onclick="confirmDelete('{{ $d->kode_kamar }}')">
                                                            <i class="fas fa-trash-alt"></i>&nbsp;Non Aktifkan
                                                        </button>
                                                    </form>
                                                </center>
                                                @endif
                                                
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

    <!-- Modal Tambah Ruangan -->
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
                        <div class="mb-3">
                            <label for="">Gedung<sup>*</sup>:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <select class="form-control" name="kode_gedung" id="kode_gedung" required>
                                    <option value="" disabled selected>Pilih Gedung</option>
                                    @foreach ($gedung as $d)
                                        <option value="{{ $d->kode_gedung }}">{{ $d->nama_gedung }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Nama Ruangan<sup>*</sup>:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Nama Ruangan" name="nama_ruang"
                                    id="nama_ruang" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Nomor Ruangan<sup>*</sup>:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-door-closed"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Nomor Ruangan" name="no_ruang"
                                    id="no_ruang" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Kapasitas Ruangan<sup>*</sup>:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-users"></i></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Kapasitas Ruangan"
                                    name="kapasitas" id="kapasitas" required>
                            </div>
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


    <!-- Modal Edit Ruangan -->
    <div class="modal fade" id="editRuanganModal" tabindex="-1" role="dialog" aria-labelledby="editRuanganModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRuanganModalLabel">Edit Ruangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditRuangan" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="">Kode Kamar<sup>*</sup>:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="text" class="form-control" id="editKodeKamar" name="kode_kamar"
                                    readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Gedung<sup>*</sup>:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <select class="form-control" id="editKodeGedung" name="kode_gedung" required>
                                    <option value="" disabled>Pilih Gedung</option>
                                    @foreach ($gedung as $g)
                                        <option value="{{ $g->kode_gedung }}">{{ $g->nama_gedung }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Nama Ruangan<sup>*</sup>:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                </div>
                                <input type="text" class="form-control" id="editNamaRuang" name="nama_ruang"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Nomor Ruangan<sup>*</sup>:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                                </div>
                                <input type="text" class="form-control" id="editNoRuang" name="no_ruang" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Kapasitas Ruangan<sup>*</sup>:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-users"></i></span>
                                </div>
                                <input type="text" class="form-control" id="editKapasitasRuang" name="kapasitas"
                                    required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" form="formEditRuangan">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script type="module" src="{{ asset('assets/script/app/ruangan/index.js') }}"></script>
@endsection
@section('jscript')
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                bDestroy: true,

            });
        });

        $('#editRuanganModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var kodeKamar = button.data('kode');
            var kodeGedung = button.data('gedung');
            var namaRuangan = button.data('ruang');
            var noRuangan = button.data('nomor');
            var kapasitas = button.data('kapasitas');

            var modal = $(this);
            modal.find('.modal-body #editKodeKamar').val(kodeKamar);
            modal.find('.modal-body #editkodeGedung').val(kodeGedung);
            modal.find('.modal-body #editNamaRuang').val(namaRuangan);
            modal.find('.modal-body #editNoRuang').val(noRuangan);
            modal.find('.modal-body #editKapasitasRuang').val(kapasitas);

            modal.find('.modal-body #editKodeGedung option').each(function() {
                if ($(this).val() == kodeGedung) {
                    $(this).prop('selected', true);
                }
            });

            var formAction = '{{ url('/setting_ruangan/') }}/' + kodeKamar + '/update';
            modal.find('.modal-body form').attr('action', formAction);
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        function confirmDelete(kodeKamar) {
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Ingin menghapus data ruangan ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#068c15",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + kodeKamar).submit();
                    Swal.fire({
                        title: "Dihapus!",
                        text: "Data ruangan dihapus",
                        icon: "success"
                    });
                }
            });
        }
    </script>
@endsection
