<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Adji | 1705551004</title>
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/select2/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
</head>
<body class="hold-transition login-page">
  <div class="login-box">
  @foreach (['danger', 'warning', 'success', 'info'] as $key)
      @if(Session::has($key))
      <!-- Info alert -->
        <div class="alert alert-default-{{ $key }} alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <div class="row">
            <div class="col-md-1 pr-0"><i class="icon fas fa-info"></i></div>
            <div class="col-md-11 pl-0">{{ Session::get($key) }}</div>
          </div>
        </div>
      @endif
  @endforeach
  
    <div class="card">
      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="card-header text-center mt-2">
          <a href="AdminLTE/index2.html" class="h1"><b>Login </b>Ya!</a>
        </div>
        <div class="card-body">

            <!-- email -->
            <div class="input-group mb-3">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Alamat e-mailnya apa?">
              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <!-- password -->
            <div class="input-group mb-3">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password untuk login, jangan sampai lupa">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="row mt-4 mb-3">
              <div class="col-12">
                <button type="submit" class="btn bg-purple btn-block">Login</button>
              </div>
              <!-- /.col -->
            </div>

              <!-- <a href="register.html" class="text-center">Register a new membership</a> -->
              <div class="btn-group">
                <button type="button" class="btn btn- dropdown-toggle dropdown-icon pl-0" data-toggle="dropdown">
                Belum punya akun? Daftar dulu<span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu" role="menu">
                  <a class="dropdown-item" href="{{ route('guru.register') }}">Guru</a>
                  <a class="dropdown-item" href="{{ route('siswa.register') }}">Siswa</a>
                  <a class="dropdown-item" href="{{ route('instansi.register') }}">Lembaga Pendidikan</a>
                </div>
              </div>
        </div>
        <!-- /.form-box -->
      </form>
    </div><!-- /.card -->
  </div>
  <!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
@section('js-start')
<!-- Select2 -->
<script src="{{asset('AdminLTE/plugins/select2/js/select2.full.min.js')}}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({
      theme: 'bootstrap4'
    })
  });
</script>

</body>
</html>
