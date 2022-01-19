<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Login Page (v2)</title>

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
  <div class="login-box" style="width: 70%;">
  
    <div class="card">

      <div class="card-header mt-2">
        <a href="AdminLTE/index2.html" class="h3"><b>Halaman </b>Pembayaran</a>
      </div>
      <div class="card-body pb-0 pb-5">

        <div class="row">
          <div class="col-sm-7 pr-4">
              <div class="row col-sm-12 invoice-col">
                <div class="col-sm-6 invoice-col">
                  <b>{{$data->nama_instansi}}</b><br>
                </div>
                <!-- /.col -->
                <div class="col-sm-6 invoice-col text-md-right">
                  {{Carbon\Carbon::now('Asia/Makassar')->isoFormat('dddd, D MMMM Y')}}
                </div>
                <!-- /.col -->
              </div>
              
              <div class="col-sm-12 invoice-col">
                @if($data->tipe=='sekolah') @php($tipe='Sekolah')
                @elseif($data->tipe=='lembaga_kursus') @php($tipe='Lembaga Kursus')
                @endif
                <b>Tipe:</b> {{$tipe}}<br>
                <b>Siswa:</b> {{$nama_siswa->name}}<br><br>
              </div>
              <!-- /.col -->

              <div class="col-12 table-responsive">
                <table class="table">
                  <thead>
                  <tr>
                    <th style="width: 75%;">Deskripsi Kelas</th>
                    <th class="text-md-right">Subtotal</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    @if($data->jurusan!=null) @php($jurusan=' - '.$data->jurusan)
                    @else @php($jurusan='')
                    @endif

                    @if($data->materi!=null or $data->materi!='') @php($materi=ucwords($data->nama).' - '.ucwords($data->materi))
                    @else @php($materi=ucwords($data->nama))
                    @endif
                    <td><strong>{{$data->kelas.' '.$data->tingkat.'/sederajat'.$jurusan}}</strong><br> {{$materi}} </td>
                    <td class="text-md-right">{{'Rp '.number_format($data->harga,0,',',',')}}</td>
                  </tr>
                  <tr>
                    <td class="text-md-right"><strong>Total</strong></td>
                    <td class="text-md-right">{{'Rp '.number_format($data->harga,0,',',',')}}</td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.col -->

          </div>
          <!-- /.col -->
          <div class="col-sm-5 pl-1 pr-4">
              <div class="col-12">
                <p class="lead">Payment Methods:</p>
                <img src="{{asset('AdminLTE/dist/img/credit/visa.png')}}" alt="Visa">
                <img src="{{asset('AdminLTE/dist/img/credit/mastercard.png')}}" alt="Mastercard">
                <img src="{{asset('AdminLTE/dist/img/credit/american-express.png')}}" alt="American Express">
                <img src="{{asset('AdminLTE/dist/img/credit/paypal2.png')}}" alt="Paypal">

                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango.
                </p>
              </div>
              <!-- /.col -->

              <form method="POST" action="{{ route('upload.bayar') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_rombongan_belajar" value="{{$id_rombongan_belajar}}">
                <div class="row">
                  <div class="col-9">
                    
                    <div class="form-group">
                      <!-- <label for="customFile">Custom File</label> -->
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto_bukti" name="foto_bukti" oninput='UpdatePreview()' accept="image/*" required>
                        <label class="custom-file-label" for="foto_bukti">Bukti Pembayaran</label>
                      </div>
                      
                      <span id="err" class="text-danger" role="alert"></span>
                    </div>
                  </div>
                  <!-- /.col -->
                  <div class="col-3">
                    <button class="btn btn-block bg-purple" id="bayar" type="submit">Bayar</button>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-12">
                    <img src="https://visionperfect.com/storage/icon/no-preview.jpeg" id ="frame" alt="test" style="max-height: 150px;">
                </div>
                <!-- /.col -->
              </form>
          </div>
          <!-- /.col -->
        </div>

      </div>
      <!-- /.form-box -->
        
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
  //binds to onchange event of your input field
  $('#foto_bukti').bind('change', function() {
    //this.files[0].size gets the size of your file.
    if(this.files[0].size>512000){
      $('#bayar').prop('disabled', true);
      $('#err').html("<small><strong>File tidak boleh lebih dari 500KB<strong></small>")
    }
    else{
      $('#bayar').prop('disabled', false);
      $('#err').empty()
    }
    // alert(this.files[0].size);
  });

  $(document).ready(function() {
    $('.select2').select2({
      theme: 'bootstrap4'
    })
  });

  function UpdatePreview(){
    $('#frame').attr('src', URL.createObjectURL(event.target.files[0]));
  };
</script>

</body>
</html>
