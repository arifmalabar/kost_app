@extends('layout.layout')

@section('judul')
    Edit Gedung
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card card-default">
                <div class="card-header">
                    <h4 class="card-title">Edit Gedung</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('gedung.update', $gedung->kode_gedung) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="text" class="form-control" name="kode_gedung" value="{{ $gedung->kode_gedung }}"
                                readonly>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            </div>
                            <input type="text" class="form-control" name="nama_gedung" value="{{ $gedung->nama_gedung }}"
                                required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-location-arrow"></i></span>
                            </div>
                            <input type="text" class="form-control" name="alamat_gedung"
                                value="{{ $gedung->alamat_gedung }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('gedung.index') }}" class="btn btn-secondary">Batal</a>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
