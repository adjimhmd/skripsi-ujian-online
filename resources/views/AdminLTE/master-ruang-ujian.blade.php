@extends('AdminLTE.app')

@section('js-start')

  
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
  @php($tipe='')

  @foreach($user_admin_instansis as $user_admin_instansi)

    @if($user_admin_instansi->tipe=='sekolah')
      @php($tipe='Sekolah')
      @php($nomor_induk='npsn')
      @php($text='Kelas')
    @elseif($user_admin_instansi->tipe=='lembaga_kursus')
      @php($tipe='Lembaga Kursus')
      @php($nomor_induk='nilek')
      @php($text='Program Kursus')
    @endif

  @endforeach

    
  @foreach($ruang_ujians as $ruang_ujian)
    @if($ruang_ujian->tipe=='sekolah')
      @php($text='Kelas')
    @elseif($ruang_ujian->tipe=='lembaga_kursus')
      @php($text='Program Kursus')
    @endif
  @endforeach
    
    <!-- Info update ruang ujian -->
    <div class="row mt-2 mb-2">
      <div class="col-12 col-md-12">
        <div class="alert alert-default-primary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <div style="justify-content:flex-start; display: flex;">

            <div style="display:flex; justify-content: center; align-content: center; flex-direction: column; font-size: 2rem;">
              <i class="icon fas fa-info"></i>
            </div>

            <div style="display: table-cell; vertical-align: middle;" class="ml-2">

            @if($last_update_ruang->isEmpty())
                  <b>Data Ruang Ujian Kosong!</b> <br> {{'Jumlah : '.$ruang_ujians->count().' ruang ujian'}}
            @else
              @foreach($last_update_ruang as $last)
                @if ($loop->first)
                <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> {{'Jumlah : '.$ruang_ujians->count().' ruang ujian'}}
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

    <!-- Row Master Ruang Ujian -->
    <div class="row mt-3 mb-2">

      <div class="col-12">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>{{'List Ruang Ujian'}}</b></h3>

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

            @if (Auth::user()->hasRole('adm_instansi'))
            <div class="row mb-4">
              <button type="button" class="btn bg-purple shadow-sm" data-toggle="modal" data-target="#modal-default">Buat Ruang Ujian</button>
            </div>
            @endif

            <table id="example" class="table table-hover table-valign-middle">
              <thead>
                <tr>
                  <th style="width: 5%; text-align: center;">No</th>
                  @if (Auth::user()->hasRole('guru') or Auth::user()->hasRole('siswa'))
                  <input type="hidden" id="status_guru" value="1">
                  <th style="width: 1%;">Sekolah</th>
                  @endif
                  <th style="width: 55%;">Detail Ruang Ujian</th>
                  <th style="width: 32%;">Pelaksanaan</th>
                  <th style="width: 7%; text-align: center;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php ($no = 1)
                @foreach($ruang_ujians as $ruang_ujian)
                
                  @if($ruang_ujian->jurusan!=null) @php($tanda=' - ')
                  @else @php($tanda=' ')
                  @endif

                  @if($ruang_ujian->materi!=null) @php($tandaa=' - ')
                  @else @php($tandaa=' ')
                  @endif

                <tr>
                  <td style="text-align: center;">{{$no++}}</td>
                  @if (Auth::user()->hasRole('guru') or Auth::user()->hasRole('siswa'))
                  <td>{{$ruang_ujian->nama}}</td>
                  @endif
                  <td>
                    @foreach($mapel_kelas_programs as $mapel_kelas_program)
                      @if($ruang_ujian->master_mapel_id==$mapel_kelas_program->master_mapel_id)
                        @php($nama_mata_pelajaran=$mapel_kelas_program->nama)
                      @endif
                    @endforeach
                    {{$ruang_ujian->ruang_ujian}}<small><b>{{' ('.$text.': '.ucwords($ruang_ujian->deskripsi).' | '.'Mata Pelajaran: '.ucwords($nama_mata_pelajaran).')'}}</b></small><br>
                    {{'Tahun Ajaran '.$ruang_ujian->tahun_awal.'/'.$ruang_ujian->tahun_akhir.' -  Semester '.ucwords($ruang_ujian->semester)}}

                    <!-- <b>{{$text.': '}}</b>{{$ruang_ujian->deskripsi}}
                    @if (Auth::user()->hasRole('adm_instansi') or Auth::user()->hasRole('guru'))
                      <a href="{{route('kelas-program.show',$ruang_ujian->id_kelas_program)}}" class="ml-2 btn btn-xs bg-secondary shadow-sm" >Lihat {{$text ?? "siswa"}}</a>
                    @endif <br> -->

                    <!-- <b>Paket Soal: </b>{{$ruang_ujian->paket_soal}}
                    @if (Auth::user()->hasRole('adm_instansi') || Auth::user()->hasRole('guru'))
                      <a href="{{route('paket_soal.show',$ruang_ujian->id_master_paket_soal)}}" class="ml-2 btn btn-xs bg-secondary shadow-sm" >Lihat soal</a>
                    @endif -->
                  </td>

                  <td>
                    {{Carbon\Carbon::parse($ruang_ujian->waktu_mulai)->isoFormat('dddd, D MMMM Y')}}<small><b>{{' (Pukul: '.Carbon\Carbon::parse($ruang_ujian->waktu_mulai)->isoFormat('hh:mm').' WITA)'}}</b></small><br>

                    <!-- <b>Waktu: </b>{{Carbon\Carbon::parse($ruang_ujian->waktu_mulai)->isoFormat('hh:mm').' WITA'.' - '.Carbon\Carbon::parse($ruang_ujian->waktu_selesai)->isoFormat('hh:mm').' WITA ('.$ruang_ujian->durasi.' menit)'}}<br> -->
                    @if(\Carbon\Carbon::now()->lt($ruang_ujian->waktu_mulai))
                      <span class="badge badge-warning">Ujian belum dimulai</span>
                    @elseif(\Carbon\Carbon::now()->gte($ruang_ujian->waktu_mulai) && \Carbon\Carbon::now()->lte($ruang_ujian->waktu_selesai))
                      <span class="badge badge-success">Ujian sedang berlangsung</span>
                    @elseif(\Carbon\Carbon::now()->gt($ruang_ujian->waktu_selesai))
                      <span class="badge badge-danger">Ujian telah berakhir</span>
                    @endif
                  </td>
                  <td style="text-align: center;">
                    @if (Auth::user()->hasRole('adm_instansi') || Auth::user()->hasRole('guru'))
                      @if (\Carbon\Carbon::now()->lt($ruang_ujian->waktu_mulai))
                        <a href="" class="btn btn-block btn-warning btn-sm shadow-sm" id="edit_ruang_ujian" data-toggle="modal" data-id="{{ $ruang_ujian->id_master_ruang_ujian }}">Edit</a>
                      @endif
                      <a href="{{route('ruang-ujian.show',$ruang_ujian->id_master_ruang_ujian)}}" class="btn btn-block bg-purple btn-sm shadow-sm mt-1" >Detail</a>
                    @elseif (Auth::user()->hasRole('siswa'))
                      @if (\Carbon\Carbon::now()->lt($ruang_ujian->waktu_mulai) or \Carbon\Carbon::now()->gt($ruang_ujian->waktu_selesai))
                        <a href="javascript:void(0)" style="cursor: default;" class="btn btn-block btn-light btn-sm shadow-sm mt-1">Detail</a>
                      @else
                        <a href="{{route('ruang-ujian.show',$ruang_ujian->id_master_ruang_ujian)}}" class="btn btn-block bg-purple btn-sm shadow-sm mt-1">Detail</a>
                      @endif
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
          <!-- /.card-body -->
          
        </div>
        <!-- /.card -->

      </div>

      @if (Auth::user()->hasRole('adm_instansi'))
      <!-- Modal AddEdit Data -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title" id="judul">Buat Ruang Ujian</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>

            <form method="POST" action="{{ route('ruang-ujian.store') }}" enctype="multipart/form-data" id="form_paket_soal" autocomplete="off">
            @csrf

              <div class="modal-body">
                <div class="row">
                  <input type="hidden" id="id_master_ruang_ujian" name="id_master_ruang_ujian" value="">

                  <!-- Nama -->
                  <div class="form-group col-12">
                    <label for="deskripsi">{{ __('Nama Ruang Ujian') }}</label>
                    <input id="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Namanya apa?" required>

                    @error('deskripsi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <!-- Kelas/Program -->
                  <div class="form-group col-12">
                    <label>{{$text ?? ""}}</label>
                    <select id="kelas_program" class="form-control select2 @error('kelas_program') is-invalid @enderror" name="kelas_program" required>
                      <option value="" selected disabled>{{'Pilih '.strtolower($text).'nya ya'}}</option>
                      @foreach($kelas_programs as $kelas_program)
                  
                        @if($kelas_program->jurusan!=null) @php($tanda=' - Jurusan ')
                        @else @php($tanda='')
                        @endif

                        <option {{old('kelas_program') =="$kelas_program->id" ? "selected" : ""}} value="{{$kelas_program->id_kelas_program}}">{{$kelas_program->deskripsi.' | Kelas '.$kelas_program->kelas.' '.$kelas_program->tingkat.'/sederajat'.$tanda.ucwords($kelas_program->jurusan)}}</option>
                          <!-- {{$kelas_program->kelas.' '.$kelas_program->tingkat.'/Sederajat '.$tanda.ucwords($kelas_program->jurusan).' | Mapel '.ucwords($kelas_program->nama).' - '}} -->
                      @endforeach
                    </select>
                  </div>

                  <!-- Keterangan kelas/program -->
                  <!-- @foreach($mapel_kelas_programs as $mapel_kelas_program)
                  <div id="{{'ket_'.$kelas_program->id_kelas_program}}" class="ket_kelas_program form-group col-12 ml-1" style="margin-top:-10px;" hidden>
                    <small><b>{{'Mata Pelajaran: '}}</b>{{ucwords($mapel_kelas_program->nama)}}</small>
                  </div>
                  @endforeach -->

                  <!-- paket soal -->
                  <div class="form-group col-12">
                    <label>Paket Soal</label>
                    <select id="paket_soal" class="form-control select2 @error('paket_soal') is-invalid @enderror" name="paket_soal" required>
                      <option value="" selected disabled>Pilih paket soalnya ya</option>
                    </select>
                  </div>

                  <!-- tahun ajaran -->
                  <div class="form-group col-12">
                    <label>Tahun Ajaran</label>
                    <select id="tahun_ajaran" class="form-control select2 @error('tahun_ajaran') is-invalid @enderror" name="tahun_ajaran" required>
                      <option value="" selected disabled>Pilih tahun ajaran ya</option>
                      @foreach($tahun_ajarans as $tahun_ajaran)
                        <option {{old('tahun_ajaran') =="$tahun_ajaran->id" ? "selected" : ""}} value="{{$tahun_ajaran->id}}">
                          {{'T.A. '.$tahun_ajaran->tahun_awal.'/'.$tahun_ajaran->tahun_akhir.' - Semester '.ucwords($tahun_ajaran->semester)}}
                        </option>
                      @endforeach
                    </select>
                  </div>

                  <!-- Tanggal Mulai -->
                  <div class="form-group col-4">
                    <label for="tanggal_mulai">{{ __('Tanggal Mulai') }}</label>

                    <input id="tanggal_mulai" type="text" onfocus="(this.type='datetime-local')" onblur="(this.type='text')" class="form-control @error('tanggal_mulai') is-invalid @enderror" name="waktu_mulai" value="{{ old('tanggal_mulai') }}" placeholder="Pilih waktu mulai ujiannya ya" required>

                    @error('tanggal_mulai')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <!-- Durasi -->
                  <div class="form-group col-4">
                    <label for="durasi">{{ __('Durasi Ujian') }}</label>
                    <input id="durasi" type="number" class="form-control @error('durasi') is-invalid @enderror" name="durasi" value="{{ old('durasi') }}" placeholder="Satuan menit" required min="1" max="10080">

                    @error('durasi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <!-- Batas Mengulang -->
                  <div class="form-group col-4">
                    <label for="batas">{{ __('Batas Mengulang') }}</label>
                    <input id="batas" type="number" class="form-control @error('batas') is-invalid @enderror" name="batas" value="{{ old('batas') }}" placeholder="Batas mengulang" required min="1" max="10">

                    @error('batas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                </div>
              </div>

              <div class="modal-footer justify-content-between mb-2">
                <button id="submit" type="submit" class="btn bg-purple btn-block shadow-sm">Simpan Data</button>
              </div>

            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      @endif
    </div>
    <!-- /.row -->

  </div>


</section>
<!-- /.content -->
@endsection

@section('js-end')

<script>

  var id_master_paket_soal='';

  $(document).ready(function() {
    if($("#status_guru").val()==='1'){
      var groupColumn = 1;
      var table = $('#example').DataTable({
          "paging": true,
          "responsive": true, 
          "autoWidth": false,
          "scrollCollapse": true,
          "columnDefs": [
              { "visible": false, "targets": groupColumn }
          ],
          "order": [[ groupColumn, 'asc' ]],
          "displayLength": 10,
          "drawCallback": function ( settings ) {
              var api = this.api();
              var rows = api.rows( {page:'current'} ).nodes();
              var last=null;
  
              api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                  if ( last !== group ) {
                      $(rows).eq( i ).before(
                          '<tr class="group bg-light"><td colspan="6">'+group+'</td></tr>'
                      );
  
                      last = group;
                  }
              } );
          }
      } );
  
      // Order by the grouping
      $('#example tbody').on( 'click', 'tr.group', function () {
          var currentOrder = table.order()[0];
          if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
              table.order( [ groupColumn, 'desc' ] ).draw();
          }
          else {
              table.order( [ groupColumn, 'asc' ] ).draw();
          }
      });
    }
    else{
      $("#example").DataTable({
        "paging": true,
        "responsive": true, 
        "autoWidth": false,
        "pageLength": 10,
        "scrollCollapse": true
      }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
    }

    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    })

    $('#modal-default').on('hidden.bs.modal', function () {
      $("#modal-default #judul").html("Buat Ruang Ujian");
    })

    // open modal edit
    $('body').on('click', '#edit_ruang_ujian', function (event) {

      event.preventDefault();
      var id = $(this).data('id');
      $("#modal-default #judul").html("Edit Ruang Ujian");

      $.get('ruang-ujian/' + id + '/edit', function (data) {
          id_master_paket_soal=data.data.id_master_paket_soal;

          $('#modal-default #id_master_ruang_ujian').val(data.data.id_master_ruang_ujian);
          $('#modal-default #deskripsi').val(data.data.deskripsi);
          $('#modal-default #kelas_program').val(data.data.id_kelas_program).change();
          // $('#modal-default #paket_soal').val(data.data.id_master_paket_soal).change();
          $('#modal-default #durasi').val(data.data.durasi);
          $('#modal-default #tanggal_mulai').val(data.data.waktu_mulai);
          $('#modal-default').modal('show');    
      });
          
      // process update
      $('body').on('click', '#modal-default #submit', function (event) {
          event.preventDefault()
          
          var id = $("#modal-default #id_master_ruang_ujian").val();
          var deskripsi = $("#modal-default #deskripsi").val();
          var id_kelas_program = $("#modal-default #kelas_program").val();
          var id_master_paket_soal = $("#modal-default #paket_soal").val();
          var durasi = $("#modal-default #durasi").val();
          var waktu_mulai = $("#modal-default #tanggal_mulai").val();

          $.ajax({
            url: 'ruang-ujian/' + id,
            type: 'POST',
            data: {
              _method: "PUT",
              deskripsi: deskripsi,
              id_kelas_program: id_kelas_program,
              id_master_paket_soal: id_master_paket_soal,
              durasi: durasi,
              waktu_mulai: waktu_mulai,
            },
            dataType: 'json',
            success: function (data) {
                $('#modal-default').modal('hide');
                window.location.href = '/ruang-ujian'
                $('#form_paket_soal').trigger("reset");
            }
        });
      });
      

    });
  });

  $(function () {

    // csrf edit 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  });

  // tampilkan paket soal
  $('#kelas_program').on('change', function () {
    $(".ket_kelas_program").attr('hidden',true);
    $("#ket_"+$(this).val()).attr('hidden',false);

    $.ajax({
      url: "{{ route('show.paket') }}",
      type:'POST',
      data: {_token:'{{ csrf_token() }}', id: $(this).val()},
      cache: false,
      dataType: 'json',
      success: function(dataResult){
        var resultData = dataResult.data;

        $("#paket_soal").empty();
        $("#paket_soal").append('<option value=""selected disabled>Pilih paket soalnya ya</option>');
        
        $.each(resultData,function(index,row){
          console.log(row);

          $("#paket_soal").append('<option value="'+row.id+'">'+row.deskripsi+'</option>');
          // $('#modal-default #paket_soal').val(id_master_paket_soal).change();

        })


      }
    });  

  });
  

</script>


@endsection