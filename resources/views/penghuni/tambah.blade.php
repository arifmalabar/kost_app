@extends('layout.layout')

@section('css')
    <style>
        sup{
            color: red;
        }
    </style>
@endsection

@section('judul')
Tambah Penghuni
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                        <li class="nav-item" >
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true"><i class="fa fa-user"></i>&nbsp;Biodata Penghuni</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false"><i class="fa fa-home"></i>Pilih Kamar</a>
                        </li>
                        
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-two-tabContent">
                        <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <div class="row">
                                <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">NIK <sup>*</sup></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="NIK" placeholder="Masukan NIK" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama<sup>*</sup>: </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email<sup>*</sup>: </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Harga<sup>*</sup>: </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="harga" placeholder="Harga" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No Telepon<sup>*</sup>: </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="no_telp" placeholder="No Telepon" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Wali<sup>*</sup>: </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user-friends"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="nama_wali" placeholder="Nama Wali" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Kampus<sup>*</sup>: </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-university"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="nama_kampus_kantor" placeholder="Nama Kampus" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Pilih Ruang<sup>*</sup>: </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <select class="form-control" name="kode_kamar" required>
                                                <option value="" disabled selected>Pilih No Kamar</option>
                                            </select>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Kampus<sup>*</sup>: </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <select class="form-control" name="kode_kamar" required>
                                                <option value="" disabled selected>Pilih No Kamar</option>
                                                
                                            </select>
                                        </div>
                                    </div> 
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Pilih Kamar<sup>*</sup>: </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                                            </div>
                                            <select class="form-control" name="kode_kamar" required>
                                                <option value="" disabled selected>Pilih No Kamar</option>
                                                
                                            </select>
                                        </div> 
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Upload KTP<sup>*</sup>: </label>
                                        <input type="file" name="" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Alamat Kampus<sup>*</sup>: </label>
                                        <div class="input-group mb-3">
                                            
                                            <textarea class="form-control" name="alamat" id="" cols="30" rows="10" placeholder="Masukan Alamat"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Alamat Rumah<sup>*</sup>: </label>
                                        <div class="input-group mb-3">
                                            <textarea class="form-control" name="alamat" id="" cols="30" rows="10" placeholder="Masukan Alamat"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-success" style="width: 100%"><i class="fa fa-plus"></i> Tambah Pelanggan</button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Gedung</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2bs4 input-gedung">
                                                <option value="">Pilih Gedung</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="inputEmail3" class="col-sm-4 col-form-label">Ruangan</label>
                                        <div class="col-sm-8">
                                            <select class="form-control select2bs4 input-ruang">
                                                <option value="">Pilih Gedung</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('assets/script/app/penghuni/tambah/index.js') }}" type="module"></script>
@endsection
@section('jscript')
    <script>
        $(function () {
            $('.select2').select2();
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
    
@endsection