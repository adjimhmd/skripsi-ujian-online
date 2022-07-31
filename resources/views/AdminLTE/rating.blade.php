@extends('AdminLTE.app')

@section('js-start')

@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    <div class="row">

    <div class="col-5">
      <div class="card">
        

        <div class="card-header">
          @if(Route::currentRouteName()=='rating.instansi')
          
            @if($data_diri->tipe=='sekolah')
              @php($tipe='Sekolah')
              @php($nomor_induk='NPSN')
            @elseif($data_diri->tipe=='lembaga_kursus')
              @php($tipe='Lembaga Kursus')
              @php($nomor_induk='NILEK')
            @endif
            <h3 class="card-title"><b>{{'Data '.$tipe}}</b></h3>
          @elseif(Route::currentRouteName()=='rating.guru')
            <h3 class="card-title"><b>{{'Data Guru'}}</b></h3>
          @endif

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

        @if(Route::currentRouteName()=='rating.guru')
        <div class="card-body">
          
          <!-- Profile Image -->
          <div class="text-center mb-4">
            @if($data_diri->foto!=NULL)
              <img id="output" style="width:100px;" src="{{ '/'.$data_diri->foto }}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
            @else
              <img id="output" style="width:100px;" src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
            @endif
          </div>

          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Nama</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->name}}" disabled>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">NUPTK</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->nuptk}}" disabled>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Jenis Kelamin</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->jenis_kelamin}}" disabled>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Tanggal Lahir</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->tanggal_lahir}}" disabled>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">No. Telepon</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->no_telp}}" disabled>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Spesialisasi</label>
            <div class="col-sm-8">
              @php($isi='')

              @foreach($spesialisasis as $spesialisasi)
                @if ($loop->last)
                  @php($isi=$isi.$spesialisasi->nama)
                @else
                  @php($isi=$isi.$spesialisasi->nama.', ')
                @endif
              @endforeach
              <textarea class="form-control" rows="3" disabled="">{{$isi}}</textarea>
            </div>
          </div>
        </div>
        @elseif(Route::currentRouteName()=='rating.instansi')
        <div class="card-body">
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Nama {{$tipe}}</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->nama}}" disabled>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Jenjang</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->jenjang}}" disabled>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">{{$nomor_induk}}</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->nomor_induk}}" disabled>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Alamat</label>
            <div class="col-sm-8">
              <textarea class="form-control" rows="3" disabled="">{{$data_diri->alamat}}</textarea>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Desa/Kelurahan</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->desa}}" disabled>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Kecamatan</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->kecamatan}}" disabled>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Kabupaten/Kota</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->kota}}" disabled>
            </div>
          </div>
          
          <div class="form-group row">
            <label class="col-sm-4 col-form-label text-md-right">Provinsi</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" value="{{$data_diri->provinsi}}" disabled>
            </div>
          </div>

        </div>
        @endif
        <!-- /.card-body -->

      </div>
    </div>

    <div class="col-7">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><b>{{'Penilaian'}}</b></h3>

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
          <div class="text-center">
            <img style="width:40px;" src="{{asset('img/star-select.png')}}">
            <h5 class="mt-2"><b>Poin {{$poin}}/5</b></h5>
          </div>

          <table id="example1" class="table table-hover table-valign-middle" style="table-layout: fixed">
            <thead style="display: none;">
              <tr>
                <th>Foto</th>
              </tr>
            </thead>
            <tbody>
              @foreach($ratings as $rating)
              <tr>
                <td>
                  <div class="row">
                    <div class="col-1"> 
                      @if($rating->foto==null)
                        <img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class="img-circle" alt="User Image" style="max-width:40px"> 
                      @else
                        <img src="{{'/'.$rating->foto}}" class="img-circle" alt="User Image" style="max-width:40px"> 
                      @endif
                    </div> 
                    <div class="col-11"> 
                      <p style="line-height:15px;margin-bottom:2px;"><b>{{$rating->name}}</b>
                      @if($rating->angka==null)
                        <small>(Tidak ada penilaian.)</small>
                      @else
                        @for($i=0; $i<$rating->angka; $i++)
                          @if($i==0)<img class="ml-2" style="width:10px;" src="{{asset('img/star-select.png')}}">@endif
                          <img style="width:10px;" src="{{asset('img/star-select.png')}}">
                        @endfor
                      @endif<br></p>

                      @if($rating->komentar==null)
                        <small>(Tidak ada komentar.)</small>
                      @else
                        {{$rating->komentar}}
                      @endif
                    </div> 
                  </div>
                </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
    <!-- /.row -->

  </div>


</section>
<!-- /.content -->
@endsection

@section('js-end')

<script type="text/javascript">

  // Preview Foto
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#output').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#img_profile").change(function(){
      readURL(this);
  });
  

  $(document).ready(function() {
    var bla = $('#fp').val();
    if( bla.length > 0 ) {
      $('#img_profile').prop('required',false);
    }

    $('.select2').select2({
      theme: 'bootstrap4',
    })

    
    $('#spesialisasi').select2({
      placeholder: 'Pilih Spesialisasi',
    })

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L',
        maxDate: new Date()
    });
    
  });

  $("form").submit(function() {
      $("#spesialisasi").prop("disabled", false);
  });

  $("#example1").DataTable({
    "dom": 'lrtip',
    "bLengthChange" : false,
    "bInfo":false, 
    "pagingType": 'simple',
    "paging": true,
    "responsive": true, 
    "autoWidth": false,
    "pageLength": 5,
    "scrollCollapse": true
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>

@endsection