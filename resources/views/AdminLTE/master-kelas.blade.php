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

            @if($last_update_kelas->isEmpty())
                  <b>Data Master Kelas Kosong!</b> <br> {{'Jumlah : '.$jumlah_kelas.' Kelas'}}
            @else
              @foreach($last_update_kelas as $last)
                @if ($loop->first)
                <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> {{'Jumlah : '.$jumlah_kelas.' Kelas'}}
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

    <!-- Row Form Input Program Mapel -->
    <div class="row mt-3 mb-2">

      <div class="col-12 col-md-12">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>{{'Data Kelas'}}</b></h3>

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
              <button type="button" class="btn bg-purple shadow-sm" data-toggle="modal" data-target="#modal-default">Tambah Kelas</button>
            </div>

            <table id="example3" class="table table-bordered table-hover" style="table-layout: fixed">
              <thead>
                <tr>
                  <th style="width: 5%; text-align: center;">NO</th>
                  <th style="width: 85%; text-align: center;">KELAS</th>
                  <th style="width: 15%; text-align: center;">AKSI</th>
                </tr>
              </thead>
              <tbody>
                @php ($no = 1)
                @foreach($kelas as $kls)
                <tr>
                  <td style="text-align: center;">{{$no++}}</td>
                  <td>{{'Kelas '.$kls->kelas.' '.$kls->tingkat.'/sederajat'}}</td>
                  <td style="text-align: center;">
                    <a href="" class="btn btn-warning btn-sm" id="editProgramMapel" data-toggle="modal" data-id="{{ $kls->id }}">Edit</a>
                    <button onclick="return false" id="delete_kelas" class="btn btn-sm bg-maroon"data-id="{{ $kls->id }}">Delete</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            

            <!-- Modal Add Data -->
            <div class="modal fade" id="modal-default">
              
              <div class="modal-dialog">

                <form method="POST" action="{{ route('master-kelas.store') }}" enctype="multipart/form-data" autocomplete="off">
                  @csrf
                  <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title">{{'Buat Tahun Ajaran'}}</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      
                      <!-- form Add -->
                      <div class="row">
                
                        <!-- tingkat -->
                        <div class="form-group col-12">
                          <label>Tingkat</label>
                          <select id="tingkat" class="form-control select2 @error('tingkat') is-invalid @enderror" name="tingkat" required autofocus>
                            @php ($jenjangs = ['SD','SMP','SMA','UMUM'])
                            <option value="" selected disabled>Tingkat apa?</option>
                            @foreach($jenjangs as $jenjang)
                                <option {{old('tingkat') =="$jenjang" ? "selected" : ""}} value="{{$jenjang}}">{{ucwords($jenjang).'/sederajat'}}</option>
                            @endforeach
                          </select>

                            @error('tingkat')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                        
                        <!-- kelas -->
                        <div class="form-group col-12">
                          <label>Kelas</label>
                          <select id="kelas" class="form-control select2 @error('kelas') is-invalid @enderror" name="kelas" required autofocus disabled>
                            <option value="" selected disabled>Kelas berapa?</option>
                          </select>

                            @error('kelas')
                              <script type="text/javascript">
                                $( document ).ready(function() {
                                    $('#modal-default').modal('show');
                                });
                              </script>

                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                            
                        </div>

                      </div>

                    </div>

                    <div class="modal-footer justify-content-between">
                      <button id="submit" type="submit" class="btn bg-purple btn-block">Simpan Data</button>
                    </div>

                  </div>
                  <!-- /.modal-content -->
                </form>

              </div>
              <!-- /.modal-dialog -->

            </div>
            
            <!-- Modal Edit Data -->
            <div class="modal fade" id="modal_edit">
              <div class="modal-dialog">
                <form id="kelasData">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title">{{'Edit Kelas'}}</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      
                      <!-- form Edit -->
                      <div class="row">

                        <input type="hidden" id="kelas_id" name="kelas_id" value="">
                        
                        <!-- tingkat -->
                        <div class="form-group col-12">
                          <label>Tingkat</label>
                          <select id="tingkat2" class="form-control select2 @error('tingkat2') is-invalid @enderror" name="tingkat2" required autofocus>
                            @php ($jenjangs = ['SD','SMP','SMA','UMUM'])
                            <option value="" selected disabled>Tingkat apa?</option>
                            @foreach($jenjangs as $jenjang)
                                <option {{old('tingkat2') =="$jenjang" ? "selected" : ""}} value="{{$jenjang}}">{{ucwords($jenjang).'/sederajat'}}</option>
                            @endforeach
                          </select>

                            @error('tingkat2')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                
                        <!-- kelas -->
                        <div class="form-group col-12">
                          <label>Kelas</label>
                          <select id="kelas2" class="form-control select2 @error('kelas2') is-invalid @enderror" name="kelas2" required autofocus disabled>
                            <option value="" selected disabled>Kelas berapa?</option>
                          </select>

                          <span id="err_tahun_akhir" class="text-danger" role="alert"></span>

                        </div>

                      </div>

                    </div>

                    <div class="modal-footer justify-content-between">
                      <input type="submit" value="Submit" id="submit" class="btn bg-purple btn-block">
                    </div>

                  </div>
                  <!-- /.modal-content -->
                </form>
              </div>
              <!-- /.modal-dialog -->
            </div>

          </div>
          <!-- /.card-body -->
          
          

        </div>
        <!-- /.card -->
      </div>
      
    </div>
    <!-- /.row -->

  </div>


</section>
<!-- /.content -->
@endsection

@section('js-end')

<script type="text/javascript">
  // select 2 bootstrap
  $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2').select2()
  });

  // enable disable kelas tergantung tingkat
  if($('#tingkat').val()!=null){
    $("#kelas").empty();
    $("#kelas").removeAttr("disabled");

    var tingkat = $('#tingkat').val(),
        $kelas = $('#kelas'),
        $old_kelas='{{ old('kelas') }}';
        $('<option disabled/>').prop('value', '').text('Kelas berapa?').appendTo($kelas);
      
    if(tingkat=='SD'){
      for(var i = 1; i <= 6; i++)
        if($old_kelas==i){
          $('<option selected/>').prop('value', i).text(i).appendTo($kelas);
        }
        else{
          $('<option/>').prop('value', i).text(i).appendTo($kelas);
        }
    }
    else if(tingkat=='SMP'){
      for(var i = 7; i <= 9; i++)
        if($old_kelas==i){
          $('<option selected/>').prop('value', i).text(i).appendTo($kelas);
        }
        else{
          $('<option/>').prop('value', i).text(i).appendTo($kelas);
        }
    }
    else if(tingkat=='SMA'){
      for(var i = 10; i <= 12; i++)
        if($old_kelas==i){
          $('<option selected/>').prop('value', i).text(i).appendTo($kelas);
        }
        else{
          $('<option/>').prop('value', i).text(i).appendTo($kelas);
        }
    }
    else if(tingkat=='UMUM'){
      $("#kelas").prop("disabled",true);
    }
  }

  $('#tingkat').on('change', function() {
    $("#kelas").empty();
    $("#kelas").removeAttr("disabled");
    if(!this.selectedIndex) return;

    var tingkat = $(this).val(),
        $kelas = $('#kelas');
        $('<option selected disabled/>').prop('value', '').text('Kelas berapa?').appendTo($kelas);

    if(tingkat=='SD'){
      for(var i = 1; i <= 6; i++)
        $('<option/>').prop('value', i).text(i).appendTo($kelas);
    }
    else if(tingkat=='SMP'){
      for(var i = 7; i <= 9; i++)
        $('<option/>').prop('value', i).text(i).appendTo($kelas);
    }
    else if(tingkat=='SMA'){
      for(var i = 10; i <= 12; i++)
        $('<option/>').prop('value', i).text(i).appendTo($kelas);
    }
    else if(tingkat=='UMUM'){
      $("#kelas").prop("disabled",true);
    }
  });

  // enable disable kelas tergantung tingkat (modal edit)
  if($('#tingkat2').val()!=null){
    $("#kelas2").empty();
    $("#kelas2").removeAttr("disabled");

    var tingkat = $('#tingkat2').val(),
        $kelas = $('#kelas2'),
        $old_kelas='{{ old('kelas2') }}';
        $('<option disabled/>').prop('value', '').text('Kelas berapa?').appendTo($kelas);
      
    if(tingkat=='SD'){
      for(var i = 1; i <= 6; i++)
        if($old_kelas==i){
          $('<option selected/>').prop('value', i).text(i).appendTo($kelas);
        }
        else{
          $('<option/>').prop('value', i).text(i).appendTo($kelas);
        }
    }
    else if(tingkat=='SMP'){
      for(var i = 7; i <= 9; i++)
        if($old_kelas==i){
          $('<option selected/>').prop('value', i).text(i).appendTo($kelas);
        }
        else{
          $('<option/>').prop('value', i).text(i).appendTo($kelas);
        }
    }
    else if(tingkat=='SMA'){
      for(var i = 10; i <= 12; i++)
        if($old_kelas==i){
          $('<option selected/>').prop('value', i).text(i).appendTo($kelas);
        }
        else{
          $('<option/>').prop('value', i).text(i).appendTo($kelas);
        }
    }
    else if(tingkat=='UMUM'){
      $("#kelas").prop("disabled",true);
    }
  }

  $('#tingkat2').on('change', function() {
    $("#kelas2").empty();
    $("#kelas2").removeAttr("disabled");
    if(!this.selectedIndex) return;

    var tingkat = $(this).val(),
        $kelas = $('#kelas2').empty();
        $('<option selected disabled/>').prop('value', '').text('Kelas berapa?').appendTo($kelas);

    if(tingkat=='SD'){
      for(var i = 1; i <= 6; i++)
        $('<option/>').prop('value', i).text(i).appendTo($kelas);
    }
    else if(tingkat=='SMP'){
      for(var i = 7; i <= 9; i++)
        $('<option/>').prop('value', i).text(i).appendTo($kelas);
    }
    else if(tingkat=='SMA'){
      for(var i = 10; i <= 12; i++)
        $('<option/>').prop('value', i).text(i).appendTo($kelas);
    }
    else if(tingkat=='UMUM'){
      $("#kelas2").prop("disabled",true);
    }
  });

  // datatable
  $("#example3").DataTable({
    "paging": true,
    "responsive": true, 
    "autoWidth": false,
    "pageLength": 10,
    "scrollCollapse": true
  }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');


  // disable/enable form input & modal edit
  $(document).ready(function() {
    // open modal edit
    $('body').on('click', '#editProgramMapel', function (event) {
        event.preventDefault();
        var id = $(this).data('id');
        console.log('id'+id)

        $.get('master-kelas/' + id + '/edit', function (data) {
          console.log('kelas : '+data.data.kelas)

            $('#modal_edit #kelas_id').val(data.data.id);
            $('#modal_edit #tingkat2').val(data.data.tingkat).prop('selected', true).trigger('change');
            $('#modal_edit #kelas2').val(data.data.kelas).prop('selected', true).trigger('change');
            // $('#modal_edit #jurusan').val(data.data.jurusan).css("text-transform","capitalize");
            $('#modal_edit').modal('show');

        })
    });

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
                  url: 'master-kelas/' + id,
                  type: 'POST',
                  data: {
                    _method: "DELETE",
                    id: id,
                  },
                  dataType: 'json',
                  success: function (data) {
                    window.location.href = '/master-kelas'
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

    // process update
    $('body').on('click', '#modal_edit #submit', function (event) {
        event.preventDefault()
        var id = $("#kelas_id").val();
        var kelas = $("#modal_edit #kelas2").val();
        var tingkat = $("#modal_edit #tingkat2").val();

        $.ajax({
          url: 'master-kelas/' + id,
          type: 'POST',
          data: {
            _method: "PUT",
            id: id,
            kelas: kelas,
            tingkat: tingkat,
          },
          dataType: 'json',
          success: function (data) {
            if($.isEmptyObject(data.error)){
              $('#kelasData').trigger("reset");
              $('#modal_edit').modal('hide');
              window.location.href = '/master-kelas'
            }else{
              $("#err_tahun_akhir").html("<small><strong>" + data.error.kelas[0] + "</strong></small>");
            }
          }
        });
    });

  });

  // modal hapus
  $(document).on("click", ".user_dialog", function () {
      var id = $(this).data('id');
      $('#id_hapus').val(id);
  });
  

</script>


@endsection