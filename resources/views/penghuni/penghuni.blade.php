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
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#tambahPenghuniModal">
                                <i class="fa fa-plus"></i>&nbsp;Tambah Penghuni Baru
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 30px">Nik</th>
                                        <th style="width: 30px">Nama</th>
                                        <th style="width: 20px">Email</th>
                                        <th style="width: 30px">Harga</th>
                                        <th style="width: 30px">No Telepon</th>
                                        <th style="width: 30px">Nama Wali</th>
                                        <th style="width: 30px">Nama Kampus</th>
                                        <th style="width: 30px">Alamat Kampus</th>
                                        <th style="width: 30px">Status</th>
                                        <th style="width: 30px">Alamat</th>
                                        <th style="width: 30px">Kode Kamar</th>
                                        <th style="text-align: center">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $d->NIK }}</td>
                                            <td>{{ $d->nama }}</td>
                                            <td>{{ $d->email }}</td>
                                            <td>{{ $d->harga }}</td>
                                            <td>{{ $d->no_telp }}</td>
                                            <td>{{ $d->nama_wali }}</td>
                                            <td>{{ $d->nama_kampus_kantor }}</td>
                                            <td>{{ $d->alamat_kampus_kantor }}</td>
                                            <td>{{ $d->status }}</td>
                                            <td>{{ $d->alamat }}</td>
                                            <td>{{ $d->kode_kamar }}</td>
                                            <td>
                                                <center>
                                                    <button class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                        data-target="#editPenghuniModal" data-nik="{{ $d->NIK }}"
                                                        data-nama="{{ $d->nama }}" data-email="{{ $d->email }}"
                                                        data-harga="{{ $d->harga }}"
                                                        data-no_telp="{{ $d->no_telp }}"
                                                        data-nama_wali="{{ $d->nama_wali }}"
                                                        data-nama_kampus_kantor="{{ $d->nama_kampus_kantor }}"
                                                        data-alamat_kampus_kantor="{{ $d->alamat_kampus_kantor }}"
                                                        data-status="{{ $d->status }}"
                                                        data-alamat="{{ $d->alamat }}"
                                                        data-kode_kamar="{{ $d->kode_kamar }}">
                                                        <i class="fas fa-pencil-alt"></i>&nbsp;Ubah
                                                    </button>

                                                    <form action="{{ route('penghuni.delete', $d->NIK) }}" method="POST"
                                                        id="delete-form-{{ $d->NIK }}" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            onclick="confirmDelete('{{ $d->NIK }}')">
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

    <!-- Tambah Penghuni Modal -->
    <div class="modal fade" id="tambahPenghuniModal" tabindex="-1" role="dialog"
        aria-labelledby="tambahPenghuniModalLabel" aria-hidden="true">
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
                        <!-- Input Fields -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            </div>
                            <input type="text" class="form-control" name="NIK" placeholder="Nik" required>
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
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
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
                            <input type="text" class="form-control" name="nama_wali" placeholder="Nama Wali"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-university"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nama_kampus_kantor"
                                placeholder="Nama Kampus/Kantor" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                            </div>
                            <input type="text" class="form-control" name="alamat_kampus_kantor"
                                placeholder="Alamat Kampus/Kantor" required>
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
                                <span class="input-group-text"><i class="fas fa-door-closed"></i></span>
                            </div>
                            <input type="text" class="form-control" name="kode_kamar" placeholder="Kode Kamar"
                                required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" form="formTambahPenghuni">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Penghuni Modal -->
    <div class="modal fade" id="editPenghuniModal" tabindex="-1" role="dialog"
        aria-labelledby="editPenghuniModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPenghuniModalLabel">Edit Penghuni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditPenghuni" action="{{ url('/penghuni_ruang/update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Input Fields -->
                        <input type="hidden" id="edit-nik" name="NIK" value="">
                        <!-- Other input fields -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" id="edit-nama" name="nama" placeholder="Nama"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" class="form-control" id="edit-email" name="email"
                                placeholder="Email" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                            </div>
                            <input type="text" class="form-control" id="editHargaPenghuni" name="harga" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="editnotelp" name="no_telp" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="editnamakampus" name="nama_kampus_kantor"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="editalamatkampus" name="alamat_kampus_kantor"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="ditstatus" name="status" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="editalamat" name="alamat" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" id="editkode" name="kode_kamar" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" form="formEditPenghuni">Simpan</button>
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

        $('#editPenghuniModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var nik = button.data('nik');
            var nama = button.data('nama');
            var email = button.data('email');
            var harga = button.data('harga');
            var no_telp = button.data('no_telp');
            var nama_wali = button.data('nama_wali');
            var nama_kampus_kantor = button.data('nama_kampus_kantor');
            var alamat_kampus_kantor = button.data('alamat_kampus_kantor');
            var status = button.data('status');
            var alamat = button.data('alamat');
            var kode_kamar = button.data('kode_kamar');

            var modal = $(this);
            modal.find('#edit-nik').val(nik);
            modal.find('#edit-nama').val(nama);
            modal.find('#edit-email').val(email);
            modal.find('#editHargaPenghuni').val(harga);
            modal.find('#editnotelp').val(no_telp);
            modal.find('#editnama_wali').val(nama_wali);
            modal.find('#editnamakampus').val(nama_kampus_kantor);
            modal.find('#editalamatkampus').val(alamat_kampus_kantor);
            modal.find('#ditstatus').val(status);
            modal.find('#editalamat').val(alamat);
            modal.find('#editkode').val(kode_kamar);

            // Update form action dynamically
            var formAction = '{{ url('/penghuni_ruang/update') }}/' + nik;
            modal.find('.modal-body form').attr('action', formAction);
        });


        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('                                                                                                                           success ') }}',
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        function confirmDelete(NIK) {
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Ingin menghapus data gedung ini?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#068c15",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + NIK).submit();
                    Swal.fire({
                        title: "Dihapus!",
                        text: "Data penghuni dihapus",
                        icon: "success"
                    });
                }
            });
        }
    </script>
@endsection
