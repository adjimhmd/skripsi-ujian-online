@extends('AdminLTE.app')

@section('js-start')

@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
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
    
    <!-- Info update mapel -->
    <div class="row mt-2 mb-2">
      <div class="col-12 col-md-12">
        <div class="alert alert-default-primary alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <div style="justify-content:flex-start; display: flex;">

            <div style="display:flex; justify-content: center; align-content: center; flex-direction: column; font-size: 2rem;">
              <i class="icon fas fa-info"></i>
            </div>

            <div style="display: table-cell; vertical-align: middle;" class="ml-2">

            @if($last_updates->isEmpty())
                  <b>{{'Data '.$text.' '.$tipe.' Kosong!'}}</b> <br> {{'Jumlah : '.$jumlahs.' '.$text}}
            @else
              @foreach($last_updates as $last)
                @if ($loop->first)
                <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> {{'Jumlah : '.$jumlahs.' '.$text}}
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


    <div class="row mt-3 mb-2">

      <div class="col-12">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>{{'Data '.$text}}</b></h3>

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
              <button type="button" class="btn bg-purple shadow-sm" data-toggle="modal" data-target="#modal-default">Buat {{$text}}</button>
            </div>
            @endif

            <table id="example" class="table table-hover table-valign-middle" style="table-layout: fixed">
              <thead>
                  <tr>
                      <th style="width: 1%; text-align: center;">Kelas</th>
                      <th style="width: 5%; text-align: center;">No</th>
                      <th style="width: 25%;">Nama {{$text}}</th>
                      <th style="width: 25%;">Mata Pelajaran</th>
                      <!-- <th style="width: 33%;">Data Guru</th> -->
                      <th style="width: 15%;">Jumlah Siswa</th>
                      <th style="width: 25%;">Harga</th>
                      <th style="width: 5%; text-align: center;">Aksi</th>
                  </tr>
              </thead>
              <tbody>
                @php ($no = 1)
                @foreach($kelas_programs as $kelas_program)
                  <tr>
                    @if($kelas_program->jurusan!=null) @php($tanda=' - ')
                    @else @php($tanda=' ')
                    @endif

                    @if($kelas_program->materi=='' or $kelas_program->materi==null) @php($materi='')
                    @else @php($materi=' - '.ucwords($kelas_program->materi))
                    @endif
      
                    <td>{{' (Kelas '.$kelas_program->kelas.' '.$kelas_program->tingkat.'/Sederajat'.$tanda.ucwords($kelas_program->jurusan).')'}}</td>

                    <td style="text-align: center;">{{$no++}}</td>
                    <td>{{$kelas_program->deskripsi}}</td>
                    <td>
                      @foreach($mapel_kelas_programs as $mapel_kelas_program)
                        @if($mapel_kelas_program->kelas_program_id==$kelas_program->id_kelas_program)
                          {{'- '.ucwords($mapel_kelas_program->nama)}}<br>
                        @endif
                      @endforeach
                    </td>
                    <!-- <td>
                      @if($kelas_program->user_guru_id==0) 
                        {{'Guru belum ditentukan!'}} <br>
                        <button type="button" class="btn btn-xs bg-secondary btn_guru shadow-sm" data-toggle="modal" data-target="#pilih_guru" 
                        data-id-master-mapel="{{$kelas_program->id_master_mapel }}" data-id-kelas-program="{{$kelas_program->id_kelas_program }}" data-nama="{{$kelas_program->nama }}">Pilih Guru
                        </button>
                      @else 
                        @foreach($nama_gurus as $nama_guru)
                          @if($kelas_program->id_kelas_program==$nama_guru->id_kelas_program)
                            @if($nama_guru->foto==null)
                              <img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class='img-circle mr-2 elevation-1' alt='User Image' style='max-width:50px'>
                            @else
                              <img src="{{'/'.$nama_guru->foto}}" class='img-circle mr-2 elevation-1' alt='User Image' style='max-width:50px'>
                            @endif
                            {{$nama_guru->name}}
                          @endif
                        @endforeach
                      @endif
                    </td> -->
                    <td id="jml_siswa">
                      @php($siswa_pending=0)
                      @php($siswa_terdaftar=0)
                      @foreach($siswa_totals as $siswa_total)
                        @if($siswa_total->kelas_program_id==$kelas_program->id_kelas_program)
                          @if(isset($siswa_total->status))
                            @if($siswa_total->status==0) @php($siswa_pending++)
                            @elseif($siswa_total->status==1) @php($siswa_terdaftar++)
                            @endif
                          @endif
                        @endif
                      @endforeach
                      <small class="badge badge-primary">{{'Terdaftar: '.$siswa_terdaftar}}</small><br>
                      <small class="badge badge-warning">{{'Pending: '.$siswa_pending}}</small>
                    </td>

                    <td>
                      @foreach($harga_kelas_programs as $harga_kelas_program)
                        @if($harga_kelas_program->kelas_program_id==$kelas_program->id_kelas_program)
                          @if($harga_kelas_program->harga===NULL)
                            <b>Harga belum diatur</b>
                            @if (Auth::user()->hasRole('adm_instansi'))
                            <a href="" id="edit" data-toggle="modal" data-id="{{ $harga_kelas_program->id }}" class="btn btn-warning btn-xs shadow-sm mb-2"><i class="fas fa-edit"></i> Edit</a>
                            @elseif (Auth::user()->hasRole('siswa'))
                            <form method='POST' action='{{ route("daftar.siswa") }}' enctype='multipart/form-data' style="display:inline">
                            <!-- <form method='POST' action='{{ route("orders.store") }}' enctype='multipart/form-data' style="display:inline"> -->
                              @csrf
                              <input type='hidden' name='id_kelas_program' value='{{$harga_kelas_program->kelas_program_id}}'>
                              <button type='submit' class='btn bg-purple btn-xs mb-2' disabled><i class='fas fa-check-circle'></i> Pilih</button>
                            </form>
                            @endif<br>
                          @elseif($harga_kelas_program->harga==='0')
                            <b>{{$harga_kelas_program->jumlah_bulan.' bulan: '}}</b>{{'Gratis'}}
                            @if (Auth::user()->hasRole('adm_instansi'))
                            <a href="" id="edit" data-toggle="modal" data-id="{{ $harga_kelas_program->id }}" class="btn btn-warning btn-xs shadow-sm mb-2"><i class="fas fa-edit"></i> Edit</a>
                            @elseif (Auth::user()->hasRole('siswa'))
                            <form method='POST' action='{{ route("daftar.siswa") }}' enctype='multipart/form-data' style="display:inline">
                            <!-- <form method='POST' action='{{ route("orders.store") }}' enctype='multipart/form-data' style="display:inline"> -->
                              @csrf
                              <input type='hidden' name='id_kelas_program' value='{{$harga_kelas_program->kelas_program_id}}'>
                              <button type='submit' class='btn bg-purple btn-xs mb-2'><i class='fas fa-check-circle'></i> Pilih</button>
                            </form>
                            @endif<br>
                          @else
                            <b>{{$harga_kelas_program->jumlah_bulan.' bulan: '}}</b>{{'Rp ' .number_format($harga_kelas_program->harga,0,',',',')}}
                            @if (Auth::user()->hasRole('adm_instansi'))
                            <a href="" id="edit" data-toggle="modal" data-id="{{ $harga_kelas_program->id }}" class="btn btn-warning btn-xs shadow-sm mb-2"><i class="fas fa-edit"></i> Edit</a>
                            @elseif (Auth::user()->hasRole('siswa'))
                            <!-- <form method='POST' action='{{ route("daftar.siswa") }}' enctype='multipart/form-data' style="display:inline"> -->
                            <form method='POST' action='{{ route("orders.store") }}' enctype='multipart/form-data' style="display:inline">
                              @csrf
                              <input type='hidden' name='id_kelas_program' value='{{$harga_kelas_program->kelas_program_id}}'>
                              <input type='hidden' name='id_harga' value='{{$harga_kelas_program->id}}'>
                              <button type='submit' class='btn bg-purple btn-xs mb-2'><i class='fas fa-check-circle'></i> Pilih</button>
                            </form>
                            @endif<br>
                          @endif
                        @endif
                      @endforeach
                    </td>
                    
                    <td style="text-align: center;"><center>
                      @if (Auth::user()->hasRole('siswa'))
                        <a href="{{route('kelas-program.show',$kelas_program->id_kelas_program)}}" class="btn bg-purple btn-sm shadow-sm">Materi</a>
                      @else
                        <a href="{{route('kelas-program.show',$kelas_program->id_kelas_program)}}" class="btn bg-purple btn-sm shadow-sm">Detail</a>
                      @endif
                    </center></td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            
          <!-- modal pilih guru -->
            <div class="modal fade" id="pilih_guru">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">

                  <div class="modal-header border-0">
                    <h5 class="modal-title me-auto" id="judul_modal"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    
                      <div class="row">
                        <div class="col-12 d-flex align-items-stretch flex-column">
                          <table id="tabel_modal" class="table table-hover table-valign-middle" style="table-layout: fixed">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">Data Guru</th>
                                    <th style="width: 15%; text-align: center;">Gender</th>
                                    <th style="width: 25%; text-align: center;">NUPTK</th>
                                    <th style="width: 10%; text-align: center;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="bodyData">

                            </tbody>  
                          </table>
                        </div>
                      </div>

                  </div>

                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

          </div>
          <!-- /.card-body -->
          
          

        </div>
        <!-- /.card -->
      </div>
      
    </div>
    <!-- /.row -->

  </div>


  <!-- Modal Add Data -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah {{$text}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        
        <form method="POST" action="{{ route('kelas-program.store') }}" enctype="multipart/form-data" autocomplete="off">
          @csrf
          <div class="modal-body">
              
            @foreach($user_admin_instansis as $user_admin_instansi)
              <input type="hidden" name="id_instansi" value="{{$user_admin_instansi->id_instansi}}">
            @endforeach
            <!-- form input -->
            <div class="row" id="input_kelas_program">

              <!-- Nama -->
              <div class="form-group col-12">
                <label for="deskripsi">{{ __('Nama '.$text) }}</label>
                <input id="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Namanya apa?"required>

                @error('deskripsi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <!-- kelas -->
              <div class="form-group col-12">
                <label>Kelas</label>
                <select id="kelas" class="form-control select2 @error('kelas') is-invalid @enderror" name="kelas" required autofocus>
                  <option value="" selected disabled>Kelas berapa?</option>
                  @foreach($kelass as $kelas)
                      <option {{old('kelas') =="$kelas->id" ? "selected" : ""}} value="{{$kelas->id}}">{{$kelas->kelas.' '.$kelas->tingkat.' '.ucwords($kelas->jurusan).'/sederajat'}}</option>
                  @endforeach
                </select>
              </div>
              
              <!-- mapel -->
              <div class="form-group col-12">
                <label>Mata Pelajaran</label>
                <select id="mapel" class="select2 form-control @error('mapel') is-invalid @enderror" name="mapel[]" required autofocus multiple="multiple">
                  <!-- <option value="" selected disabled>Mata pelajaran apa?</option> -->
                  @foreach($mapels as $mapel)
                  @if($mapel->materi)
                  @php($spesial=ucwords($mapel->nama).' - '.ucwords($mapel->materi))
                  @else
                  @php($spesial=ucwords($mapel->nama))
                  @endif
                    <option {{(collect(old('mapel'))->contains($mapel->id)) ? "selected" : ""}} value="{{$mapel->id}}">{{$spesial}}</option>
                  @endforeach
                </select>
              </div>

              <!-- Jumlah Harga -->
              <div class="form-group col-12">
                <label for="variasi_harga">{{ __('Jumlah  Variasi Harga') }}</label>
                <input id="variasi_harga" type="number" class="form-control @error('variasi_harga') is-invalid @enderror" name="variasi_harga" value="{{ old('variasi_harga') }}" placeholder="Masukkan jumlah variasi harga" required>

                @error('variasi_harga')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div>

              <!-- Harga -->
              <!-- <div class="form-group col-9">
                <label for="jurusan">{{ __('Harga') }}</label>
                <input id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('jurusan') }}" placeholder="Masukkan harga kelasnya ya" required>

                @error('harga')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
              </div> -->

              <!-- <div class="form-group col-3">
                <label for="addRow" style="color: white;">Button</label>
                <button id="addRow" type="button" class="btn btn-info form-control">Tambah</button>
              </div> -->

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

  <!-- Modal Edit Data -->
  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
      <form id="kelas_program_modal" autocomplete="off">
        <div class="modal-content">

          <div class="modal-header">
            <h4 class="modal-title">Edit {{$text}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
            <div class="modal-body">
              <div class="row">

                <input type="hidden" id="id_harga" name="id_harga" value="">

                <!-- Nama -->
                <div class="form-group col-12">
                  <label for="deskripsi">{{ __('Nama '.$text) }}</label>
                  <input id="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Namanya apa?"required>
                </div>

                <!-- Jumlah Bulan -->
                <div class="form-group col-6">
                  <label for="jumlah_bulan">{{ __('Jumlah Bulan') }}</label>
                  <div class="input-group">
                    <input id="jumlah_bulan" type="number" class="form-control @error('jumlah_bulan') is-invalid @enderror" name="jumlah_bulan" value="{{ old('jumlah_bulan') }}" placeholder="Berapa lama?" required>
                    <div class="input-group-append">
                      <div class="input-group-text"> bulan</div>
                    </div>
                  </div>
                  
                  
                </div>

                <!-- Harga -->
                <div class="form-group col-6">
                  <label for="jurusan">{{ __('Harga') }}</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp.</span>
                    </div>
                    <input id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('jurusan') }}" placeholder="Harga langganan" required>
                  </div>
                </div>

                <div class="form-group col-12">
                  <span id="err" class="text-danger" role="alert"></span>
                </div>

              </div>
            </div>
            <div class="modal-footer justify-content-between mb-2">
              <button id="submit" type="submit" class="btn bg-purple btn-block shadow-sm">Perbarui Data</button>
            </div>
        </div>
        <!-- /.modal-content -->
      </form>
    </div>
    <!-- /.modal-dialog -->
  </div>

</section>
<!-- /.content -->
@endsection

@section('js-end')

<script type="text/javascript">

  // add row
  $("#addRow").click(function () {
      var html = '';
      html += '<div class="form-group col-9">';
      html += '<label for="jurusan">Harga</label>';
      html += '<input id="harga" type="number" class="form-control @error("harga") is-invalid @enderror" name="harga" value="{{ old("jurusan") }}" autocomplete="harga" autofocus placeholder="Masukkan harga kelasnya ya" required>';
      html += '</div>';
      html += '<div class="form-group col-3">';
      html += '<label for="addRow" style="color: white;">Button</label>';
      html += '<button id="removeRow" type="button" class="btn btn-danger form-control">Hapus</button>';
      html += '</div>';

      $('#modal-default #input_kelas_program').append(html);
  });

  $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4',
    })
    
    $('#mapel').select2({
      placeholder: 'Pilih mata pelajaran ya'
    });

    // if($('#jml_siswa').length){
    //   console.log('ada')
    // }
    // else{
    //   console.log('kosong')
    // }

    var groupColumn = 0;
    var table = $('#example').DataTable({
        "paging": true,
        "responsive": true, 
        "autoWidth": false,
        "scrollCollapse": true,
        "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
        "order": [[ 1, 'asc' ]],
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

    // menampilkan tabel guru sesuai mapel
    $('.btn_guru').on('click',function(){
      $("#pilih_guru #bodyData").empty();
      
      var id_master_mapel = $(this).data('id-master-mapel');
      var id_kelas_program = $(this).data('id-kelas-program');
      var nama = $(this).data('nama');
      // alert(id_master_mapel);
      nama = nama.toLowerCase().replace(/\b[a-z]/g, function(letter) {
          return letter.toUpperCase();
      });
      $("#pilih_guru #judul_modal").html("<strong>List Guru Mata Pelajaran "+nama+"</strong>");

      $.ajax({
        url: "{{ route('show.guru') }}",
        type:'POST',
        data: {_token:'{{ csrf_token() }}', id:id_master_mapel},
        cache: false,
        dataType: 'json',
        success: function(dataResult){
          // console.log('dataResult'+dataResult);
          var resultData = dataResult.data;
          var bodyData = '';
          var profil = '';

          if($.isEmptyObject(dataResult.data)){
            Swal.fire(
              'Guru Tidak Tersedia!',
              'Guru mata pelajaran '+nama+' belum tersedia',
              'warning'
            )
          }

          $.each(resultData,function(index,row){
              if(row.foto===null){
                profil="{{asset('AdminLTE/dist/img/default-150x150.png')}}";
              }else{
                profil=row.foto;
              }
              // console.log('row');
              // console.log(row);


              row.name = row.name.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                  return letter.toUpperCase();
              });
              row.jenis_kelamin = row.jenis_kelamin.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                  return letter.toUpperCase();
              });

              bodyData+="<tr>"
              bodyData+="<td class='py-4'><img src="+profil+" class='img-circle mr-4' alt='User Image' style='max-width:50px'>"+row.name+"</td>"+
              "<td class='py-4'><center>"+row.jenis_kelamin+"</center></td>"+
              "<td class='py-4'><center>"+row.nuptk+"</center></td>"+
              "<td class='py-4'><center><button id='btn_pilih_guru'class='btn bg-purple btn-sm' data-id-user-guru='"+row.id_user_guru+"' data-id-kelas-program='"+id_kelas_program+"'><i class='fas fa-check-circle'></i> Pilih</button></center></td>";
              bodyData+="</tr>";
          })

          $("#pilih_guru #bodyData").append(bodyData);

        }
      });  
    
    }); 

    // update guru kelas
    $(document).on("click", "#btn_pilih_guru", function () {
      var id_user_guru = $(this).data('id-user-guru');
      var id_kelas_program = $(this).data('id-kelas-program');
      // alert(id_kelas_program);

      $.ajax({
          url: "{{ route('update.guru') }}",
          type:'POST',
          data: {_token:'{{ csrf_token() }}', id_user_guru:id_user_guru, id_kelas_program:id_kelas_program},
          cache: false,
          dataType: 'json',
          success: function(dataResult){
            window.location.href='/kelas-program'
          }
      });
    }); 

    // kalau ditaruh setelah append, data yg muncul error. Kalau disini pagelength tidak berfungsi
    $("#tabel_modal").DataTable({
      "stateSave": true,
      "bDestroy": true,
      "responsive": true, 
      "autoWidth": false,
      "paging": true,
      "pageLength": 5,
      "scrollCollapse": true
    }).fnDestroy().buttons().container().appendTo('#tabel_modal_wrapper .col-md-6:eq(0)');
          

  });

  $(function(){
    
    // open modal edit
    $('body').on('click', '#edit', function (event) {
      event.preventDefault();

      var id = $(this).data('id');

      $.get('kelas-program/' + id + '/edit', function (data) {
        console.log(data);
        $('#modal-edit #id_harga').val(data.data.id_harga);
        $('#modal-edit #deskripsi').val(data.data.deskripsi);
        $('#modal-edit #harga').val(data.data.harga);
        $('#modal-edit #jumlah_bulan').val(data.data.jumlah_bulan);
        $('#modal-edit').modal('show');
      })
    });
        
    // process update
    $('body').on('click', '#modal-edit #submit', function (event) {
        event.preventDefault()
        
        $("#err").empty()
        var id = $("#modal-edit #id_harga").val();
        var deskripsi = $("#modal-edit #deskripsi").val();
        var harga = $("#modal-edit #harga").val();
        var jumlah_bulan = $("#modal-edit #jumlah_bulan").val();
        // alert(id);
        
        $.ajax({
          url: 'kelas-program/'+id,
          type: 'POST',
          data: {
            _token: "{{ csrf_token() }}",
            _method: "PATCH",
            deskripsi: deskripsi,
            harga: harga,
            jumlah_bulan: jumlah_bulan,
            keterangan: 'update_master',
          },
          dataType: 'json',
          success: function (data) {
            // if($.isEmptyObject(data.error)){
              $('#kelas_program_modal').trigger("reset");
              $('#modal-edit').modal('hide');
              window.location.href = '/kelas-program'
            // }
            // else{
              // console.log(data.error)
              // $("#err").html("<small><strong>" + data.error.jumlah_bulan[0] + data.error.jumlah_bulan[1] + "</strong></small>");
            // }
          }
      });
    });
    
  });

</script>

@endsection