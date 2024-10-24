@extends('layout.layout')

@section('css')
<style>
    sup {
        color: red;
    }
</style>
@endsection

@section('judul')
Tambah Penghuni
@endsection

@section('content')
<div class="debug"></div>
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
                                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part"
                                        id="logins-part-trigger">
                                        <span class="bs-stepper-circle"><i class="fa fa-user"></i></span>
                                        <span class="bs-stepper-label">Biodata Penghuni</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#information-part">
                                    <button type="button" class="step-trigger" role="tab"
                                        aria-controls="information-part" id="information-part-trigger">
                                        <span class="bs-stepper-circle"><i class="fas fa-solid fa-building"></i></span>
                                        <span class="bs-stepper-label">Pilih Kamar</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content">
                                <!-- your steps content here -->
                                <input type="hidden" value="{{ csrf_token() }}" class="token">
                                <div id="logins-part" class="content" role="tabpanel"
                                    aria-labelledby="logins-part-trigger">
                                    <div class="row">
                                        <input type="hidden" name="csrf_token" value="{{ csrf_token() }}">
                                        <div class="col-md-6">
                                            <div class="form-group NIK">
                                                <label for="">NIK <sup>*</sup></label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend ">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-id-card"></i></span>
                                                    </div>
                                                    <input type="number" class="form-control" name="NIK"
                                                        placeholder="Masukan NIK" required>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group nama">
                                                <label for="">Nama<sup>*</sup>: </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-user"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control toUp" name="nama"
                                                        placeholder="Nama" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group email">
                                                <label for="">Email<sup>*</sup>: </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-envelope"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="email"
                                                        placeholder="Email" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group harga">
                                                <label for="">Harga<sup>*</sup>: </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-dollar-sign"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="hargaInput" name="harga"
                                                        placeholder="Harga" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group no-telp">
                                                <label for="">No Telepon<sup>*</sup>: </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" name="no_telp"
                                                        placeholder="No Telepon" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nama Wali<sup>*</sup>: </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-user-friends"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control toUp" name="nama_wali"
                                                        placeholder="Nama Wali" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nama Kampus<sup>*</sup>: </label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-university"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control toUp"
                                                        name="nama_kampus_kantor" placeholder="Nama Kampus" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Tanggal Bergabung</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control tanggal_bergabung"
                                                        value="{{ date('Y-m-d') }}" name="tanggal_bergabung"
                                                        placeholder="Nama Kampus" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">Upload KTP<sup>*</sup>: </label>
                                                    <input type="file" name="files" id=""
                                                        class="form-control">
                                                        <label class="msg-err-file" style="color: red;"></label>
                                                </div>
                                            </div>-->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Alamat Kampus<sup>*</sup>: </label>
                                                <div class="input-group mb-3">
                                                    <textarea class="form-control alamat_kampus" name="alamat_kampus"
                                                        id="" cols="15" rows="4"
                                                        placeholder="Masukan Alamat"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Alamat Rumah<sup>*</sup>: </label>
                                                <div class="input-group mb-3">
                                                    <textarea class="form-control alamat_rumah" name="alamat_rumah"
                                                        id="" cols="15" rows="4"
                                                        placeholder="Masukan Alamat"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-success next-btn" onclick="handleNextClick()"
                                                id="custom-tabs-four-profile-tab" data-toggle="pill"
                                                href="#custom-tabs-four-profile" role="tab"
                                                aria-controls="custom-tabs-four-profile"
                                                aria-selected="false">Next&nbsp;<i
                                                    class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div id="information-part" class="content" role="tabpanel"
                                    aria-labelledby="information-part-trigger">
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
                                            <label for="" class="change-ruang">Ruangan Dipilih
                                                : </label>
                                            <input type="hidden" name="kode_kamar" class="field-ruangan">
                                            <table id="example2" style="text-align: center"
                                                class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Ruang</th>
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
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-info text-white" onclick="stepper.previous()"><i
                                                    class="fa fa-arrow-left"></i>&nbsp;Previous</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="submit" class="btn btn-success text-white btn-simpan"
                                                style="position: absolute; right: 10px"><i
                                                    class="fa fa-save"></i>&nbsp;Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
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
<script src="{{ asset('assets/script/app/penghuni/tambah/index.js') }}" type="module"></script>
@endsection
@section('jscript')
<script>
    let field_gedung = document.getElementById("input-gedung");

        function convertToRupiah(obj) {
            let value = obj.value.replace(/[^,\d]/g, '').toString();
            let split = value.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            obj.value = rupiah;
        }

        function removeRupiahFormat() {
            const hargaInput = document.getElementById('hargaInput');
            hargaInput.value = cleanRupiahValue(hargaInput);
        }

        function cleanRupiahValue(input) {
            return input.value.replace(/\./g, '');
        }

        function handleNextClick() {
            // Panggil fungsi untuk menghapus format rupiah
            removeRupiahFormat();
            // Lanjutkan ke langkah berikutnya
            
        }



        $(function() {
            $('.select2').select2();
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
        // BS-Stepper Init
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
</script>
@endsection