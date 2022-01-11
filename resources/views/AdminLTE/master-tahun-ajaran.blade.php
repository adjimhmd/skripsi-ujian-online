@extends('AdminLTE.app')

@section('js-start')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>

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

            @if($last_update_tahun_ajaran->isEmpty())
                  <b>Data Master Tahun Ajaran Kosong!</b> <br> {{'Jumlah : '.$jumlah_tahun_ajaran.' Kelas'}}
            @else
              @foreach($last_update_tahun_ajaran as $last)
                @if ($loop->first)
                <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> {{'Jumlah : '.$jumlah_tahun_ajaran.' Kelas'}}
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
            <h3 class="card-title"><b>{{'Data Tahun Ajaran'}}</b></h3>

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
              <button type="button" class="btn bg-purple shadow-sm" data-toggle="modal" data-target="#modal-default">Tambah Tahun Ajaran</button>
            </div>
            
            <table id="example3" class="table table-bordered table-hover" style="table-layout: fixed">
              <thead>
                <tr>
                  <th style="width: 5%; text-align: center;">NO</th>
                  <th style="width: 45%; text-align: center;">TAHUN AJARAN</th>
                  <th style="width: 35%; text-align: center;">SEMESTER</th>
                  <th style="width: 15%; text-align: center;">AKSI</th>
                </tr>
              </thead>
              <tbody>
                @php ($no = 1)
                @foreach($tahun_ajarans as $tahun_ajaran)
                <tr>
                  <td style="text-align: center;">{{$no++}}</td>
                  <td style="text-align: center;">{{'Tahun Ajaran '.$tahun_ajaran->tahun_awal.'/'.$tahun_ajaran->tahun_akhir}}</td>
                  <td style="text-align: center;">{{'Semester '.ucwords($tahun_ajaran->semester)}}</td>
                  <td style="text-align: center;">
                    <a href="" class="btn btn-warning btn-sm" id="editProgramMapel" data-toggle="modal" data-id="{{ $tahun_ajaran->id }}">Edit</a>
                    <button onclick="return false" id="delete_kelas" class="btn btn-sm bg-maroon"data-id="{{ $tahun_ajaran->id }}">Delete</button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            

            <!-- Modal Add Data -->
            <div class="modal fade" id="modal-default">
              
              <div class="modal-dialog">

                <form method="POST" action="{{ route('master-tahun-ajaran.store') }}" enctype="multipart/form-data" autocomplete="off">
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

                        <!-- Tahun Awal -->
                        <div class="form-group col-6">
                          <label>Tahun Awal</label>
                          <div class="input-group date" id="tanggalawal2" data-target-input="nearest">
                              <input id="tanggal_awal" name="tanggal_awal" value="{{ old('tanggal_awal') }}" required placeholder="Tahun awal" type="number" class="form-control @error('tanggal_awal') is-invalid @enderror datetimepicker-input" data-target="#tanggalawal2" data-toggle="datetimepicker"/>
                          </div>
                          @error('tanggal_awal')
                            <span class="text-danger" role="alert">
                              <small><strong>{{ $message }}</strong></small>
                            </span>
                          @enderror
                        </div>
                        
                        <!-- Tahun Akhir -->
                        <div class="form-group col-6">
                          <label>Tahun Akhir</label>
                          <div class="input-group date" id="tanggalakhir2" data-target-input="nearest">
                              <input id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" required placeholder="Tahun akhir" type="number" class="form-control @error('tanggal_akhir') is-invalid @enderror datetimepicker-input" data-target="#tanggalakhir2" data-toggle="datetimepicker"/>
                          </div>

                          @error('tanggal_akhir')
                            <script type="text/javascript">
                              $( document ).ready(function() {
                                  $('#modal-default').modal('show');
                              });
                            </script>

                            <span class="text-danger" role="alert">
                              <small><strong>{{ $message }}</strong></small>
                            </span>
                          @enderror
                          <!-- <span id="err_tahun_akhir" class="text-danger" role="alert"></span> -->
                          <!-- /.input group -->
                        </div>

                        <!-- Semester -->
                        <div class="form-group col-12">
                          <label for="semester3">{{ __('Semester') }}</label>

                          <select id="semester3" class="form-control select2 @error('semester') is-invalid @enderror" name="semester" required autofocus>
                            @php ($list_semester = ['ganjil','genap'])
                            <option value="" selected disabled>Pilih semesternya ya</option>
                            @foreach($list_semester as $select_semester)
                                <option {{old('semester') =="$select_semester" ? "selected" : ""}} value="{{$select_semester}}">{{ucwords($select_semester)}}</option>
                            @endforeach
                          </select>

                          @error('semester')
                            <script type="text/javascript">
                              $( document ).ready(function() {
                                  $('#modal-default').modal('show');
                              });
                            </script>

                            <span class="text-danger" role="alert">
                              <small><strong>Tahun ajaran & semester sudah ada!</strong></small>
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
                      <h4 class="modal-title">{{'Edit Tahun Ajaran'}}</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      
                      <!-- form Edit -->
                      <div class="row">

                        <input type="hidden" id="tahun_ajaran_id" name="tahun_ajaran_id" value="">
                
                        <!-- Tahun Awal -->
                        <div class="form-group col-6">
                          <label>Tahun Awal</label>
                          <div class="input-group date" id="tanggalawal3" data-target-input="nearest">
                              <input id="tanggal_awal" name="tanggal_awal" value="{{ old('tanggal_awal') }}" required autocomplete="tanggal_awal" autofocus placeholder="Tahun awal" type="number" class="form-control @error('tanggal_awal') is-invalid @enderror datetimepicker-input" data-target="#tanggalawal3" data-toggle="datetimepicker"/>
                          </div>
                          @error('tanggal_awal')
                            <span class="text-danger" role="alert">
                              <small><strong>{{ $message }}</strong></small>
                            </span>
                          @enderror
                        </div>
                        
                        <!-- Tahun Akhir -->
                        <div class="form-group col-6">
                          <label>Tahun Akhir</label>
                          <div class="input-group date" id="tanggalakhir3" data-target-input="nearest">
                              <input id="tanggal_akhir" name="tanggal_akhir" value="{{ old('tanggal_akhir') }}" required autocomplete="tanggal_akhir" autofocus placeholder="Tahun akhir" type="number" class="form-control @error('tanggal_akhir') is-invalid @enderror datetimepicker-input" data-target="#tanggalakhir3" data-toggle="datetimepicker"/>
                          </div>

                          <span id="err_tahun_akhir" class="text-danger" role="alert"></span>
                          <!-- /.input group -->
                        </div>

                        
                        <!-- Semester -->
                        <div class="form-group col-12">
                          <label for="semester2">{{ __('Semester') }}</label>

                          <select id="semester2" class="form-control select2 @error('semester2') is-invalid @enderror" name="semester2" required autofocus>
                            @php ($list_semester = ['ganjil','genap'])
                            <option value="" selected disabled>Pilih semesternya ya</option>
                            @foreach($list_semester as $select_semester)
                                <option {{old('semester2') =="$select_semester" ? "selected" : ""}} value="{{$select_semester}}">{{ucwords($select_semester)}}</option>
                            @endforeach
                          </select>

                          <span id="err_semester" class="text-danger" role="alert"></span>

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
  
  //Date picker
  $('#tanggalawal').datetimepicker({
      format: "YYYY",
      viewMode: "years", 
      minViewMode: "years"
  });
  
  $('#modal-default #tanggalawal2').datetimepicker({
      format: "YYYY",
      viewMode: "years", 
      minViewMode: "years"
  });

  $('#modal_edit #tanggalawal3').datetimepicker({
      format: "YYYY",
      viewMode: "years", 
      minViewMode: "years"
  });
  
  $('#tanggalakhir').datetimepicker({
      format: "YYYY",
      viewMode: "years", 
      minViewMode: "years"
  });
  
  $('#modal-default #tanggalakhir2').datetimepicker({
      format: "YYYY",
      viewMode: "years", 
      minViewMode: "years"
  });
  
  $('#modal_edit #tanggalakhir3').datetimepicker({
      format: "YYYY",
      viewMode: "years", 
      minViewMode: "years"
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

        $.get('master-tahun-ajaran/' + id + '/edit', function (data) {
          console.log('kelas : '+data.data.tahun_awal+data.data.tahun_akhir+data.data.semester)

            $('#modal_edit #tahun_ajaran_id').val(data.data.id);
            $('#modal_edit #tanggal_awal').val(data.data.tahun_awal).prop('selected', true).trigger('change');
            $('#modal_edit #tanggal_akhir').val(data.data.tahun_akhir).prop('selected', true).trigger('change');
            $('#modal_edit #semester2').val(data.data.semester).prop('selected', true).trigger('change');
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
                  url: 'master-tahun-ajaran/' + id,
                  type: 'POST',
                  data: {
                    _method: "DELETE",
                    id: id,
                  },
                  dataType: 'json',
                  success: function (data) {
                    window.location.href = '/master-tahun-ajaran'
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
        var id = $("#tahun_ajaran_id").val();
        var tahun_awal = $("#modal_edit #tanggal_awal").val();
        var tahun_akhir = $("#modal_edit #tanggal_akhir").val();
        var semester = $("#modal_edit #semester2").val();

        $.ajax({
          url: 'master-tahun-ajaran/' + id,
          type: 'POST',
          data: {
            _method: "PUT",
            id: id,
            tahun_awal: tahun_awal,
            tahun_akhir: tahun_akhir,
            semester: semester,
          },
          dataType: 'json',
          success: function (data) {
            if($.isEmptyObject(data.error)){
              $('#kelasData').trigger("reset");
              $('#modal_edit').modal('hide');
              window.location.href = '/master-tahun-ajaran'  
            }
            else if($.isEmptyObject(data.error.tahun_akhir)){
              $("#err_tahun_akhir").empty();
              $("#err_semester").html("<small><strong>Tahun ajaran & semester sudah ada!</strong></small>");
            }
            else if($.isEmptyObject(data.error.semester)){
              $("#err_semester").empty();
              $("#err_tahun_akhir").html("<small><strong>" + data.error.tahun_akhir[0] + "</strong></small>");
            }
          }
        });
    });

  });
  

</script>


@endsection