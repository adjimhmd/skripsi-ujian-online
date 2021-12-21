@extends('AdminLTE.app')

@section('js-start')

@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">

    <!-- Info update mapel -->
    @foreach (['danger', 'warning', 'success', 'info'] as $key)
      @if(Session::has($key))
      <div class="row mt-2 mb-2">
        <div class="col-12 col-md-12">
          <div class="alert alert-default-{{ $key }} alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <div style="justify-content:flex-start; display: flex;">

              <div style="display:flex; justify-content: center; align-content: center; flex-direction: column;">
                <i class="icon fas fa-info"></i>
              </div>

              <div style="display: table-cell; vertical-align: middle;" class="ml-2">{{ Session::get($key) }}</div>

            </div>
            
          </div>
        </div>
      </div>
      @endif
    @endforeach

    
  @foreach($user_admin_instansis as $user_admin_instansi)

    @if($user_admin_instansi->tipe=='sekolah')
      @php($tipe='Sekolah')
      @php($nomor_induk='npsn')
      @php($text='Kelas')
    @elseif($user_admin_instansi->tipe=='lembaga_kursus')
      @php($tipe='Lembaga Kursus')
      @php($nomor_induk='nilek')
      @php($text='Program')
    @endif

  @endforeach

    <div class="row">
      <div class="col-md-12">
      @foreach($user_admin_instansis as $user_admin_instansi)

        <form class="form-horizontal" method="POST" action="{{ route('instansi-pendidikan.update',$user_admin_instansi->id_instansi) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')

          <input type="hidden" name="tipe" value="{{$user_admin_instansi->tipe}}">
          <div class="card shadow-sm">

            <div class="card-header">
              <h3 class="card-title"><b>{{'Data '.$tipe}}</b></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="maximize">
                  <i class="fas fa-expand"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            
            </div>
            <!-- /.card-header -->

            <div class="card-body">


                <div class="form-group row mb-0">

                  <!-- nama -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Nama {{$tipe}}</label>
                      <input id="nama_instansi" type="text" class="form-control @error('nama_instansi') is-invalid @enderror" name="nama_instansi" value="{{ old('nama_instansi', $user_admin_instansi->nama)}}"  autocomplete="nama_instansi" autofocus placeholder="Apa nama {{$tipe}}?" required>

                      @error('nama_instansi')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  
                  <!-- jenjang -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Jenjang</label>
                      <select id="jenjang" class="form-control select2 @error('jenjang') is-invalid @enderror" name="jenjang" autofocus required>
                        @php ($list_jenjang = ['SD','SMP','SMA','UMUM'])
                        <option value="" selected disabled>Pilih jenjang {{strtolower($tipe)}}mu yaa?</option>
                        @foreach($list_jenjang as $select_jenjang)
                            <option {{old('jenjang', $user_admin_instansi->jenjang) =="$select_jenjang" ? "selected" : ""}} value="{{$select_jenjang}}">{{$select_jenjang}}</option>
                        @endforeach

                        @error('jenjang')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </select>
                    </div>
                  </div>

                  <!-- nomor_induk -->
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>{{strtoupper($nomor_induk)}}</label>
                      <input id="nomor_induk" type="number" class="form-control @error('nomor_induk') is-invalid @enderror" name="nomor_induk" value="{{ old('nomor_induk', $user_admin_instansi->nomor_induk) }}" autocomplete="nomor_induk" autofocus placeholder="Berapa {{strtoupper($nomor_induk)}}nya?" required>

                      @error('nomor_induk')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>

                  <!-- Alamat Instansi -->
                  <div class="col-md-12">
                    <div class="form-group"> 
                      <label>Alamat {{$tipe}}</label>
                      <textarea id="alamat_instansi" class="form-control @error('alamat_instansi') is-invalid @enderror" name="alamat_instansi" rows="2" autocomplete="alamat_instansi" autofocus placeholder="Alamat {{strtolower($tipe)}}nya dimana? Masukan yang lengkap" required>{{ old('alamat_instansi', $user_admin_instansi->alamat) }}</textarea>

                      @error('alamat_instansi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <!-- Provinsi -->
                    <div class="form-group">
                      <label>Provinsi</label>
                      <select id="provinsi" class="form-control select2 @error('provinsi') is-invalid @enderror" name="provinsi" autofocus required>
                        <option value="" selected disabled>Alamatnya di provinsi mana?</option>
                        @foreach($provinces as $id => $name)
                          @if(!empty($detail_alamats))
                            @foreach($detail_alamats as $detail_alamat)
                            <option {{old('provinsi', $detail_alamat->id_province) =="$id" ? "selected" : ""}} value="{{$id}}">{{ucwords(strtolower($name))}}</option>
                            @endforeach
                          @endif
                          <option {{old('provinsi') =="$id" ? "selected" : ""}} value="{{$id}}">{{ucwords(strtolower($name))}}</option>
                        @endforeach
                      </select>

                      @error('provinsi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <!-- Kota -->
                    <div class="form-group">
                      <label>Kabupaten/Kota</label>
                      <select id="kota" class="form-control select2 @error('kota') is-invalid @enderror" name="kota" autofocus required>
                        <option value="" selected disabled>Kota/kabupaten mana?</option>
                        @if(!empty($cities))
                          @foreach($cities as $city)
                            @if(!empty($detail_alamats))
                              @foreach($detail_alamats as $detail_alamat)
                              <option {{old('kota', $detail_alamat->id_city) =="$city->id_city" ? "selected" : ""}} value="{{$city->id_city}}">{{ucwords(strtolower($city->city))}}</option>
                              @endforeach
                            @endif
                          @endforeach
                        @endif
                      </select>

                      @error('kota')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <!-- Kecamatan -->
                    <div class="form-group">
                      <label>Kecamatan</label>
                      <select id="kecamatan" class="form-control select2 @error('kecamatan') is-invalid @enderror" name="kecamatan" autofocus required>
                        <option value="" selected disabled>Kecamatan mana?</option>
                        @if(!empty($districts))
                          @foreach($districts as $district)
                            @if(!empty($detail_alamats))
                              @foreach($detail_alamats as $detail_alamat)
                              <option {{old('kecamatan', $detail_alamat->id_district) =="$district->id_district" ? "selected" : ""}} value="{{$district->id_district}}">{{ucwords(strtolower($district->district))}}</option>
                              @endforeach
                            @endif
                          @endforeach
                        @endif
                      </select>

                        @error('kecamatan')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <!-- Desa -->
                    <div class="form-group">
                      <label>Desa</label>
                      <select id="desa" class="form-control select2 @error('desa') is-invalid @enderror" name="desa" autofocus required>
                        <option value="" selected disabled>Desa/kelurahan mana?</option>
                        @if(!empty($villages))
                          @foreach($villages as $village)
                            @if(!empty($detail_alamats))
                              @foreach($detail_alamats as $detail_alamat)
                              <option {{old('desa', $detail_alamat->id_village) =="$village->id_village" ? "selected" : ""}} value="{{$village->id_village}}">{{ucwords(strtolower($village->village))}}</option>
                              @endforeach
                            @endif
                          @endforeach
                        @endif

                        @error('desa')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </select>
                    </div>
                  </div>

                </div>               
                
                <div class="form-group row mt-4">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-block bg-purple">Simpan Data</button>
                  </div>
                </div>


            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </form>
          
      @endforeach

      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->

  </div>


</section>
<!-- /.content -->
@endsection

@section('js-end')

<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    })
  });


  // tampilkan kabupaten, kecamatan, desa
    $('#provinsi').on('change', function () {
      localStorage.setItem("select_provinsi", $('#provinsi').find(":selected").val());
      
      axios.post("{{ route('show.kota') }}", {id: $(this).val()})
      .then(function (response) {
        $("#kota").empty();
        $('#kota').append('<option value="" selected disabled>Kota/kabupaten mana?</option>')

        $.each(response.data, function (id, name) {
          var splitStr = name.toLowerCase().split(' ');
          for (var i = 0; i < splitStr.length; i++) {
              splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
          }
          $('#kota').append(new Option(splitStr.join(' '), id))
        });
      });
    });
      
    $('#kota').on('change', function () {
      localStorage.setItem("select_kota", $('#kota').find(":selected").val());

      axios.post('{{ route('show.kecamatan') }}', {id: $(this).val()})
      .then(function (response) {
        $("#kecamatan").empty();
        $('#kecamatan').append('<option value="" selected disabled>Kecamatan mana?</option>')

        $.each(response.data, function (id, name) {
          var splitStr = name.toLowerCase().split(' ');
          for (var i = 0; i < splitStr.length; i++) {
              splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
          }
          $('#kecamatan').append('<option value="'+id+'">'+splitStr.join(' ')+'</option>');
        })
      });
    });
      
    $('#kecamatan').on('change', function () {
      localStorage.setItem("select_kecamatan", $('#kecamatan').find(":selected").val());

      axios.post('{{ route('show.desa') }}', {id: $(this).val()})
      .then(function (response) {
        $("#desa").empty();
        $('#desa').append('<option value="" selected disabled>Desa/Keluarahan mana?</option>')

        $.each(response.data, function (id, name) {
          var splitStr = name.toLowerCase().split(' ');
          for (var i = 0; i < splitStr.length; i++) {
              splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
          }
          $('#desa').append('<option value="'+id+'">'+splitStr.join(' ')+'</option>');
        })
      });
    });

    $('#desa').on('change', function () {
      localStorage.setItem("select_desa", $('#desa').find(":selected").val());
    });

    
    $(document).ready(function() {
      // window.performance.navigation.type akan mereturns nilai berikut
      // 0 => user just typed in an Url
      // 1 => page reloaded
      // 2 => back button clicked.
      // Validasi laravel kalau salah, return nya 0
      // if(window.performance.navigation.type === 0){
      //   alert('gaha')
      // }
      if($('#provinsi').val()!==null){
        var v_provinsi = localStorage.getItem("select_provinsi");
        var v_kota = localStorage.getItem("select_kota");
        var v_kecamatan = localStorage.getItem("select_kecamatan");
        var v_desa = localStorage.getItem("select_desa");

        axios.post('{{ route('show.kota') }}', {id: v_provinsi})
        .then(function (response) {
          $.each(response.data, function (id, name) {
            var splitStr = name.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
            }
            if(v_kota==id){
              $('#kota').append('<option value="' + id + '" selected="selected">' +splitStr.join(' ')+ '</option>');
            }
            else{
              $('#kota').append('<option value="' + id + '">' +splitStr.join(' ')+ '</option>');
            }
          });
        });

        axios.post('{{ route('show.kecamatan') }}', {id: v_kota})
        .then(function (response) {
          $.each(response.data, function (id, name) {
            var splitStr = name.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
            }
            if(v_kecamatan==id){
              $('#kecamatan').append('<option value="' + id + '" selected="selected">' +splitStr.join(' ')+ '</option>');
            }
            else{
              $('#kecamatan').append('<option value="' + id + '">' +splitStr.join(' ')+ '</option>');
            }
          });
        });

        axios.post('{{ route('show.desa') }}', {id: v_kecamatan})
        .then(function (response) {
          $.each(response.data, function (id, name) {
            var splitStr = name.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
            }
            if(v_desa==id){
              $('#desa').append('<option value="' + id + '" selected="selected">' +splitStr.join(' ')+ '</option>');
            }
            else{
              $('#desa').append('<option value="' + id + '">' +splitStr.join(' ')+ '</option>');
            }
          });
        });

      }
      
      

    });
    
</script>

@endsection