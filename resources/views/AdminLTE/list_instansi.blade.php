@extends('AdminLTE.app')

@section('js-start')

  
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    
    <!-- Info update instansi -->
    <div class="row mt-2 mb-2">
      <div class="col-12 col-md-12">
        <div class="alert alert-default-primary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <div style="justify-content:flex-start; display: flex;">

            <div style="display:flex; justify-content: center; align-content: center; flex-direction: column; font-size: 2rem;">
              <i class="icon fas fa-info"></i>
            </div>

            <div style="display: table-cell; vertical-align: middle;" class="ml-2">
                @if($last_update->isEmpty())
                  <b>Instansi pendidikan kosong!</b> <br> {{$list_sekolah->count().' Sekolah, '.$list_lembaga_kursus->count().' Lembaga Kursus'}}
                @else
                  @foreach($last_update as $last)
                    @if ($loop->first)
                    <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> {{$list_sekolah->count().' Sekolah, '.$list_lembaga_kursus->count().' Lembaga Kursus'}}
                    @endif
                  @endforeach
                @endif
            </div>
          </div>
          
        </div>
      </div>
    </div>
    
    <!-- Data Instansi Pendidikan -->
    <div class="row mt-2 mb-2">
      <div class="col-md-12">
        <div class="card">
          
          <div class="card-header">
            @if (Auth::user()->hasRole('siswa'))              
              @if($siswa->kelas>=1 and $siswa->kelas<=6)
                @php($tingkat='('.$siswa->kelas.' SD/sederajat)')
              @elseif($siswa->kelas>=7 and $siswa->kelas<=9)
                @php($tingkat='('.$siswa->kelas.' SMP/sederajat)')
              @elseif($siswa->kelas>=10 and $siswa->kelas<=12)
                @php($tingkat='('.$siswa->kelas.' SMA/sederajat)')
              @endif
            @endif
            <h3 class="card-title"><b>Data Lembaga Pendidikan <small><i>{{$tingkat ?? ''}}</i></small></b></h3>

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

            @if (Auth::user()->hasRole('guru'))
            <div class="row mb-4">
              <button type="button" class="btn btn-warning shadow-sm btn_terima_guru ml-2" data-toggle="modal" data-target="#modal-default" data-id-guru="{{$id_guru->id}}">Penawaran<span class="badge bg-success ml-1">{{$jumlah_tawaran}}</span></button>
            </div>
            @endif

            <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
            <div id="accordion">
              

              <!-- list sekolah -->
              <div class="card card-light">

                <div class="card-header">
                  <h4 class="card-title w-100">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <b>List Sekolah</b>
                    </a>
                  </h4>
                </div>

                <div id="collapseOne" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                  <table id="example1" class="table table-hover table-valign-middle"style="table-layout: fixed">
                      <thead>
                        <tr>
                          <th style="width: 3%; text-align: center;">No</th>
                          <th style="width: 30%;">Nama</th>
                          <th style="width: 55%;">Alamat</th>
                          <th style="width: 12%; text-align: center;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php ($no = 1)
                        @foreach($list_sekolah as $select_sekolah)
                        <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td>
                            <b>{{ $select_sekolah->instansi }}</b>
                            <span class="badge bg-purple ml-1">{{$select_sekolah->jenjang.'/sederajat'}}</span>
                            <br>{{'NPSN: '.$select_sekolah->nomor_induk}}
                          </td>
                          <td>
                            <strong>{{ ucwords($select_sekolah->alamat) }}</strong><br>
                            {{ ucwords(strtolower($select_sekolah->desa)).' - '.ucwords(strtolower($select_sekolah->kecamatan)).' - '.ucwords(strtolower($select_sekolah->kota)).' - '.ucwords(strtolower($select_sekolah->provinsi)) }}
                          </td>
                          <td><center>
                            @if (Auth::user()->hasRole('siswa'))
                              <form method='POST' action="{{ route('show.kelas_program') }}" enctype='multipart/form-data'>
                                @csrf
                                <input type="hidden" name="id_instansi" value="{{$select_sekolah->id}}">
                                <input type="hidden" name="id_master_kelas" value="{{$siswa->master_kelas_id}}">
                                <button type="submit" class="btn btn-sm bg-purple"><i class="fas fa-info-circle"></i> Detail</button>

                              <!-- <button type="button" class="btn btn-sm bg-purple btn_pilih" data-toggle="modal" data-target="#pilih_guru" 
                                data-id-instansi="{{$select_sekolah->id}} " 
                                data-nama-instansi="{{$select_sekolah->instansi}}" 
                                data-tipe-instansi="{{$select_sekolah->tipe}}" 
                                data-id-siswa="{{$siswa->id}}"
                                data-master-kelas-id="{{$siswa->master_kelas_id}}" >
                                <i class="fas fa-info-circle"></i> Detail
                              </button> -->

                            @elseif (Auth::user()->hasRole('guru'))
                              <form method='POST' action="{{ route('simpan.guru') }}" enctype='multipart/form-data'>
                                @csrf
                                <input type="hidden" name="id_instansi" value="{{$select_sekolah->id}}">
                                <button type="submit" class="btn btn-sm btn-secondary" disabled> Daftar</button>
                            @endif
                            
                                <a href="{{route('rating.instansi',$select_sekolah->id)}}" type="button" class="btn btn-warning btn-sm shadow-sm">Lihat</a>
                              </form>
                          </center></td>
                        </tr>
                        @endforeach

                        @if($list_sekolah_semua)
                        @foreach($list_sekolah_semua as $select_sekolah)
                        <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td>
                            <b>{{ $select_sekolah->instansi }}</b>
                            <span class="badge bg-purple ml-1">{{$select_sekolah->jenjang.'/sederajat'}}</span>
                            <br>{{'NPSN: '.$select_sekolah->nomor_induk}}
                          </td>
                          <td>
                            <strong>{{ ucwords($select_sekolah->alamat) }}</strong><br>
                            {{ ucwords(strtolower($select_sekolah->desa)).' - '.ucwords(strtolower($select_sekolah->kecamatan)).' - '.ucwords(strtolower($select_sekolah->kota)).' - '.ucwords(strtolower($select_sekolah->provinsi)) }}
                          </td>
                          <td><center>
                              <form method='POST' action="{{ route('simpan.guru') }}" enctype='multipart/form-data'>
                                @csrf
                                <input type="hidden" name="id_instansi" value="{{$select_sekolah->id}}">
                                <button type="submit" class="btn btn-sm bg-purple"> Daftar</button>
                                <a href="{{route('rating.instansi',$select_sekolah->id)}}" type="button" class="btn btn-warning btn-sm shadow-sm">Lihat</a>
                              </form>
                          </center></td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
              
              <!-- list lembaga kursus -->
              <div class="card card-light">
                <div class="card-header">
                  <h4 class="card-title w-100">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <b>List Lembaga Kursus</b>
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                  <table id="example2" class="table table-hover table-valign-middle"style="table-layout: fixed">
                      <thead>
                        <tr>
                          <th style="width: 3%; text-align: center;">No</th>
                          <th style="width: 30%;">Nama</th>
                          <th style="width: 55%;">Alamat</th>
                          <th style="width: 12%; text-align: center;">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php ($no = 1)
                        @foreach($list_lembaga_kursus as $select_kursus)
                        <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td>
                            <b>{{ $select_kursus->instansi }}</b>
                            <span class="badge bg-purple ml-1">{{$select_kursus->jenjang.'/sederajat'}}</span>
                            <br>{{'NILEK: '.$select_kursus->nomor_induk}}
                          </td>
                          <td>
                            <strong>{{ ucwords($select_kursus->alamat) }}</strong><br>
                            {{ ucwords(strtolower($select_kursus->desa)).' - '.ucwords(strtolower($select_kursus->kecamatan)).' - '.ucwords(strtolower($select_kursus->kota)).' - '.ucwords(strtolower($select_kursus->provinsi)) }}
                          </td>
                          <td><center>
                            @if (Auth::user()->hasRole('siswa'))
                              <form method='POST' action="{{ route('show.kelas_program') }}" enctype='multipart/form-data'>
                                @csrf
                                <input type="hidden" name="id_instansi" value="{{$select_kursus->id}}">
                                <input type="hidden" name="id_master_kelas" value="{{$siswa->master_kelas_id}}">
                                <button type="submit" class="btn btn-sm bg-purple"><i class="fas fa-info-circle"></i> Detail</button>
                              <!-- <button type="button" class="btn btn-sm bg-purple btn_pilih" data-toggle="modal" data-target="#pilih_guru" 
                                data-id-instansi="{{$select_kursus->id}} " 
                                data-nama-instansi="{{$select_kursus->instansi}}" 
                                data-tipe-instansi="{{$select_kursus->tipe}}" 
                                data-id-siswa="{{$siswa->id}}"
                                data-master-kelas-id="{{$siswa->master_kelas_id}}" >
                                <i class="fas fa-info-circle"></i> Detail
                              </button> -->

                            @elseif (Auth::user()->hasRole('guru'))
                              <form method='POST' action="{{ route('simpan.guru') }}" enctype='multipart/form-data'>
                                @csrf
                                <input type="hidden" name="id_instansi" value="{{$select_kursus->id}}">
                                <button type="submit" class="btn btn-sm btn-secondary" disabled> Daftar</button>
                            @endif
                            
                                <a href="{{route('rating.instansi',$select_kursus->id)}}" type="button" class="btn btn-warning btn-sm shadow-sm">Lihat</a>
                              </form>
                          </center></td>
                        </tr>
                        @endforeach

                        @if($list_lembaga_kursus_semua)
                        @foreach($list_lembaga_kursus_semua as $select_kursus)
                        <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td>
                            <b>{{ $select_kursus->instansi }}</b>
                            <span class="badge bg-purple ml-1">{{$select_kursus->jenjang.'/sederajat'}}</span>
                            <br>{{'NILEK: '.$select_kursus->nomor_induk}}
                          </td>
                          <td>
                            <strong>{{ ucwords($select_kursus->alamat) }}</strong><br>
                            {{ ucwords(strtolower($select_kursus->desa)).' - '.ucwords(strtolower($select_kursus->kecamatan)).' - '.ucwords(strtolower($select_kursus->kota)).' - '.ucwords(strtolower($select_kursus->provinsi)) }}
                          </td>
                          <td><center>
                            <form method='POST' action="{{ route('simpan.guru') }}" enctype='multipart/form-data'>
                              @csrf
                              <input type="hidden" name="id_instansi" value="{{$select_kursus->id}}">
                              <button type="submit" class="btn btn-sm bg-purple"> Daftar</button>
                              <a href="{{route('rating.instansi',$select_kursus->id)}}" type="button" class="btn btn-warning btn-sm shadow-sm">Lihat</a>
                            </form>
                          </center></td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
              
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
                                  <th style="width: 1%; text-align: center;">Kelas</th>
                                  <!-- <th style="width: 5%; text-align: center;">No</th> -->
                                  <th style="width: 30%;">Nama</th>
                                  <th style="width: 35%;">Mata Pelajaran</th>
                                  <!-- <th style="width: 40%;">Data Guru</th> -->
                                  <th style="width: 15%; text-align: center;">Harga</th>
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
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->
    
    <!-- Data Kelas -->
    <div class="row mt-2 mb-2" id="div_kelas" hidden>
      <div class="col-md-12">
        <div class="card">
          
          <div class="card-header border-0">
            <h3 class="card-title" id="judul_kelas"><b>Data Kelas <small><i>({{$tingkat ?? ''}})</i></small></b></h3>

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
                      
            <div class="row col-12">
              <table id="example" class="table table-hover table-valign-middle" style="table-layout: fixed">
                <thead>
                    <tr>
                      <th style="width: 5%; text-align: center;">Kelas</th>
                      <th style="width: 40%;">Mata Pelajaran</th>
                      <th style="width: 40%;">Data Guru</th>
                      <th style="width: 10%; text-align: center;">Harga</th>
                      <th style="width: 5%; text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody id="bodyKelas">

                </tbody>  
              </table>
            </div>
            
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->

  </div>

              
  <!-- modal pilih guru -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title me-auto">Daftar Lembaga Pendidikan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            <div class="row">
              <div class="col-12 d-flex align-items-stretch flex-column">
                <table id="validasi_guru" class="table table-hover table-valign-middle" style="table-layout: fixed">
                  <thead>
                    <tr>
                      <th style="width: 5%; text-align: center;">No</th>
                      <th style="width: 40%;">Nama</th>
                      <th style="width: 45%;">Alamat</th>
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

</section>
<!-- /.content -->
@endsection

@section('js-end')


<!-- pass value to modal -->
<script type="text/javascript">
  $('#pilih_guru').on('hidden.bs.modal', function (e) {
    $('#tabel_modal').DataTable().destroy();
  })
  $('#modal-default').on('hidden.bs.modal', function (e) {
    $('#validasi_guru').DataTable().destroy();
  })
  
  // menampilkan tabel guru sesuai mapel
  $('.btn_pilih').on('click',function(){
    $("#pilih_guru #bodyData").empty();
    $("#div_kelas #bodyKelas").empty();
    
    var id_instansi = $(this).data('id-instansi');
    var nama_instansi = $(this).data('nama-instansi');
    var tipe_instansi = $(this).data('tipe-instansi');
    var master_kelas_id = $(this).data('master-kelas-id');
    var id_siswa = $(this).data('id-siswa');

    // alert(id_siswa);

    if(tipe_instansi=='sekolah'){
      $("#div_kelas #judul_kelas").html("<strong>List Kelas "+nama_instansi+"</strong>");
      $("#pilih_guru #judul_modal").html("<strong>List Kelas "+nama_instansi+"</strong>");
    }
    else{
      $("#div_kelas #judul_kelas").html("<strong>List Program Kursus "+nama_instansi+"</strong>");
      $("#pilih_guru #judul_modal").html("<strong>List Program Kursus "+nama_instansi+"</strong>");
    }

    $.ajax({
      url: "{{ route('show.kelas_program') }}",
      type:'POST',
      data: {_token:'{{ csrf_token() }}', id:id_instansi, master_kelas_id:master_kelas_id, id_siswa:id_siswa},
      cache: false,
      dataType: 'json',
      success: function(dataResult){

        // $("#div_kelas").prop('hidden',false);
        var resultData = dataResult.data;
        var bodyData = '';
        var profil = '';
        var i = 1;
        console.log(resultData);

        $.each(resultData,function(index,row){
          if(row.foto===null){
            profil="{{asset('AdminLTE/dist/img/default-150x150.png')}}";
          }else{
            profil=row.foto;
          }

          if(row.jurusan===null){
            row.jurusan='';
          }

          if(row.name===null){
            row.name='<i>Guru belum ditentukan!</i>';
          }

          
          row.nama_mapel = row.nama_mapel.toLowerCase().replace(/\b[a-z]/g, function(letter) {
              return letter.toUpperCase();
          });
          row.materi = row.materi.toLowerCase().replace(/\b[a-z]/g, function(letter) {
              return letter.toUpperCase();
          });

          if(row.materi===''){
            materi=row.nama_mapel;
          }
          else{
            materi=row.nama_mapel+" - "+row.materi;
          }

          if(row.jurusan===''){
            jurusan=row.tingkat+"/sederajat";
          }
          else{
            jurusan=row.tingkat+"/sederajat"+" - "+row.jurusan;
          }

          if(row.harga==='0'){
            row.harga="Gratis";
          }
          else{
            row.harga="Rp "+parseInt(row.harga).toLocaleString();
          }
          
          bodyData+="<tr>"
          bodyData+="<td>(Kelas "+row.kelas+" "+jurusan+")</td>"+
          // "<td><center>"+i+"</center></td>"+
          "<td>"+row.deskripsi+"</td>"+
          "<td>"+materi+"</td>"+
          // "<td><img src="+profil+" class='img-circle mr-4' alt='User Image' style='max-width:40px'>"+row.name+"</td>"+
          "<td><center>"+row.harga+"</center></td>"+
          "<td><center><form method='POST' action='{{ route('daftar.siswa') }}' enctype='multipart/form-data'>"+
          // "<td><center><form method='POST' action='{{ route('orders.store') }}' enctype='multipart/form-data'>"+
            "<input type='hidden' name='_token' id='csrf-token' value='{{ csrf_token() }}' />"+
            "<input type='hidden' name='id_kelas_program' value='"+row.id_kelas_program+"'>"+
            "<button type='submit' class='btn bg-purple btn-sm'><i class='fas fa-check-circle'></i> Pilih</button>"+
          "</form></center></td>";
          bodyData+="</tr>";
          i = i+1
          // $.ajax({
          //   url: "{{ route('select.rombongan') }}",
          //   type:'POST',
          //   data: {_token:'{{ csrf_token() }}', id_kelas_program:row.id_kelas_program},
          //   cache: false,
          //   dataType: 'json',
          //   success: function(dataRombongan){
          //     var rombonganData = dataRombongan.data;
          //       console.log('rombonganData'+rombonganData);
          //       if (!$.trim(rombonganData)){   
                    
          //         }

          //   }
          // });
        })
        $("#pilih_guru #bodyData").append(bodyData);
        $("#div_kelas #bodyKelas").append(bodyData);
        
        var groupColumn = 0;
        var table = $('#tabel_modal').DataTable({
            "paging": true,
            "responsive": true, 
            "autoWidth": false,
            "scrollCollapse": true,
            "columnDefs": [
                { "visible": false, "targets": groupColumn }
            ],
            "order": [[ groupColumn, 'asc' ]],
            "displayLength": 5,
            "drawCallback": function ( settings ) {
              var api = this.api();
              var rows = api.rows( {page:'current'} ).nodes();
              var last=null;
  
              api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group bg-light"><td colspan="5">'+group+'</td></tr>'
                    );

                    last = group;
                }
              });
            }
        });
        
        // Order by the grouping
        $('#tabel_modal tbody').on( 'click', 'tr.group', function () {
            var currentOrder = table.order()[0];
            if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
                table.order( [ groupColumn, 'desc' ] ).draw();
            }
            else {
                table.order( [ groupColumn, 'asc' ] ).draw();
            }
        });
        
      }
    });
  }); 


  // menampilkan tabel guru yang mendaftar
  $('.btn_terima_guru').on('click',function(){
    $("#modal-default #bodyData").empty();
    var id_guru = $(this).data('id-guru');
    // alert(id_guru);

    $.ajax({
      url: "{{ route('terima.lembaga') }}",
      type:'get',
      dataType: 'json',
      success: function(dataResult){

        var resultData = dataResult.data;
        var bodyData = '';
        var profil = '';
        var i = 1;
        console.log(resultData);

        $.each(resultData,function(index,row){
          // alert(row.jenjang)
          if(row.tipe=='sekolah'){
            row.nomor_induk='NPSN: '+row.nomor_induk;
          }
          else{
            row.nomor_induk='NILEK: '+row.nomor_induk;
          }

          bodyData+="<tr>"
          bodyData+="<td style='text-align:center;'>"+i+"</td>"+
          "<td>"+
          "<b>"+row.instansi+"</b>"+
          "<span class='badge bg-purple ml-1'>"+row.jenjang+"/sederajat</span>"+
          "<br>"+row.nomor_induk+
          "</td>"+
          "<td>"+
          "<strong>"+row.alamat.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();})+"</strong><br>"+
          row.desa.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();})+" - "+row.kecamatan.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();})+" - "+row.kota.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();})+" - "+row.provinsi.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();})+
          "</td>"+
          "<td><center><form method='POST' action='{{ route('valid.guru') }}' enctype='multipart/form-data'>"+
            "<input type='hidden' name='_token' id='csrf-token' value='{{ csrf_token() }}' />"+
            "<input type='hidden' name='id_guru_instansi' value='"+row.id_guru_instansi+"'>"+
            "<button type='submit' class='btn bg-purple btn-sm'><i class='fas fa-check-circle'></i> Terima</button>"+
          "</form></center></td>";
          bodyData+="</tr>";
          i = i+1
        })
        $("#modal-default #bodyData").append(bodyData);
        
        $("#validasi_guru").DataTable({
          "paging": true,
          "responsive": true, 
          "autoWidth": false,
          "pageLength": 10,
          "scrollCollapse": true
        }).buttons().container().appendTo('#validasi_guru_wrapper .col-md-6:eq(0)');
        
      }
    });
  }); 
  
  // $("#tabel_modal").DataTable({
  //   "stateSave": true,
  //   "bDestroy": true,
  //   "responsive": true, 
  //   "autoWidth": false,
  //   "paging": true,
  //   "pageLength": 5,
  //   "scrollCollapse": true
  // }).buttons().container().appendTo('#tabel_modal_wrapper .col-md-6:eq(0)');
  
  $(function () {
    

    $('#collapseTwo').on('shown.bs.collapse', function(e){
      $('#example1').DataTable()
          .columns.adjust()
          .responsive.recalc();
    });

    // Custom Datatable
    $("#example1").DataTable({
      "paging": true,
      // "info": true,
      "responsive": true, 
      // "lengthChange": false, 
      "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      // "buttons": [
      //   { extend: 'excel', className: 'btn btn-success' },
      //   { extend: 'pdf', className: 'btn-success' },
      //   { extend: 'print', className: 'btn-success' },
      //   { extend: 'colvis', className: 'btn-info', text: 'Pilih Kolom' },
      // ],
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  
    $("#example2").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      // "buttons": [
      //   { extend: 'excel', className: 'btn btn-success' },
      //   { extend: 'pdf', className: 'btn-success' },
      //   { extend: 'print', className: 'btn-success' },
      //   { extend: 'colvis', className: 'btn-info', text: 'Pilih Kolom' },
      // ],
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    
  });

</script>

@endsection