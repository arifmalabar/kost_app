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
                <div class="card-tools">
                    <a href="/penghuni_ruang/tambah_penghuni" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i>&nbsp;Tambah Penghuni Baru
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-10">

                                <div class="position-absolute" style="z-index: 10; width: 100%">
                                    <select name="" id="sort-gedung" title="Pilih"
                                        class="form-control select2bs4 col-md-3">
                                        <option value="0" hidden selected>Pilih Gedung</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>No Telepon</th>
                                    <th>Kamar</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($penghuni as $d)
                                <tr>
                                    <td>{{ $d->NIK }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->email }}</td>
                                    <td>{{ $d->no_telp }}</td>
                                    <td>{{ $d->nama_ruang }}</td>
                                    <td>
                                        <center>
                                            <a href="/penghuni_ruang/detail_penghuni/{{ $d->NIK }}"
                                                class="btn btn-outline-info btn-sm">
                                                <i class="fas fa-pencil-alt"></i>&nbsp;Ubah
                                            </a>
                                            <!-- Form Hapus -->
                                            <form action="{{ route('penghuni.delete', $d->NIK) }}" method="POST"
                                                id="delete-form-{{ $d->NIK }}" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-outline-danger btn-sm"
                                                    onclick="confirmDelete('{{ $d->NIK }}')">
                                                    <i class="fas fa-trash-alt"></i>&nbsp;Non Aktifkan
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

<!-- Tambah data -->
<div class="modal fade" id="tambahPenghuniModal" tabindex="-1" role="dialog" aria-labelledby="tambahPenghuniModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahPenghuniModalLabel">Tambah Penghuni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formTambahPenghuni" action="{{ url('/penghuni_ruang/store') }}" method="POST">
                    @csrf
                    <!--<div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                </div>
                                <input type="text" class="form-control" name="NIK" placeholder="NIK" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="text" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" class="form-control" name="harga" placeholder="Harga" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control" name="no_telp" placeholder="No Telepon" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                </div>
                                <input type="text" class="form-control" name="nama_wali" placeholder="Nama Wali" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-university"></i></span>
                                </div>
                                <input type="text" class="form-control" name="nama_kampus_kantor" placeholder="Nama Kampus" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input type="text" class="form-control" name="alamat_kampus_kantor" placeholder="Alamat Kampus" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                                </div>
                                <input type="text" class="form-control" name="status" placeholder="Status" required>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                </div>
                                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
                            </div>
                            <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <select class="form-control" name="kode_kamar" required>
                                        <option value="" disabled selected>Pilih No Kamar</option>
                                        @foreach ($kode as $d)
    <option value="{{ $d->kode_kamar }}">{{ $d->kode_kamar }}</option>
    @endforeach
                                    </select>
                                </div>-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Penghuni -->
<div class="modal fade" id="editPenghuniModal" tabindex="-1" role="dialog" aria-labelledby="editPenghuniModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPenghuniModalLabel">Edit Penghuni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditPenghuni" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editNikPenghuni" name="NIK" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editNamaPenghuni" name="nama" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editemail" name="email" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editHargaPenghuni" name="harga" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editNoTelp" name="no_telp" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editNamaWali" name="nama_wali" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-university"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editNamaKampus" name="nama_kampus_kantor" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-info-circle"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editAlamatKampus" name="alamat_kampus_kantor"
                            required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-home"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editStatus" name="status" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-door-closed"></i></span>
                        </div>
                        <input type="text" class="form-control" id="editAlamat" name="alamat" required>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-door-closed "></i></span>
                        </div>
                        <select class="form-control" id="editKodeKamar" name="kode_kamar" required>
                            <option value="" disabled>Pilih Nomor Kamar</option>
                            @foreach ($kode as $d)
                            <option value="{{ $d->kode_kamar }}">{{ $d->kode_kamar }}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('assets/script/app/penghuni/index.js') }}" type="module"></script>
@endsection
@section('jscript')
<script>
    window.token =" {{ csrf_token() }}"
        $(function() {
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
            });


        });


        // Format harga dengan Rp. di form tambah
        $('#formTambahPenghuni input[name="harga"]').on('input', function() {
            let value = $(this).val().replace(/[^0-9]/g, '');
            $(this).val(value ? 'Rp. ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '');
        });

        // Format harga dengan Rp. di form edit
        $('#formEditPenghuni input[name="harga"]').on('input', function() {
            let value = $(this).val().replace(/[^0-9]/g, '');
            $(this).val(value ? 'Rp. ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '');
        });



        $('#editPenghuniModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var nikPenghuni = button.data('nik');
            var namaPenghuni = button.data('nama');
            var emailPenghuni = button.data('email');
            var hargaPenghuni = button.data('harga');
            var noTelpPenghuni = button.data('no_telp');
            var namaWaliPenghuni = button.data('nama_wali');
            var namaKampusPenghuni = button.data('nama_kampus_kantor');
            var alamatKampusPenghuni = button.data('alamat_kampus_kantor');
            var statusPenghuni = button.data('status');
            var alamatPenghuni = button.data('alamat');
            var kodeKamarPenghuni = button.data('kode_kamar');

            var modal = $(this);
            modal.find('.modal-body #editNikPenghuni').val(nikPenghuni);
            modal.find('.modal-body #editNamaPenghuni').val(namaPenghuni);
            modal.find('.modal-body #editemail').val(emailPenghuni);
            modal.find('.modal-body #editHargaPenghuni').val(hargaPenghuni);
            modal.find('.modal-body #editNoTelp').val(noTelpPenghuni);
            modal.find('.modal-body #editNamaWali').val(namaWaliPenghuni);
            modal.find('.modal-body #editNamaKampus').val(namaKampusPenghuni);
            modal.find('.modal-body #editAlamatKampus').val(alamatKampusPenghuni);
            modal.find('.modal-body #editStatus').val(statusPenghuni);
            modal.find('.modal-body #editAlamat').val(alamatPenghuni);
            modal.find('.modal-body #editKodeKamar').val(kodeKamarPenghuni);

            var formAction = '{{ url('/penghuni_ruang') }}/' + nikPenghuni + '/update';
            modal.find('.modal-body form').attr('action', formAction);
        });

        // Hapus "Rp." sebelum mengirim data form
        $('#formTambahPenghuni, #formEditPenghuni').on('submit', function() {
            $(this).find('input[name="harga"]').each(function() {
                let value = $(this).val().replace(/[^0-9]/g, '');
                $(this).val(value);
            });
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

        function confirmDelete(NIK) {
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Ingin menonaktifkan data penghuni ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#068c15",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + NIK).submit();
                    Swal.fire({
                        title: "Dinonaktifkan!",
                        text: "Data penghuni dinonaktifkan",
                        icon: "success"
                    });
                }
            });
        }
</script>
@endsection