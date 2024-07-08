@extends('layout.layout')
@section('judul')
    Bayar
@endsection
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-success">
                <div class="card-header">
                    <h4 class="card-title">Formulir Pembayaran</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12"><h4>Data Penghuni Ruangan</h4></div>
                        <div class="col-md-5">
                            <label>Foto KTP/Identitas Lain</label>
                            <img src="https://www.jitoe.com/wp-content/uploads/2022/10/KTP-Hilang-atau-Ingin-Ubah-Data-akan-Dirujuk-Buat-KTP-Digital.png" width="400px" height="280px" alt="KTP" srcset="">
                        </div>
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>NIK:</label>
                                    <p>35072412220023</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Nama:</label>
                                    <p>Zaidan Sultansyah Adi Darmawan</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Gedung</label>
                                    <p>Gedung 1</p>
                                </div>
                                <div class="col-md-6">
                                    <label>Ruangan</label>
                                    <p>Ruang 1</p>
                                </div>
                                <div class="col-md-12">
                                    <label>Total Tagihan</label>
                                    <p style="color:red;"><b>Rp 850.000,00-</b> </p>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <br>
                                    <a href="" class="btn btn-outline-warning btn-sm" style="width: 100%"><i class="fa fa-edit"></i>Ubah Akun</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12"><br><h4>Bayar Tagihan</h4></div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Tahun</label>
                                <div class="col-sm-8">
                                    <select name="" id="" class="form-control">
                                        <option value="2021">2021</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Bulan</label>
                                <div class="col-sm-8">
                                    <select name="" id="" class="form-control">
                                        <option value="1">Januari(Sdh Bayar)</option>
                                        <option value="2">Februari(Sdh Bayar)</option>
                                        <option value="3">Maret(Sdh Bayar)</option>
                                        <option value="4">April(Sdh Bayar)</option>
                                        <option value="5">Mei</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Total Bayar</label>
                                <div class="col-sm-8">
                                  <input type="number" class="form-control" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Metode Pembayaran</label>
                                <div class="col-sm-8">
                                  <input type="radio" name="transfer"  id="transfer"> <label for="transfer">Transfer/Non Tunai/Jenis Lain</label>&nbsp;
                                  <input type="radio" name="transfer"  id="tunai"> <label for="tunai">Tunai</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection