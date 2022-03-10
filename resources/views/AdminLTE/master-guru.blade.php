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

            @if($last_update_guru->isEmpty())
                  <b>Data Guru Kosong!</b> <br> {{'Jumlah : '.$jumlah_guru.' Guru'}}
            @else
              @foreach($last_update_guru as $last)
                @if ($loop->first)
                <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> {{'Jumlah : '.$jumlah_guru.' Guru'}}
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
            <h3 class="card-title"><b>{{'Data Guru Terdaftar'}}</b></h3>

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
              <button type="button" class="btn bg-purple shadow-sm btn_pilih" data-toggle="modal" data-target="#modal-default" data-id-user="{{$id}}">Tambah Guru</button>
              <button type="button" class="btn btn-warning shadow-sm btn_terima_guru ml-2" data-toggle="modal" data-target="#modal-default" data-id-user="{{$id}}">Pendaftaran<span class="badge bg-success ml-1">{{$jumlah_guru_mendaftar}}</span></button>
            </div>

            <table id="example2" class="table table-hover table-valign-middle" style="table-layout: fixed">
              <thead>
                <tr>
                  <th style="width: 5%; text-align: center;">No</th>
                  <th style="width: 45%;">Data Guru</th>
                  <th style="width: 10%; text-align: center;">Gender</th>
                  <th style="width: 15%; text-align: center;">NUPTK</th>
                  <th style="width: 18%; text-align: center;">Narahubung</th>
                  <th style="width: 7%; text-align: center;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php ($no = 1)
                @foreach($list_gurus as $list_guru)
                @if($list_guru->id_guru_instansi!=null)
                <tr>
                  <td style="text-align: center;">{{$no++}}</td>
                  <td> 
                    <div class="row"> 
                    <div class="col-xs-3"> 
                      @if($list_guru->foto==null)
                      <img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}"  class="img-circle mr-4" alt="User Image" style="max-width:50px"> 
                      @else
                      <img src="{{'/'.$list_guru->foto}}"  class="img-circle mr-4" alt="User Image" style="max-width:50px"> 
                      @endif
                    </div> 
                    <div class="col-xs-9"> 
                      <h6 style="margin-bottom:0;"><b>{{$list_guru->name}}</b></h6>
                      @php ($parts = explode(",", $list_guru->nama_mapel)) 
                      @php ($result = implode(", ", $parts)) 
                      <p style="margin-bottom:0;">{{ucwords($result)}}</p> 
                    </div> 
                    </div> 
                  </td> 
                  <td style="text-align: center;">{{ucwords($list_guru->jenis_kelamin)}}</td>
                  <td style="text-align: center;">{{$list_guru->nuptk}}</td>
                  <td><i class="fas fa-envelope-open-text mr-1"></i>{{$list_guru->email}}<br><i class="fas fa-phone-alt mr-1"></i>{{$list_guru->no_telp}}</td>
                  <td style="text-align: center;">
                    <button  onclick="return false" class="btn btn-block bg-maroon btn-sm shadow-sm delete_soal" data-id="{{$list_guru->id_guru_instansi}}" data-nama="{{$list_guru->name}}">Hapus</button>
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>

          </div>
          <!-- /.card-body -->
          
        </div>
        <!-- /.card -->

      </div>
      

    </div>
    <!-- /.row -->

  </div>
              
  <!-- modal pilih guru -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title me-auto">Daftar Guru</h5>
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
                      <th style="width: 5%; text-align: center;">No</th>
                      <th style="width: 45%;">Data Guru</th>
                      <th style="width: 8%; text-align: center;">Gender</th>
                      <th style="width: 15%; text-align: center;">NUPTK</th>
                      <th style="width: 20%; text-align: center;">Narahubung</th>
                      <th style="width: 7%; text-align: center;">Aksi</th>
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

<script type="text/javascript">
  $('#modal-default').on('hidden.bs.modal', function (e) {
    $('#tabel_modal').DataTable().destroy();
  })

  
  $('body').on('click', '.delete_soal', function (event) {
    var id = $(this).data('id');
    var nama = $(this).data('nama');

    Swal.fire({
      title: 'Yakin mengahpus?',
      text: "Tindakan ini bersifat permanen",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: ' list-guru/' + id,
          type: 'POST',
          data: {
            _method: "DELETE",
            _token: "{{ csrf_token() }}",
            nama: nama,
          },
          dataType: 'json',
          success: function (data) {
            window.location.href = '/list-guru'
          }
        });
      }
    })
  });

  // menampilkan tabel guru sesuai mapel
  $('.btn_pilih').on('click',function(){
    $("#modal-default #bodyData").empty();
    var id_user = $(this).data('id-user');
    // alert(id_user);

    $.ajax({
      url: "{{ route('daftar.guru') }}",
      type:'get',
      dataType: 'json',
      success: function(dataResult){

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
          
          row.jenis_kelamin = row.jenis_kelamin.toLowerCase().replace(/\b[a-z]/g, function(letter) {
              return letter.toUpperCase();
          });
          
          row.nama_mapel = row.nama_mapel.toLowerCase().replace(/\b[a-z]/g, function(letter) {
              return letter.toUpperCase();
          });

          bodyData+="<tr>"
          bodyData+="<td style='text-align:center;'>"+i+"</td>"+
          "<td>"+
          "<div class='row'>"+
          "<div class='col-xs-3'>"+
            "<img src="+profil+" class='img-circle mr-4' alt='User Image' style='max-width:50px'>"+
          "</div>"+
          "<div class='col-xs-9'>"+
            "<h6 style='margin-bottom:0;'><b>"+row.name+"</b></h6>"+
            "<p style='margin-bottom:0;'>"+row.nama_mapel+"</p>"+
          "</div>"+
          "</div>"+
          "</td>"+
          "<td><center>"+row.jenis_kelamin+"</center></td>"+
          "<td><center>"+row.nuptk+"</center></td>"+
          "<td><i class='fas fa-envelope-open-text mr-1'></i>"+row.email+"<br><i class='fas fa-phone-alt mr-1'></i>"+row.no_telp+"</td>"+
          "<td><center><form method='POST' action='{{ route('simpan.guru') }}' enctype='multipart/form-data'>"+
            "<input type='hidden' name='_token' id='csrf-token' value='{{ csrf_token() }}' />"+
            "<input type='hidden' name='id_user' value='"+id_user+"'>"+
            "<input type='hidden' name='id_guru' value='"+row.id_guru+"'>"+
            "<button type='submit' class='btn bg-purple btn-sm'><i class='fas fa-check-circle'></i> Pilih</button>"+
          "</form></center></td>";
          bodyData+="</tr>";
          i = i+1
        })
        $("#modal-default #bodyData").append(bodyData);
        
        
        $("#tabel_modal").DataTable({
          "paging": true,
          "responsive": true, 
          "autoWidth": false,
          "pageLength": 10,
          "scrollCollapse": true
        }).buttons().container().appendTo('#tabel_modal_wrapper .col-md-6:eq(0)');
        
      }
    });
  }); 

  // menampilkan tabel guru yang mendaftar
  $('.btn_terima_guru').on('click',function(){
    $("#modal-default #bodyData").empty();
    var id_user = $(this).data('id-user');
    // alert(id_user);

    $.ajax({
      url: "{{ route('terima.guru') }}",
      type:'get',
      dataType: 'json',
      success: function(dataResult){

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
          
          row.jenis_kelamin = row.jenis_kelamin.toLowerCase().replace(/\b[a-z]/g, function(letter) {
              return letter.toUpperCase();
          });
          
          row.nama_mapel = row.nama_mapel.toLowerCase().replace(/\b[a-z]/g, function(letter) {
              return letter.toUpperCase();
          });

          bodyData+="<tr>"
          bodyData+="<td style='text-align:center;'>"+i+"</td>"+
          "<td>"+
          "<div class='row'>"+
          "<div class='col-xs-3'>"+
            "<img src="+profil+" class='img-circle mr-4' alt='User Image' style='max-width:50px'>"+
          "</div>"+
          "<div class='col-xs-9'>"+
            "<h6 style='margin-bottom:0;'><b>"+row.name+"</b></h6>"+
            "<p style='margin-bottom:0;'>"+row.nama_mapel+"</p>"+
          "</div>"+
          "</div>"+
          "</td>"+
          "<td><center>"+row.jenis_kelamin+"</center></td>"+
          "<td><center>"+row.nuptk+"</center></td>"+
          "<td><i class='fas fa-envelope-open-text mr-1'></i>"+row.email+"<br><i class='fas fa-phone-alt mr-1'></i>"+row.no_telp+"</td>"+
          "<td><center><form method='POST' action='{{ route('valid.guru') }}' enctype='multipart/form-data'>"+
            "<input type='hidden' name='_token' id='csrf-token' value='{{ csrf_token() }}' />"+
            "<input type='hidden' name='id_user' value='"+id_user+"'>"+
            "<input type='hidden' name='id_guru' value='"+row.id_guru+"'>"+
            "<button type='submit' class='btn bg-purple btn-sm'><i class='fas fa-check-circle'></i> Valid</button>"+
          "</form></center></td>";
          bodyData+="</tr>";
          i = i+1
        })
        $("#modal-default #bodyData").append(bodyData);
        
        
        $("#tabel_modal").DataTable({
          "paging": true,
          "responsive": true, 
          "autoWidth": false,
          "pageLength": 10,
          "scrollCollapse": true
        }).buttons().container().appendTo('#tabel_modal_wrapper .col-md-6:eq(0)');
        
      }
    });
  }); 

  $("#example2").DataTable({
    "paging": true,
    "responsive": true, 
    "autoWidth": false,
    "pageLength": 10,
    "scrollCollapse": true
  }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');



  $(document).ready(function() {

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    // csrf edit 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  });

  

</script>


@endsection