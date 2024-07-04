@extends('layout.layout')
@section('judul')
    Setting Gedung
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h4 class="card-title">Input Data Setting Gedung</h4>
                            <div class="card-tools">
                                <button class="btn btn-success btn-xs"><i class="fa fa-plus"></i>&nbsp;Tambah Gedung</button>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="input-nama">Nama Gedung</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input-nama" placeholder="Masukan Nama Gedung">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="input-nama">Kapasitas</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="input-nama" placeholder="Masukan Kapasitas">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="input-nama">Jumlah Lantai</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="input-nama" placeholder="Masukan Jumlah Lantai">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="input-nama">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="" class="form-control" placeholder="Masukan Alamat" id="" cols="20" rows="10"></textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
