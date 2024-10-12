@extends('layout.layout')
@section('css')
    <style>
        sup {
            color: red;
        }
    </style>
@endsection
@section('judul')
    Setting Gedung
@endsection

@section('content')
    <section class="content">
        
        <div class="container-fluid">
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-info"></i> Petunjuk!</h5>
                <ul>
                    <li>Untuk melakukan export penghuni pergedung silahkan melakukan klik pada nama gedung</li>
                    <li>Export hanya tersedia dengan format .xls (excel)</li>
                    <li>Export excel hanya dapat menampilkan kamar dan penghuni namun tidak menampilkan kamar yang tersedia atau tidak</li>
                </ul>
              </div>
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="card-title">Informasi Gedung</h4>
                    <div class="card-tools">
                        <button class="btn btn-success btn-sm" data-toggle="modal"
                                data-target="#tambahGedungModal">
                                <i class="fa fa-plus"></i>&nbsp;Tambah Gedung
                            </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            
                            <table id="example2" class="table table-bordered table-hover" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Gedung</th>
                                        <th>Nama Gedung</th>
                                        <th>Alamat Gedung</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;?>
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td><a href="/setting_gedung/export_excel/<?= $d->kode_gedung ?>" target="_blank" rel="noopener noreferrer">{{ $d->kode_gedung }}</a></td>
                                            <td>{{ $d->nama_gedung }}</td>
                                            <td>{{ $d->alamat_gedung }}</td>
                                            <td>
                                                <center>
                                                    <button class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                        data-target="#editGedungModal" data-kode="{{ $d->kode_gedung }}"
                                                        data-nama="{{ $d->nama_gedung }}"
                                                        data-alamat="{{ $d->alamat_gedung }}">
                                                        <i class="fas fa-pencil-alt"></i>&nbsp;Ubah
                                                    </button>
                                                    <form action="{{ route('gedung.delete', $d->kode_gedung) }}"
                                                        method="POST" id="delete-form-{{ $d->kode_gedung }}"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                            onclick="confirmDelete('{{ $d->kode_gedung }}')">
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
                        <div class="form-group">
                            <label for="">Nama Gedung<sup>*</sup>:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control" name="nama_gedung"
                                    placeholder="Masukan Nama Gedung" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat Gedung<sup>*</sup>:</label>
                            <div class="input-group mb-3">
                                <textarea name="alamat_gedung" placeholder="Masukan Alamat Gedung" id="" cols="30" rows="5"
                                    class="form-control"></textarea>
                            </div>
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

    <!-- Modal Edit Gedung -->
    <div class="modal fade" id="editGedungModal" tabindex="-1" role="dialog" aria-labelledby="editGedungModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGedungModalLabel">Edit Gedung</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEditGedung" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Kode Gedung<sup>*</sup>:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="text" class="form-control" id="editKodeGedung" name="kode_gedung"
                                    readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Gedung<sup>*</sup>:</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                </div>
                                <input type="text" class="form-control" id="editNamaGedung" name="nama_gedung"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat Gedung<sup>*</sup>:</label>
                            <div class="input-group mb-3">
                                <textarea id="editAlamatGedung" name="alamat_gedung" id="" cols="30" rows="5"
                                    class="form-control"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" form="formEditGedung">Edit</button>
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

        $('#editGedungModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var kodeGedung = button.data('kode');
            var namaGedung = button.data('nama');
            var alamatGedung = button.data('alamat');

            var modal = $(this);
            modal.find('.modal-body #editKodeGedung').val(kodeGedung);
            modal.find('.modal-body #editNamaGedung').val(namaGedung);
            modal.find('.modal-body #editAlamatGedung').val(alamatGedung);

            var formAction = '{{ url('/setting_gedung/') }}/' + kodeGedung + '/update';
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

        function confirmDelete(kodeGedung) {
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
                    document.getElementById('delete-form-' + kodeGedung).submit();
                    Swal.fire({
                        title: "Dihapus!",
                        text: "Data gedung dihapus",
                        icon: "success"
                    });
                }
            });
        }
    </script>
@endsection
