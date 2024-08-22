@extends('layout.layoutLogin')

{{-- @section('judul')
    Login
@endsection --}}

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
      <body class="hold-transition login-page">
        <div class="login-box">
          <!-- /.login-logo -->
          <div class="card card-outline card-primary">
            <div class="card-header text-center">
              <img src="{{ asset('assets/dist/img/KOS.png') }}" alt="AdminLTE Logo" class="brand-image"
              style="width: 50px; height: 50px;">
              <a href="{{ route('login') }}" class="h1"><b>SiKost</a>
            </div>
            <div class="card-body">
              <p class="login-box-msg">Login to start your session</p>
              <form action="{{ route('login-proses') }}" method="post">
                @csrf

                @error('email')
                    <small>{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                  <input type="email" name="email" class="form-control" placeholder="Email">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>

                @error('password')
                    <small>{{ $message }}</small>
                @enderror
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Password">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <!-- /.col -->
                  <div class="col-13">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.login-box -->
      </body>
    </div>
</div>

{{-- Sweet Alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($message = Session::get('succes'))
  <script>
    Swal.fire({
    position: "justify-content-center",
    icon: "success",
    title: '{{ $message }}',
    showConfirmButton: false,
    timer: 1500
    });
  </script>  
@endif

@if ($message = Session::get('failed'))
  <script>
    Swal.fire({
    icon: "error",
    title: "Oops...",
    text: '{{ $message }}',
    });
  </script>  
@endif
@endsection