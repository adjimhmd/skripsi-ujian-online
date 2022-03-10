@extends('AdminLTE.app')

@section('js-start')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    
    <!-- Info update Materi -->
    <div class="row mt-2 mb-2">
      <div class="col-12 col-md-12">
        <div class="alert alert-default-primary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <div style="justify-content:flex-start; display: flex;">

            <div style="display:flex; justify-content: center; align-content: center; flex-direction: column; font-size: 2rem;">
              <i class="icon fas fa-info"></i>
            </div>

            <div style="display: table-cell; vertical-align: middle;" class="ml-2">

            @if($last_update_master_materi->isEmpty())
                  <b>Data Materi Pembelajaran Kosong!</b> <br> {{'Jumlah : '.$jumlah_master_materi.' Materi'}}
            @else
              @foreach($last_update_master_materi as $last)
                @if ($loop->first)
                <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> {{'Jumlah : '.$jumlah_master_materi.' Materi'}}
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
            <h3 class="card-title"><b>{{'Data Materi Pembelajaran'}}</b></h3>

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
              <button type="button" class="btn bg-purple shadow-sm" data-toggle="modal" data-target="#modal-default">Tambah Materi Pembelajaran</button>
            </div>
            
            <table id="example3" class="table table-hover" style="table-layout: fixed">
              <thead>
                <tr>
                  <th style="width: 4%; text-align: center;">No</th>
                  <th style="width: 40%;">Deskripsi</th>
                  <th style="width: 20%;">Mata Pelajaran</th>
                  <th style="width: 25%;">Guru</th>
                  <th style="width: 11%; text-align: center;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @php ($no = 1)
                @foreach($master_materis as $master_materi)
                <tr>
                  <td style="text-align: center;">{{$no++}}</td>
                  <td>{{$master_materi->deskripsi}}<br>{{$master_materi->link_gdrive}}</td>
                  <td>{{ucwords($master_materi->nama)}}</td>
                  <td>{{$master_materi->name}}</td>
                  <td style="text-align: center;">
                    <a href="" class="btn btn-warning btn-sm" id="editProgramMapel" data-toggle="modal" data-id="{{ $master_materi->id }}">Edit</a>
                    <button onclick="return false" id="delete_kelas" class="btn btn-sm bg-maroon"data-id="{{ $master_materi->id }}">Delete</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            

            <!-- Modal Add Data -->
            <div class="modal fade" id="modal-default" enctype="multipart/form-data">
              
              <div class="modal-dialog">

                <form method="POST" action="{{ route('materi-pembelajaran.store') }}" enctype="multipart/form-data" autocomplete="off">
                  @csrf
                  <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title">{{'Buat Materi Pembelajaran'}}</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      
                      <!-- form Add -->
                      <div class="row">

                        <!-- Deskripsi -->
                        <div class="form-group col-12">
                          <label for="deskripsi">{{ __('Deskripsi') }}</label>
                          <input id="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" required placeholder="Deskripsi singkat materi pembelajaran">
                        </div>

                        <!-- Mapel -->
                        <div class="form-group col-12">
                          <label for="mapel">{{ __('Mata Pelajaran') }}</label>

                          <select id="mapel" class="form-control select2 @error('mapel') is-invalid @enderror" name="mapel" required autofocus>
                            <option value="" selected disabled>Pilih mata pelajaran</option>
                            @foreach($master_mapels as $master_mapel)
                                <option {{old('mapel') =="$master_mapel->master_mapel_id" ? "selected" : ""}} value="{{$master_mapel->master_mapel_id}}">{{$master_mapel->master_mapel_id.ucwords($master_mapel->nama)}}</option>
                            @endforeach
                          </select>
                        </div>

                        <!-- File -->
                        <div class="form-group col-12">
                          <label for="file_materi">File Materi Pembelajaran</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="file_materi" name="file_materi" required>
                              <label class="custom-file-label" for="file_materi">Choose file</label>
                            </div>
                          </div>

                          @error('file_materi')
                            <script type="text/javascript">
                              $( document ).ready(function() {
                                  $('#modal-default').modal('show');
                              });
                            </script>

                            <span class="text-danger" role="alert">
                              <small><strong>Ukuran file max 5mb!</strong></small>
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

                <form id="EditMateri" enctype="multipart/form-data" autocomplete="off" >
                  <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title">{{'Edit Materi Pembelajaran'}}</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      
                      <!-- form Edit -->
                      <div class="row">

                        <input type="hidden" id="id_master_materi" name="id_master_materi" value="">

                        <!-- Deskripsi -->
                        <div class="form-group col-12">
                          <label for="deskripsi">{{ __('Deskripsi') }}</label>
                          <input id="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}" required placeholder="Deskripsi singkat materi pembelajaran">
                        </div>

                        <!-- Mapel -->
                        <div class="form-group col-12">
                          <label for="mapel2">{{ __('Mata Pelajaran') }}</label>

                          <select id="mapel2" class="form-control select2 @error('mapel2') is-invalid @enderror" name="mapel2" required autofocus>
                            <option value="" selected disabled>Pilih mata pelajaran</option>
                            @foreach($master_mapels as $master_mapel)
                                <option {{old('mapel2') =="$master_mapel->master_mapel_id" ? "selected" : ""}} value="{{$master_mapel->master_mapel_id}}">{{$master_mapel->master_mapel_id.ucwords($master_mapel->nama)}}</option>
                            @endforeach
                          </select>
                        </div>

                        <!-- File -->
                        <div class="form-group col-12">
                          <label for="file_materi2">File Materi Pembelajaran</label>
                          <!-- <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" id="file_materi2" name="file_materi2">
                              <label class="custom-file-label" for="file_materi2">Choose file</label>
                            </div>
                          </div> -->

                          <input type="file" name="file_materi2" class="form-control" id="file_materi2">
                          <span class="text-danger" role="alert" id="err_size"></span>
                          @error('file_materi2')
                            <script type="text/javascript">
                              $( document ).ready(function() {
                                  $('#modal_edit').modal('show');
                              });
                            </script>

                            <span class="text-danger" role="alert">
                              <small><strong>Ukuran file max 5mb!</strong></small>
                            </span>
                          @enderror
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
        // console.log('id'+id)

        $.get('materi-pembelajaran/' + id + '/edit', function (data) {
          console.log('data : '+data.data.deskripsi+' || '+data.data.master_mapel_id)

            $('#modal_edit #id_master_materi').val(data.data.id);
            $('#modal_edit #deskripsi').val(data.data.deskripsi);
            $('#modal_edit #mapel2').val(data.data.master_mapel_id).prop('selected', true).trigger('change');
            // $('#modal_edit #file_materi').val(data.data.semester).prop('selected', true).trigger('change');
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
                  url: 'materi-pembelajaran/' + id,
                  type: 'POST',
                  data: {
                    _method: "DELETE",
                    id: id,
                  },
                  dataType: 'json',
                  success: function (data) {
                    window.location.href = '/materi-pembelajaran'
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
        var id = $("#id_master_materi").val();
        var deskripsi = $("#modal_edit #deskripsi").val();
        var mapel = $("#modal_edit #mapel2").val();
        // var file_materi = $("#modal_edit #file_materi2").val();

        
        if($('#modal_edit #file_materi2').val() && $('#modal_edit #file_materi2')[0].files[0].size > 5000000){
          $('#modal_edit').modal('show');
          $("#modal_edit #err_size").html("<small><strong>Ukuran file max 5mb!</strong></small>")
        }
        else{
          var formData = new FormData();
          // Attach file
          formData.append('file_materi', $('#modal_edit #file_materi2')[0].files[0]); 
          formData.append('id', id);
          formData.append('deskripsi', deskripsi);
          formData.append('mapel', mapel);
          formData.append('_method', "PUT");
          formData.append('_token', "{{ csrf_token() }}");

          $.ajax({
            url: 'materi-pembelajaran/' + id,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache : false,
            dataType: 'json',
            success: function (data) {
              if($.isEmptyObject(data.error)){
                $('#EditMateri').trigger("reset");
                $('#modal_edit').modal('hide');
                window.location.href = '/materi-pembelajaran'  
              }
              else{
                $('#modal_edit #id_master_materi').val(id);
                $('#modal_edit #deskripsi').val(deskripsi);
                $('#modal_edit #mapel2').val(mapel).prop('selected', true).trigger('change');
                $('#modal_edit').modal('show');
              }
            }
          });
        };
    });

  });
  

</script>


@endsection