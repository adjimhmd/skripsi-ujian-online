@extends('AdminLTE.app')

@section('js-start')

  
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    
    <!-- Info update mapel -->
    <div class="row mt-2 mb-2">
      <div class="col-12 col-md-12">
        <div class="alert alert-default-primary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <div style="justify-content:flex-start; display: flex;">

            <div style="display:flex; justify-content: center; align-content: center; flex-direction: column; font-size: 2rem;">
              <i class="icon fas fa-info"></i>
            </div>

            <div style="display: table-cell; vertical-align: middle;" class="ml-2">

            @if($last_update_paket->isEmpty())
                  <b>Data Paket Soal Kosong!</b> <br> {{'Jumlah : '.$jumlah_paket.' paket soal'}}
            @else
              @foreach($last_update_paket as $last)
                @if ($loop->first)
                <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> {{'Jumlah : '.$jumlah_paket.' paket soal'}}
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

    <!-- Row Master Paket Soal -->
    <div class="row mt-3 mb-2">

      <div class="col-12">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>{{'List Paket Soal'}}</b></h3>

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
              <button type="button" class="btn bg-purple shadow-sm" data-toggle="modal" data-target="#modal-default">Buat Paket Soal</button>
            </div>

            <table id="example2" class="table table-hover table-valign-middle" style="table-layout: fixed">
              <thead>
                <tr>
                  <th style="width: 5%; text-align: center;">No</th>
                  <th style="width: 1%;">Kelas</th>
                  <th style="width: 30%;">Nama Paket</th>
                  <th style="width: 30%;">Mata Pelajaran</th>
                  <th style="width: 30%;">Data Guru</th>
                  <th style="width: 9%; text-align: center;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php ($no = 1)
                @foreach($paket_soals as $paket_soal)
                <tr>
                  <td style="text-align: center;">{{$no++}}</td>
                  <td>{{'Kelas '.$paket_soal->kelas.' '.$paket_soal->tingkat.'/sederajat'}}</td>
                  <td>{{$paket_soal->deskripsi}}</td>
                  <td>
                    @if($paket_soal->materi){{ucwords($paket_soal->nama)}}<br>{{ucwords($paket_soal->materi)}}
                    @else($paket_soal->materi){{ucwords($paket_soal->nama)}}
                    @endif
                  </td>
                  <td>
                    @if($paket_soal->user_guru_id==0) 
                      <i>{{'Guru belum ditentukan!'}}</i><br>
                      <button type="button" class="btn btn-xs bg-secondary btn_guru shadow-sm" data-toggle="modal" data-target="#pilih_guru"
                      data-jenjang="{{$paket_soal->kelas.' '.$paket_soal->tingkat.'/sederajat'}}" 
                      data-nama-mapel="{{ucwords($paket_soal->nama)}}" 
                      data-id-paket-soal="{{$paket_soal->id_paket_soal}}" 
                      data-id-instansi="{{$paket_soal->id_instansi}}" 
                      data-id-master-mapel="{{$paket_soal->id_master_mapel}}">Pilih Guru
                      </button>
                    @else 
                      @if($paket_soal->foto==null)
                        <img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class='img-circle mr-4 elevation-1' alt='User Image' style='max-width:50px'>
                      @else
                        <img src="{{'/'.$paket_soal->foto}}" class='img-circle mr-2 elevation-1' alt='User Image' style='max-width:50px'>
                      @endif
                      {{$paket_soal->name}}
                    @endif
                  </td>
                  <td>
                    @if($paket_soal->user_guru_id==0) 
                      <a href="" class="btn btn-block btn-warning btn-sm shadow-sm" id="edit_paket_soal" data-toggle="modal" data-id="{{ $paket_soal->id_paket_soal }}">Edit</a>
                    @else
                      <button type="button" class="btn btn-block btn-sm bg-secondary btn_guru shadow-sm" data-toggle="modal" data-target="#pilih_guru"
                      data-jenjang="{{$paket_soal->kelas.' '.$paket_soal->tingkat.'/sederajat'}}" 
                      data-nama-mapel="{{ucwords($paket_soal->nama)}}" 
                      data-id-paket-soal="{{$paket_soal->id_paket_soal}}" 
                      data-id-instansi="{{$paket_soal->id_instansi}}" 
                      data-id-master-mapel="{{$paket_soal->id_master_mapel}}">Ubah Guru
                      </button>
                    @endif
                    <a href="{{route('paket_soal.show',$paket_soal->id_paket_soal)}}" class="btn btn-block bg-purple btn-sm shadow-sm" >Detail Soal</a>
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

      <!-- Modal Add Data -->
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Buat Paket Soal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form method="POST" action="{{ route('paket_soal.store') }}" enctype="multipart/form-data" id="form_paket_soal">
            @csrf

              <div class="modal-body">
                <!-- form input -->
                <div class="row">

                  @foreach($user_admin_instansis as $user_admin_instansi)
                    <input type="hidden" id="id_adm_instansi" name="id_adm_instansi" value="{{$user_admin_instansi->id_adm_instansi}}">
                  @endforeach

                  <!-- Nama -->
                  <div class="form-group col-12">
                    <label for="deskripsi">{{ __('Nama Paket Soal') }}</label>
                    <input id="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" required autocomplete="deskripsi" autofocus placeholder="Nama paket soal yang akan dibuat">

                    @error('deskripsi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  </div>

                  <!-- Kelas -->
                  <div class="form-group col-12">

                    <label for="kelas">Kelas</label>
                    <select id="kelas" name="kelas" class="form-control select2bs4 @error('kelas') is-invalid @enderror">
                        <option value="" selected disabled>Pilih kelas</option>
                        @foreach($kelass as $kelas)
                          <option {{old('kelas') =="$kelas->id" ? "selected" : ""}} value="{{$kelas->id}}">{{$kelas->kelas.' '.$kelas->tingkat.' '.ucwords($kelas->jurusan).'/sederajat'}}</option>
                        @endforeach
                    </select>

                    @error('kelas')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                  </div>

                  <!-- Mata Pelajaran -->
                  <div class="form-group col-12">

                    <label for="mapel">Mata Pelajaran</label>
                    <select id="mapel" name="mapel" class="form-control select2bs4 @error('mapel') is-invalid @enderror">
                        <option value="" selected disabled>Pilih Mata Pelajaran</option>
                        @foreach($program_mapels as $program_mapel)
                        @if($program_mapel->materi)
                        @php($spesial=ucwords($program_mapel->nama).' - '.ucwords($program_mapel->materi))
                        @else
                        @php($spesial=ucwords($program_mapel->nama))
                        @endif
                            <option {{old('mapel') =="$program_mapel->id" ? "selected" : ""}} value="{{$program_mapel->id}}">{{$spesial}}</option>
                        @endforeach
                    </select>

                    @error('mapel')
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

      <!-- Modal Edit Data -->
      <div class="modal fade" id="modal-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Paket Soal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>

              <div class="modal-body">
                <!-- form input -->
                <div class="row">

                  <input type="hidden" id="id_paket_soal" name="id_paket_soal" value="">

                  <!-- Nama -->
                  <div class="form-group col-12">
                    <label for="deskripsi">{{ __('Nama Paket Soal') }}</label>
                    <input id="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" required autocomplete="deskripsi" autofocus placeholder="Nama paket soal yang akan dibuat">

                    @error('deskripsi')
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

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

    </div>
    <!-- /.row -->

  </div>


</section>
<!-- /.content -->
@endsection

@section('js-end')

<script>
  

  var groupColumn = 1;
  var table = $('#example2').DataTable({
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
                      '<tr class="group bg-light"><td colspan="5">'+group+'</td></tr>'
                  );

                  last = group;
              }
          } );
      }
  } );
 
  // Order by the grouping
  $('#example2 tbody').on( 'click', 'tr.group', function () {
      var currentOrder = table.order()[0];
      if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
          table.order( [ groupColumn, 'desc' ] ).draw();
      }
      else {
          table.order( [ groupColumn, 'asc' ] ).draw();
      }
  });

  // $("#example2").DataTable({
  //   "paging": true,
  //   "responsive": true, 
  //   "autoWidth": false,
  //   "pageLength": 10,
  //   "scrollCollapse": true
  // }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

  $("#tabel_modal").DataTable({
    "paging": true,
    "responsive": true, 
    "autoWidth": false,
    "pageLength": 10,
    "scrollCollapse": true
  }).buttons().container().appendTo('#tabel_modal_wrapper .col-md-6:eq(0)');


  $(document).ready(function() {
    $(function () {
      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })


      // menampilkan tabel guru sesuai mapel
      $('.btn_guru').on('click',function(){
        $("#pilih_guru #bodyData").empty();
        
        var jenjang = $(this).data('jenjang');
        var mapel = $(this).data('nama-mapel');
        var id_instansi = $(this).data('id-instansi');
        var id_master_mapel = $(this).data('id-master-mapel');
        var id_paket_soal = $(this).data('id-paket-soal');

        // alert(id_instansi+' & '+id_master_mapel);
        
        $("#pilih_guru #judul_modal").html("<strong>List Guru Mata Pelajaran "+mapel+"</strong>");

        $.ajax({
          url: "{{ route('show.guru.paket') }}",
          type:'POST',
          data: {_token:'{{ csrf_token() }}', id_instansi:id_instansi, id_master_mapel:id_master_mapel, id_paket_soal:id_paket_soal},
          cache: false,
          dataType: 'json',
          success: function(dataResult){
            // console.log('dataResult'+dataResult.data);
            var resultData = dataResult.data;
            var bodyData = '';
            var profil = '';

            if($.isEmptyObject(dataResult.data)){
              Swal.fire(
                'Cek Menu Guru!',
                'Kamu belum memiliki guru dengan spesialisasi '+mapel+'. Daftarkan guru dulu yuk, <a href="/list-guru">klik disini</>',
                'warning'
              )
            }

            $.each(resultData,function(index,row){
                if(row.foto===null){
                  profil="{{asset('AdminLTE/dist/img/default-150x150.png')}}";
                }else{
                  profil=row.foto;
                }

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
                "<td class='py-4'><center><button id='btn_pilih_guru' class='btn bg-purple btn-sm' data-id-user-guru='"+row.id_user_guru+"' data-id-paket-soal='"+id_paket_soal+"'><i class='fas fa-check-circle'></i> Pilih</button></center></td>";
                bodyData+="</tr>";
            })

            $("#pilih_guru #bodyData").append(bodyData);

          }
        });  
      
      }); 
      

      // update guru kelas
      $(document).on("click", "#btn_pilih_guru", function () {
        var id_user_guru = $(this).data('id-user-guru');
        var id_paket_soal = $(this).data('id-paket-soal');
        // alert(id_kelas_program);

        $.ajax({
            url: "{{ route('update.guru.paket') }}",
            type:'POST',
            data: {_token:'{{ csrf_token() }}', id_user_guru:id_user_guru, id_paket_soal:id_paket_soal},
            cache: false,
            dataType: 'json',
            success: function(dataResult){
              window.location.href='/paket_soal'
            }
        });
      }); 
    
      // open modal edit
      $('body').on('click', '#edit_paket_soal', function (event) {

          event.preventDefault();
          var id = $(this).data('id');
          // console.log('id'+id)

          $.get('paket_soal/' + id + '/edit', function (data) {

              $('#modal-edit #id_paket_soal').val(data.data.id);
              $('#modal-edit #deskripsi').val(data.data.deskripsi);
              $('#modal-edit').modal('show');

          })

      });
        
      // process update
      $('body').on('click', '#modal-edit #submit', function (event) {
          event.preventDefault()
          
          var id = $("#modal-edit #id_paket_soal").val();
          var deskripsi = $("#modal-edit #deskripsi").val();
          
          $.ajax({
            url: 'paket_soal/' + id,
            type: 'POST',
            data: {
              _method: "PUT",
              deskripsi: deskripsi,
            },
            dataType: 'json',
            success: function (data) {
                $('#modal-edit').modal('hide');
                window.location.href = '/paket_soal'
            }
        });
      });

    })


    // open modal delete
    $('body').on('click', '#delete_kelas', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        console.log(id)
        Swal.fire({
            title: 'Are you sure ?',
            text: "You won't be able to revert this !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                // $('#delete-post-form').submit();
                $.ajax({
                  url: 'master-mapel/' + id,
                  type: 'POST',
                  data: {
                    _method: "DELETE",
                    id: id,
                  },
                  dataType: 'json',
                  success: function (data) {
                    window.location.href = '/master-mapel'
                  }
                });
            }
        })
    });

    // csrf edit 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


  });

  // modal hapus
  $(document).on("click", ".user_dialog", function () {
      var id = $(this).data('id');
      $('#id_hapus').val(id);
  });
  

</script>


@endsection