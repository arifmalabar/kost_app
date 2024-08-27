@extends('layout.layout')

@section('css')
    <style>
        sup{
            color: red;
        }
    </style>
@endsection

@section('judul')
Edit Penghuni
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  <div class="card card-default">
                    <div class="card-header">
                      <h3 class="card-title">Input Data Penghuni</h3>
                    </div>
                    <div class="card-body p-0">
                      <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                          <!-- your steps here -->
                          <div class="step" data-target="#logins-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger">
                              <span class="bs-stepper-circle"><i class="fa fa-user"></i></span>
                              <span class="bs-stepper-label">Biodata Penghuni</span>
                            </button>
                          </div>
                          <div class="line"></div>
                          <div class="step" data-target="#ktp-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="ktp-part" id="ktp-part-trigger">
                              <span class="bs-stepper-circle"><i class="fas fa-solid fa-building"></i></span>
                              <span class="bs-stepper-label">KTP</span>
                            </button>
                          </div>
                          <div class="line"></div>
                          <div class="step" data-target="#information-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger">
                              <span class="bs-stepper-circle"><i class="fas fa-solid fa-building"></i></span>
                              <span class="bs-stepper-label">Pilih Kamar</span>
                            </button>
                          </div>
                        </div>
                        <div class="bs-stepper-content">
                          <!-- your steps content here -->
                            <input type="hidden" value="{{ csrf_token() }}" class="token">
                            <div id="logins-part" class="content" role="tabpanel" aria-labelledby="logins-part-trigger">
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
                                    <div class="col-md-12">
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
                                            <label for="">Alamat Kampus<sup>*</sup>: </label>
                                            <div class="input-group mb-3">
                                                
                                                <textarea class="form-control alamat_kampus" name="alamat_kampus" id="" cols="15" rows="4" placeholder="Masukan Alamat"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Alamat Rumah<sup>*</sup>: </label>
                                            <div class="input-group mb-3">
                                                <textarea class="form-control alamat_rumah" name="alamat_rumah" id="" cols="15" rows="4" placeholder="Masukan Alamat"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button class="btn btn-success" onclick="stepper.next()"  id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Next&nbsp;<i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div id="ktp-part" class="content" role="tabpanel" aria-labelledby="ktp-part-trigger">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Foto KTP Saat Ini</label>
                                    </div>
                                    <div class="col-md-12">
                                        <img class="foto-ktp" src="" height="300px" width="500px" alt="foto ktp">
                                    </div>
                                    <div class="col-md-12" style="margin-top: 20px">
                                        <div class="form-group row" >
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Upload KTP Baru</label>
                                            <div class="col-sm-8">
                                            <input type="file" name="files" id="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <button class="btn btn-info text-white" onclick="stepper.previous()"><i class="fa fa-arrow-left"></i>&nbsp;Previous</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-success text-white" onclick="stepper.next()" style="position: absolute; right: 10px"><i class="fa fa-arrow-right"></i>&nbsp;Next</button>
                                    </div>
                                </div>
                            </div>
                            <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
                                <div class="row">
                                    <div class="col-md-11">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Gedung</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2bs4 input-gedung">
                                                    <option value="">Pilih Gedung</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button class="btn btn-success btn-cari" style="width: 100%">Cari</button>
                                    </div>
                                    <!--<div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-sm-4 col-form-label">Ruangan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select2bs4 input-ruang">
                                                    <option value="">Pilih Gedung</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="col-md-12">
                                        <hr>
                                        <h3>Informasi Ketersediaan Ruang</h3>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="" class="old-ruang">Ruangan Sebelumnya : </label>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="change-ruang">Ruangan Dipilih : </label>
                                            </div>
                                        </div>
                                        
                                        <table id="example2" style="text-align: center" class="table table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Ruang</th>
                                                    <th>Gedung</th>
                                                    <th>Status</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-info text-white" onclick="stepper.previous()"><i class="fa fa-arrow-left"></i>&nbsp;Previous</button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-success text-white btn-simpan" style="position: absolute; right: 10px"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <!--<div class="card-footer">
                      Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a> for more examples and information about the plugin.
                    </div>-->
                  </div>
                  <!-- /.card -->
                </div>
              </div>
              <!-- /.row -->
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('assets/script/app/penghuni/update/index.js') }}" type="module"></script>
@endsection
@section('jscript')
    <script>
        let field_gedung = document.getElementById("input-gedung");
        $('#formTambahPenghuni input[name="harga"]').on("input", function () {
    let value = $(this)
      .val()
      .replace(/[^0-9]/g, "");
    $(this).val(
      value ? "Rp. " + value.replace(/\B(?=(\d{3})+(?!\d))/g, ".") : ""
    );
  });
        $(function () {
            $('.select2').select2();
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function () {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
    </script>
    
@endsection