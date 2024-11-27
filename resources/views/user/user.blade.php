@extends('layout/layout')
@section('judul')
    User
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">
                                User Data
                            </h3>
                            <div class="card-tools">
                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalTambah"><i class="fa fa-plus"></i> Data User</button>
                            </div>
                        </div>
                        <div class="card-body">

                            <table id="example2" class="table table-bordered table-hover" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach($user_data as $key)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $key->name }}</td>
                                            <td>{{ $key->email }}</td>
                                            <td>
                                                <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modalUpdate" data-id="{{ $key->id }}" data-name="{{ $key->name }}" data-email="{{ $key->email }}"><i class="fa fa-edit"></i> Ubah</button>
                                                <a href="/user/hapus_data/{{ $key->id }}" class="btn btn-outline-danger btn-sm btn-hapus"><i class="fa fa-trash"></i> Hapus</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="modal fade" id="modalTambah">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <form action="/user/tambah_user" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                        <h4 class="modal-title">Tambah User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Nama</label>
                                                        <input type="text" name="name" placeholder="Masukan nama" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="text" name="email" placeholder="Masukan nama" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" name="password" placeholder="Masukan nama" class="form-control">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Tambah</button>
                                        </div>
                                    </form>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <div class="modal fade" id="modalUpdate">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <form action="" class="form-update" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                        <h4 class="modal-title">Update User</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Nama</label>
                                                        <input type="hidden" class="input-id">
                                                        <input type="text" name="name"  placeholder="Masukan nama" class="form-control input-nama">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Email</label>
                                                        <input type="text" name="email" placeholder="Masukan nama" class="form-control input-email">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" required name="password" placeholder="Masukan nama" class="form-control">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-warning">Update</button>
                                        </div>
                                    </form>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script>
        $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        $("#modalUpdate").on("show.bs.modal", function (e) {
            let btn = $(e.relatedTarget);
            let id = btn.data("id");
            let name = btn.data("name");
            let email = btn.data("email");

            $(".input-id").val(id);
            $(".input-nama").val(name);
            $(".input-email").val(email);
            $(".form-update").attr("action", `/user/update_user/${id}`);
        })
        $("body").on("click", ".btn-hapus", function (e) {
            e.preventDefault();
            let btn = $(e.relatedTarget);
            let url = $(this).attr("href");
            
            Swal.fire({
                title: "Hapus data",
                icon : "question",
                text: "Apakah anda ingin menghapus data?",
                confirmButtonText: "Hapus",
                denyButtonText: "Batal Hapus",
                showDenyButton: true,
            }).then(function (e) {
                if(e.isConfirmed)
                {
                    window.location.href = url;
                }
            })
        });
    </script>
@endsection