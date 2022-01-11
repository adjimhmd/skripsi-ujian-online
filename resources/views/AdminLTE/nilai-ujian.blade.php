

@extends('AdminLTE.app')

@section('js-start')
<script type="text/javascript">
    $(window).on('load', function() {
        $('#myModal').modal('show');
    });
</script>
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    
    <!-- Info update nilai -->
    <div class="row mt-2 mb-2">
      <div class="col-12 col-md-12">
        <div class="alert alert-default-primary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <div style="justify-content:flex-start; display: flex;">

            <div style="display:flex; justify-content: center; align-content: center; flex-direction: column; font-size: 2rem;">
              <i class="icon fas fa-info"></i>
            </div>

            <div style="display: table-cell; vertical-align: middle;" class="ml-2">

            @if($last_update_nilai->isEmpty())
                  <b>Siswa yang telah mengerjakan ujian!</b> <br> {{'Jumlah : '.$jumlah_nilai.' orang'}}
            @else
              @foreach($last_update_nilai as $last)
                @if ($loop->first)
                <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> {{'Jumlah siswa yang telah mengerjakan ujian: '.$jumlah_nilai.' orang'}}
                @endif
              @endforeach
            @endif

            </div>

          </div>
          
        </div>
      </div>
    </div>
    <!-- /.row -->

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
    
    <!-- Modal Tahun Ajaran -->
    @if(Route::currentRouteNamed('nilai-ujian.index'))
      <div class="modal hide fade" id="myModal" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog">
          <form method="POST" action="{{ route('nilai-ujian.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">

              <div class="modal-header">
                <h4 class="modal-title">{{'Pilih Tahun Ajaran'}}</h4>
              </div>

              <div class="modal-body">
                
                <div class="row">
                  
                  <!-- tahun ajaran -->
                  <div class="form-group col-12">
                    <label>Tahun Ajaran</label>
                    <select id="tahun_ajaran" name="tahun_ajaran" class="form-control select2bs4 @error('tahun_ajaran') is-invalid @enderror" required>
                      <option value="" selected>Pilih tahun ajaran dulu</option>
                      @foreach($tahun_ajarans as $tahun_ajaran)
                        <option {{old('tahun_ajaran') =="$tahun_ajaran->id" ? "selected" : ""}} value="{{$tahun_ajaran->id}}">{{'TA '.$tahun_ajaran->tahun_awal.'/'.$tahun_ajaran->tahun_akhir.' - Semester '.ucwords($tahun_ajaran->semester)}}</option>
                      @endforeach
                    </select>
                  </div>
                  
                </div>

              </div>

              <div class="modal-footer justify-content-between">
                <input type="submit" value="Tampilkan" id="submit" class="btn bg-purple btn-block">
              </div>

            </div>
            <!-- /.modal-content -->
          </form>
        </div>
        <!-- /.modal-dialog -->
      </div>
    @endif

    <!-- Row Form Input Program Mapel -->
    <div class="row mt-3 mb-2">

      <div class="col-12 col-md-12">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>{{'Data Nilai Siswa'}}</b></h3>

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
            
            <div class="row mb-4">
              <button type="button" class="btn bg-purple shadow-sm" data-toggle="modal" data-target="#modal-default">Ubah Tahun Ajaran</button>
            </div>

            <table id="example3" class="table table-hover" style="table-layout: fixed">
              <thead>
                <tr>
                  <th style="width: 5%; text-align: center;">No</th>
                  <th style="width: 30%;">Data Siswa</th>
                  <th style="width: 30%;">Data Wali Siswa</th>
                  <th style="width: 20%;">Master Kelas</th>
                  <th style="width: 15%; text-align: center;">Nilai</th>
                </tr>
              </thead>
              <tbody>
                @php ($no = 1)

                @if(!Route::currentRouteNamed('nilai-ujian.index'))
                  @foreach($data_siswas as $data_siswa)
                  <tr>
                    <td style="text-align: center;">{{$no++}}</td>
                    <td>
                      <img src="{{'/'.$data_siswa->foto}}" class="img-circle mr-4" alt="User Image" style="max-width:35px"> 
                      {{$data_siswa->name.' '}}<small><b>{{'(NISN: '.$data_siswa->nisn.')'}}</b></small>
                    </td>
                    <td>{{$data_siswa->nama_wali.' '}}<small><b>{{'(e-mail: '.$data_siswa->email_wali.')'}}</b></small></td>
                    <td>{{'Kelas '.$data_siswa->kelas.' '.$data_siswa->tingkat.'/sederajat'}}</td>
                    
                    <form method="POST" action="{{ route('email.nilai') }}" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id_user" value="{{$data_siswa->user_siswa_id}}">
                      <input type="hidden" name="id_tahun_ajaran" value="{{$data_siswa->id_tahun_ajaran}}">
                      <td style="text-align: center;"><center>
                        <a class="btn btn-sm btn-warning shadow-sm" href="{{ route('nilai-ujian.show',$data_siswa->user_siswa_id) }}">Lihat</a>
                        <input class="btn btn-sm bg-purple shadow-sm" type="submit" value="Bagikan" id="submit">
                      </center></td>
                    </form>
                  </tr>
                  @endforeach
                @endif
              </tbody>
            </table>

          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->


        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <form method="POST" action="{{ route('nilai-ujian.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="modal-content">

                <div class="modal-header">
                  <h4 class="modal-title">{{'Pilih Tahun Ajaran'}}</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  
                  <div class="row">
                    
                    <!-- tahun ajaran -->
                    <div class="form-group col-12">
                      <label>Tahun Ajaran</label>
                      <select id="tahun_ajaran2" name="tahun_ajaran" class="form-control select2bs4 @error('tahun_ajaran') is-invalid @enderror" required>
                        <option value="" selected>Pilih tahun ajaran dulu</option>
                        @foreach($tahun_ajarans as $tahun_ajaran)
                          <option {{old('tahun_ajaran') =="$tahun_ajaran->id" ? "selected" : ""}} value="{{$tahun_ajaran->id}}">{{'TA '.$tahun_ajaran->tahun_awal.'/'.$tahun_ajaran->tahun_akhir.' - Semester '.ucwords($tahun_ajaran->semester)}}</option>
                        @endforeach
                      </select>
                    </div>
                    
                  </div>

                </div>

                <div class="modal-footer justify-content-between">
                  <input type="submit" value="Tampilkan" id="submit" class="btn bg-purple btn-block">
                </div>

              </div>
              <!-- /.modal-content -->
            </form>
          </div>
          <!-- /.modal-dialog -->
        </div>

      </div>
      
    </div>
    <!-- /.row -->    

  </div>


</section>
<!-- /.content -->
@endsection

@section('js-end')

<script type="text/javascript">
  
  //Initialize Select2 Elements
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })

  // datatable
  $("#example3").DataTable({
    "paging": true,
    "responsive": true, 
    "autoWidth": false,
    "pageLength": 10,
    "scrollCollapse": true
  }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');


</script>

@endsection