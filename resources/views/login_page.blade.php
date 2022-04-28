<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="{{ URL::asset('plugins/toastr/toastr.min.css') }} ">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      @if(Session::has('delete_message'))
        <input type="hidden"  class="toastrDefaultError" value="{{ Session::get('delete_message') }}">
      @endif

      <form action="{{ route('login_details') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" placeholder="Email/mobile no">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @if ($errors->has('email'))
                          <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                        @endif
        </div>

        <div class="input-group mb-3">
          <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @if ($errors->has('password'))
                          <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                        @endif
        </div>

        <div class="row">
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
        
      </form>

      <p class="mb-0">
        <a href="{{url('register')}}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script src="{{ URL::asset('plugins/toastr/toastr.min.js') }}"></script>

<script>
$('.toastrDefaultError').click(function() {
      toastr.error($(this).val())
    }).trigger('click');
</script>

 


</body>
</html>
