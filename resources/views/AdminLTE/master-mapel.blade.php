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

            @if($last_update_mapel->isEmpty())
                  <b>Data Master Mata Pelajaran Kosong!</b> <br> {{'Jumlah : '.$jumlah_mapel.' Mata Pelajaran'}}
            @else
              @foreach($last_update_mapel as $last)
                @if ($loop->first)
                <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> {{'Jumlah : '.$jumlah_mapel.' Mata Pelajaran'}}
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

      <div class="col-12 col-md-4">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>{{'Tambah Mata Pelajaran'}}</b></h3>

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
            <form method="POST" action="{{ route('master-mapel.store') }}" enctype="multipart/form-data">
              @csrf
              <!-- form input -->
              <div class="row">

                <!-- Nama -->
                <div class="form-group col-12">
                  <label for="name">{{ __('Nama Mata Pelajaran') }}</label>
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Apa nama mapelnya?">

                  @error('name')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>

                <!-- Materi -->
                <div class="form-group col-12">
                  <label for="name">{{ __('Materi Mata Pelajaran') }}</label>
                  <textarea id="materi" class="form-control @error('materi') is-invalid @enderror" name="materi" rows="2" autocomplete="materi" autofocus placeholder="Materinya apa ya (opsional)">{{ old('materi') }}</textarea>

                  @error('materi')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

                <!-- button  -->
                <div class="form-group col-12">
                  <button id="submit" type="submit" class="btn bg-purple btn-block">Simpan Data</button>
                </div>

              </div>

            </form>
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
        
        <!-- <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>{{'Impor Mata Pelajaran'}}</b></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          
          </div>
          
          <div class="card-body">
            <form method="POST" action="{{ route('master-mapel.store') }}" enctype="multipart/form-data">
              @csrf
              <div class="row">

                <div class="form-group col-12">
                  <input id="file_impor" type="file" class="form-control @error('file_impor') is-invalid @enderror" name="file_impor" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onchange="loadFile(event)" value="{{ old('file_impor') }}" required autocomplete="file_impor" autofocus>

                  @error('file_impor')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>

                <div class="form-group col-12">
                  <button id="submit" type="submit" class="btn bg-purple btn-block">Impor Data</button>
                </div>

              </div>

            </form>
          </div>

        </div> -->
      </div>

      <div class="col-12 col-md-8">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>{{'Data Mata Pelajaran'}}</b></h3>

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
            <table id="example2" class="table table-bordered table-hover" style="table-layout: fixed">
              <thead>
                <tr>
                  <th style="width: 8%; text-align: center;">NO</th>
                  <th style="width: 70%; text-align: center;">MATA PELAJARAN</th>
                  <th style="width: 17%; text-align: center;">AKSI</th>
                </tr>
              </thead>
              <tbody>
                @php ($no = 1)
                @foreach($mapels as $mapel)
                <tr>
                  <td style="text-align: center;">{{$no++}}</td>
                  <td><strong>{{ucwords($mapel->nama)}}</strong><br>{{ucfirst($mapel->materi)}}</td>
                  <td style="text-align: center;">
                    <a href="" class="btn btn-warning btn-sm" id="editProgramMapel" data-toggle="modal" data-id="{{ $mapel->id }}">Edit</a>
                    <button onclick="return false" id="delete_kelas" class="btn btn-sm bg-maroon"data-id="{{ $mapel->id }}">Delete</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            
            <!-- Modal Edit Data -->
            <div class="modal fade" id="modal_edit">
              <div class="modal-dialog">
                <form id="programMapelData">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h4 class="modal-title">{{'Edit Mata Pelajaran'}}</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      
                      <!-- form Edit -->
                      <div class="row">

                        <input type="hidden" id="program_mapel_id" name="program_mapel_id" value="">
                        <!-- Nama -->
                        <div class="form-group col-12">

                          <label for="name">{{ __('Nama Mata Pelajaran') }}</label>
                          
                          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Apa nama mapelnya?">

                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror

                        </div>

                        <!-- Materi -->
                        <div class="form-group col-12">
                          <label for="name">{{ __('Materi Mata Pelajaran') }}</label>
                          <textarea id="materi" class="form-control @error('materi') is-invalid @enderror" name="materi" rows="2" autocomplete="materi" autofocus placeholder="Materinya apa ya">{{ old('materi') }}</textarea>

                          @error('materi')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
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

<script>
  $("#example2").DataTable({
    "paging": true,
    "responsive": true, 
    "autoWidth": false,
    "pageLength": 10,
    "scrollCollapse": true
  }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');


  $(document).ready(function() {
    // open modal edit
    $('body').on('click', '#editProgramMapel', function (event) {

        event.preventDefault();
        var id = $(this).data('id');
        console.log('id'+id)

        $.get('master-mapel/' + id + '/edit', function (data) {

            $('#modal_edit #program_mapel_id').val(data.data.id);
            $('#modal_edit #name').val(data.data.nama);
            $('#modal_edit #materi').val(data.data.materi);
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

    // process update
    $('body').on('click', '#modal_edit #submit', function (event) {
        event.preventDefault()
        var id = $("#program_mapel_id").val();
        var nama = $("#modal_edit #name").val();
        var materi = $("#modal_edit #materi").val();

        $.ajax({
          url: 'master-mapel/' + id,
          type: 'POST',
          data: {
            _method: "PUT",
            id: id,
            nama: nama,
            materi: materi,
          },
          dataType: 'json',
          success: function (data) {
              
              $('#programMapelData').trigger("reset");
              $('#modal_edit').modal('hide');
              window.location.href = '/master-mapel'
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