@extends('layout.layoutLogin')

@section('judul')
    Login
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
      <body class="hold-transition login-page">
        <div class="login-box">
          <!-- /.login-logo -->
          <div class="card card-outline card-primary">
            <div class="card-header text-center">
              <a href="../../index2.html" class="h1"><b>SiKost</a>
            </div>
            <div class="card-body">
              <p class="login-box-msg">Login to start your session</p>
        
              <form action="../../index3.html" method="post">
                <div class="input-group mb-3">
                  <input type="email" class="form-control" placeholder="Email">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Password">
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
              <small class="d-block text-center mt-2">Not Registered? <a href="/register">Register Now!</a></small>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.login-box -->
      </body>
    </div>
</div>
@endsection