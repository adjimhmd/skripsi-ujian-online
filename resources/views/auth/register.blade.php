<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

</head>
<body class="hold-transition register-page">
<div class="register-box" style="width: 35%;">
  <div class="card">
    @if(Route::currentRouteNamed('guru.register'))
    <form method="POST" action="{{ route('guru.proses') }}" enctype="multipart/form-data">
      @csrf

      <div class="card-header text-center mt-3">
        <a href="/home" class="h1"><b>Register </b>Guru</a>
      </div>
      <div class="card-body">

          <!-- nama -->
          <div class="input-group mb-3">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Siapa nama kamu?">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

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
            <!-- <span class="text-danger error-text password_err"></span> -->
          </div>

          <!-- password -->
          <div class="input-group mb-3">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang passwordnya, untuk memastikan">
          </div>

          <!-- spesialisasi -->
          <div class="input-group mb-3 tambah_kelas" id="tambah_kelas_1">
              <select id="spesialisasi" name="spesialisasi[]" value="{{ old('spesialisasi[]') }}" class="select2 form-control spesialisasi" multiple="multiple" data-placeholder="Pilih spesialisasinya ya" required>
              <!-- <option value="" selected disabled>Pilih Spesialisasi</option> -->
              @foreach($list_spesialisasi as $select_spesialisasi)
              @php($materi='')
              @if($select_spesialisasi->materi)
                @php($materi=' - '.ucwords($select_spesialisasi->materi))
              @endif
                  <option {{(collect(old('spesialisasi'))->contains($select_spesialisasi->id)) ? "selected" : ""}} value="{{$select_spesialisasi->id}}">
                      {{ucwords($select_spesialisasi->nama).$materi}}
                  </option>
              @endforeach
              </select>
          </div>

          <!-- button register -->
          <div class="row mt-4 mb-3">
            <div class="col-12">
              <button type="submit" class="btn bg-purple btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
          
          <!-- link login -->
          <div class="row">
            <div class="col-12">
              <a href="{{ route('login') }}"><p class="text-center">Sudah punya akun? Login ya!</p></a>
            </div>
          </div>
      </div>
      <!-- /.form-box -->
    </form>
    @elseif(Route::currentRouteNamed('siswa.register'))
    <form method="POST" action="{{ route('siswa.proses') }}" enctype="multipart/form-data">
      @csrf

      <div class="card-header text-center mt-3">
        <a href="/home" class="h1"><b>Register </b>Siswa</a>
      </div>
      <div class="card-body">

          <!-- nama -->
          <div class="input-group mb-3">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Siapa nama kamu?">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

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

          <!-- password -->
          <div class="input-group mb-3">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang passwordnya, untuk memastikan">
          </div>

          <!-- kelas -->
          <div class="input-group mb-3">
            <select id="kelas" name="kelas" value="{{ old('kelas') }}" class="select2 form-control @error('kelas') is-invalid @enderror" required>
            <option value="" selected disabled>Pilih Kelas</option>
            @foreach($list_kelas as $select_kelas)
                <option {{old('kelas') =="$select_kelas->id" ? "selected" : ""}} value="{{$select_kelas->id}}">
                    @if($select_kelas->jurusan==NULL)
                        {{$select_kelas->kelas.' '.$select_kelas->tingkat.'/sederajat'}}
                    @else
                        {{$select_kelas->kelas.' '.$select_kelas->tingkat.'/sederajat - '.$select_kelas->jurusan}}
                    @endif
                </option>
            @endforeach
            </select>
          </div>

          <!-- button register -->
          <div class="row mt-4 mb-3">
            <div class="col-12">
              <button type="submit" class="btn bg-purple btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
          
          <!-- link login -->
          <div class="row">
            <div class="col-12">
              <a href="{{ route('login') }}"><p class="text-center">Sudah punya akun? Login ya!</p></a>
            </div>
          </div>
          
      </div>
      <!-- /.form-box -->
    </form>
    @elseif(Route::currentRouteNamed('instansi.register'))
    <form method="POST" action="{{ route('instansi.proses') }}" enctype="multipart/form-data">
      @csrf

      <div class="card-header text-center mt-3">
        <a href="/home" class="h1"><b>Register </b>Instansi</a>
      </div>
      <div class="card-body">

          <!-- nama -->
          <div class="input-group mb-3">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Siapa nama kamu?">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

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

          <!-- password -->
          <div class="input-group mb-3">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Ketik ulang passwordnya, untuk memastikan">
          </div>

          <!-- Tipe Instansi Pendidikan -->
          <h6>{{ __('Tipe Instansi Pendidikan') }}</h6>
          <div class="input-group mb-3">
            @php ($list_instansi = ['Sekolah','Lembaga_Kursus'])
            @php ($i = 1)
            @foreach($list_instansi as $select_instansi)
            <div class="custom-control custom-radio">
                <input class="custom-control-input" type="radio" id="tipe_instansi_{{$i}}" name="tipe_instansi" required autofocus value="{{$select_instansi}}" {{old('tipe_instansi') =="$select_instansi" ? "checked" : ""}}>
                <label for="tipe_instansi_{{$i++}}" class="custom-control-label pr-4">{{preg_replace('/_/', ' ', $select_instansi)}}</label>
            </div>
            @endforeach

            @error('tipe_instansi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>

          <!-- button register -->
          <div class="row mt-4 mb-3">
            <div class="col-12">
              <button type="submit" class="btn bg-purple btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
          
          <!-- link login -->
          <div class="row">
            <div class="col-12">
              <a href="{{ route('login') }}"><p class="text-center">Sudah punya akun? Login ya!</p></a>
            </div>
          </div>
          
      </div>
      <!-- /.form-box -->
    </form>
    @endif
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('AdminLTE/plugins/select2/js/select2.full.min.js')}}"></script>

<script type="text/javascript">
  // Select2
  $(document).ready(function() {
    $('.select2').select2({
      theme: 'bootstrap4',
    })
  });

</script>

</body>
</html>
