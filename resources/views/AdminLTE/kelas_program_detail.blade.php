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
      @php($text='Program')
    @endif
    
  @endforeach

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


    @if($data_kelas->jurusan==null or $data_kelas->jurusan=='') @php($tanda='')
    @else @php($tanda=' - '.ucwords($data_kelas->jurusan))
    @endif

    <div class="row mt-3 mb-2">

      <!-- About kelas -->
      <div class="col-12">

        <div class="card card-outline card-purple">
        
        <div class="card-header">
          <h1 class="card-title"><strong>
            @if($data_kelas->tipe=='sekolah'){{'Kelas '.$data_kelas->deskripsi}}
            @else{{'Program Kursus '.$data_kelas->deskripsi}}
            @endif
          </strong></h1>
        </div>
        <!-- /.card-header -->
        
        <div class="card-body py-auto">
              
            <div class="row">
              <div class="col-4">
                <h6><b>
                  @if($data_kelas->tipe=='sekolah')Harga Kelas
                  @else Harga Program Kursus
                  @endif
                </b><br style="display: block; content: ''; margin-top: 0.2rem;">{{'Rp '.number_format($data_kelas->harga,0,',',',')}}</h6>
              </div>
              
              <div class="col-4">
                <h6><b>Master Kelas</b><br style="display: block; content: ''; margin-top: 0.2rem;">{{$data_kelas->kelas.' '.$data_kelas->tingkat.'/sederajat'.$tanda}}</h6>
              </div>

              <div class="col-4">
                <h6><b>Mata Pelajaran</b><br style="display: block; content: ''; margin-top: 0.2rem;">
                  @if($data_kelas->materi) {{ucwords($data_kelas->nama_mapel).' - '.ucwords($data_kelas->materi)}}
                  @else {{ucwords($data_kelas->nama_mapel)}}
                  @endif
                </h6>
              </div>
            </div>
                  
            
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->

      </div>
      
    </div>
    <!-- /.row -->


    <!-- Rombongan Belajar -->
    <div class="row mb-2">

      <!-- About sekolah & Guru Box -->
      <!-- <div class="col-3">

        <div class="card">
          <div class="card-body">
            <strong><center>{{$data_kelas->nama_sekolah}}</center></strong>
            <center>{{$data_kelas->nomor_induk}}</center><hr>
            
            <strong><i class="fas fa-map-pin mr-1"></i> Alamat</strong>
            <p class="text-muted">{{ucwords($data_kelas->alamat)}}</p>
            <strong><i class="far fa-building mr-1"></i> Kelas</strong>
            <p class="text-muted">{{$data_kelas->kelas}}
              @if($data_kelas->tingkat=='SD') {{' SD/sederajat'}}
              @elseif($data_kelas->tingkat=='SMP') {{' SMP/sederajat'}}
              @elseif($data_kelas->tingkat=='SMA') {{' SMA/sederajat'}}
              @endif
            </p>
            @if($data_kelas->jurusan!=NULL)
              <strong><i class="fas fa-graduation-cap mr-1"></i> Jurusan</strong>
              <p class="text-muted">{{$data_kelas->jurusan}}</p>
            @endif
            <strong><i class="fas fa-dollar-sign mr-1"></i> Harga Kelas</strong>
            <p class="text-muted">{{'Rp '.$data_kelas->harga.' '}}
              @if (Auth::user()->hasRole('adm_instansi'))
              <a type="button" id="edit_kelas_program" data-toggle="modal" data-target="#modal_edit" data-id="{{$data_kelas->id_kelas_program}}"><i class="fas fa-edit"></i></a>
              @endif
            </p>

            <button onclick="return false" id="delete_kelas" class="btn btn-sm btn-block bg-maroon"data-id="">Hapus Kelas</button>
            <hr>

            <div class="text-center mb-4">
            @if(empty($data_guru->foto))
              <img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" alt="user-avatar" class="profile-user-img img-fluid img-circle">
            @else
              <img src="{{'/'.$data_guru->foto}}" alt="user-avatar" class="profile-user-img img-fluid img-circle">
            @endif
            </div>

            <strong><center>{{$data_guru->name ?? "-" }}</center></strong>
            <center>{{$data_guru->nuptk ?? "-" }}</center><hr>
            
            <strong><i class="fas fa-venus-mars mr-1"></i> Gender</strong>
            <p class="text-muted">{{$data_guru->jenis_kelamin ?? "-" }}</p>
            <strong><i class="fas fa-birthday-cake mr-1"></i> Tanggal Lahir</strong>
            @if(empty($data_guru->updated_at))
              <p class="text-muted">{{'-'}}</p>
            @else 
              <p class="text-muted">{{$tgl=$data_guru->updated_at->isoFormat('dddd, D MMMM Y')}}</p>
            @endif
            <strong><i class="fas fa-phone-square-alt mr-1"></i> No. Telp</strong>
            <p class="text-muted">{{$data_guru->no_telp ?? "-" }}</p>
            <strong><i class="fas fa-envelope-open-text mr-1"></i> E-mail</strong>
            <p class="text-muted">{{$data_guru->email ?? "-" }}</p>
          </div>

        </div>

      </div> -->

      <div class="col-6">

        <div class="card">
        
          <div class="card-header border-0">
            <h3 class="card-title"><b>{{'Rombongan Belajar '}}</b></h3>

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

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">

                <table class="table table-hover table-valign-middle" id="example2">
                  <thead>
                    <tr>
                      <th style="width: 5%; text-align: center;">No</th>
                      <th style="width: 50%;">Data Siswa</th>
                      <th style="width: 20%; text-align: center;">NISN</th>
                      <th style="width: 20%; text-align: center;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($no=1)
                    @foreach($siswa_kelass as $siswa_kelas)
                    <tr>
                      <td style="text-align: center;">{{$no++}}</td>
                      @if($siswa_kelas->foto==null)
                        <td><img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class='img-circle mr-3' alt='User Image' style='max-width:35px'>{{$siswa_kelas->name}}</td>
                      @else
                        <td><img src="{{'/'.$siswa_kelas->foto}}" class='img-circle mr-3' alt='User Image' style='max-width:35px'>{{$siswa_kelas->name}}</td>
                      @endif
                      <td style="text-align: center;">{{$siswa_kelas->nisn}}</td>
                      <td style="text-align: center;">
                        <a href="#verifikasi" class="btn btn-sm bg-purple btn_verif" data-toggle="modal" 
                          data-id-rombel="{{ $siswa_kelas->id_rombongan_belajar }}" 
                          data-nama="{{ $siswa_kelas->name }}" 
                          data-email="{{ $siswa_kelas->email }}"
                          data-foto="{{ $siswa_kelas->foto }}"
                          data-tanggal_lahir="{{ \Carbon\Carbon::parse($siswa_kelas->tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}"
                          data-jenis_kelamin="{{ ucwords($siswa_kelas->jenis_kelamin) }}"
                          data-telp="{{ $siswa_kelas->no_telp }}"
                          data-nisn="{{ $siswa_kelas->nisn }}" 
                          data-nama_wali="{{ $siswa_kelas->nama_wali }}" 
                          data-telp_wali="{{ $siswa_kelas->email_wali }}" 
                          data-bukti="{{ $siswa_kelas->bukti_bayar }}"
                          data-status="{{ '1' }}"><i class="fas fa-eye"></i>  Lihat
                        </a>
                        <!-- <a href="{{route('kelas-program.show',1)}}" class="btn bg-purple btn-sm" >Detail</a> -->
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            
          </div>
          <!-- /.card-body -->

        </div>

      </div>

      <div class="col-6">

        <div class="card">

          <div class="card-header border-0">
            <h3 class="card-title"><b>{{'Siswa Mendaftar '}}</b></h3>

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

            <!-- Table row -->
            <div class="row">
              <div class="col-12 table-responsive">

                <table class="table table-hover table-valign-middle" id="example1">
                  <thead>
                    <tr>
                      <th style="width: 5%; text-align: center;">No</th>
                      <th style="width: 50%;">Data Siswa</th>
                      <th style="width: 20%; text-align: center;">NISN</th>
                      <th style="width: 20%; text-align: center;">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php($no=1)
                    @foreach($siswa_permintaans as $siswa_permintaan)
                      @php($profil="{{}}")
                      @php($profil="{{}}")
                    <tr>
                      <td style="text-align: center;">{{$no++}}</td>
                      @if($siswa_permintaan->foto==null)
                        <td><img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class='img-circle mr-3' alt='User Image' style='max-width:35px'>{{$siswa_permintaan->name}}</td>
                      @else
                        <td><img src="{{'/'.$siswa_permintaan->foto}}" class='img-circle mr-3' alt='User Image' style='max-width:35px'>{{$siswa_permintaan->name}}</td>
                      @endif
                      <td style="text-align: center;">{{$siswa_permintaan->nisn}}</td>
                      <td style="text-align: center;">
                      
                        <a href="#verifikasi" class="btn btn-sm bg-purple btn_verif" data-toggle="modal" 
                          data-id-rombel="{{ $siswa_permintaan->id_rombongan_belajar }}" 
                          data-nama="{{ $siswa_permintaan->name }}" 
                          data-email="{{ $siswa_permintaan->email }}"
                          data-foto="{{ $siswa_permintaan->foto }}"
                          data-tanggal_lahir="{{ \Carbon\Carbon::parse($siswa_permintaan->tanggal_lahir)->isoFormat('dddd, D MMMM Y') }}"
                          data-jenis_kelamin="{{ ucwords($siswa_permintaan->jenis_kelamin) }}"
                          data-telp="{{ $siswa_permintaan->no_telp }}"
                          data-nisn="{{ $siswa_permintaan->nisn }}" 
                          data-nama_wali="{{ $siswa_permintaan->nama_wali }}" 
                          data-telp_wali="{{ $siswa_permintaan->email_wali }}" 
                          data-bukti="{{ $siswa_permintaan->bukti_bayar }}"
                          data-status="{{ '0' }}"><i class="fas fa-eye"></i>  Lihat
                        </a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                

              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

          </div>
          <!-- /.card-body -->
        </div>

      </div>
              
    </div>
    <!-- /.row -->


    <!-- Modal Edit Data -->
    <div class="modal fade" id="modal_edit">
      <div class="modal-dialog modal-xs">
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

                <!-- Harga -->
                <div class="form-group col-12">
                  <label for="jurusan">{{ __('Harga') }}</label>
                  <input id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('jurusan') }}" autocomplete="harga" autofocus placeholder="Masukkan harga kelasnya ya">

                  @error('harga')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>

              </div>

            </div>

            <div class="modal-footer justify-content-between">
              <button id="btn_update_harga" class="btn bg-purple btn-block">Update Harga</button>
            </div>

          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

    
    <!-- modal acc verifikasi -->
    <div class="modal fade" id="verifikasi">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title me-auto judul_verifikasi">Verifikasi User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
              <div class="row">
                <div class="col-12 d-flex align-items-stretch flex-column">
                  <div class="card bg-light d-flex flex-fill">

                    <div class="card-body pt-0 mt-4">
                      <div class="row">

                        <div class="col-4 d-flex flex-column align-items-center text-center">

                          <img id="text_foto" style="max-width: 100px;" src="{{asset('AdminLTE/dist/img/user1-128x128.jpg')}}" alt="user-avatar" class="img-circle img-fluid">
                          <div class="mt-3">
                            <h5><b class="text_nama">-</b></h5>
                            <p class="mb-0 text-secondary text_nisn text_role">-</p>
                            <!-- <p class="mb-0 text-secondary text_status">Bay Area, San Francisco, CA</p> -->
                          </div>

                        </div>

                        <div class="col-8 pl-4">
                          <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="text_email mb-1">- </li>
                            <li class="text_tgl_lahir mb-1">- </li>
                            <li class="text_gender mb-1">- </li>
                            <li class="text_no_telp mb-1">- </li>
                            <li class="text_nama_wali mb-1">- </li>
                            <li class="text_no_wali mb-1">- </li>
                          </ul>
                        </div>

                      </div>
                    </div>

                    @if (Auth::user()->hasRole('adm_instansi'))
                    <div class="card-footer">
                      
                      <form method="POST" action="{{ route('kelas-program.update',1) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="keterangan" value="terima_user">
                        <div class="text-right">
                          <!-- <button id="btn1">Set Text</button> -->
                          <input id="id" name="id" hidden value="">
                          @if($data_kelas->harga!='0')
                          <a id="link_bukti" href="#" class="btn btn-sm btn-secondary" target="_blank"><i class="fas fa-file-invoice-dollar"></i> Lihat Bukti Pembayaran</a>
                          @endif
                          <button id="submit" type="submit" class="btn bg-purple btn-sm btn_terima" hidden><i class="fas fa-user-check"></i> Valid</button>
                        </div>
                      </form>

                    </div>
                    @endif
                  </div>
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

  // Initialize Select2 Elements
  $(document).ready(function() {
    $('.select2').select2({
      theme: 'bootstrap4',
    })
    
  });


  // datatable
  $(document).ready(function() {
    $("#example1").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "pageLength": 10,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    
    $("#example2").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "pageLength": 10,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');


    // edit harga
    $(document).on("click", "#edit_kelas_program", function () {

      var id_kelas_program = $(this).data('id');
      
      $.ajax({
          url: "{{ route('edit.harga') }}",
          type:'POST',
          data: {_token:'{{ csrf_token() }}', id:id_kelas_program},
          cache: false,
          dataType: 'json',
          success: function(dataResult){
            var resultData = dataResult.data;
            $.each(resultData,function(index,row){

              $('#modal_edit #kelas_id').val(row.id);
              $('#modal_edit #harga').val(row.harga);

            })
          }
      });
    }); 

    // update harga
    $(document).on("click", "#modal_edit #btn_update_harga", function () {

      var id_kelas_program = $('#modal_edit #kelas_id').val();
      var harga = $('#modal_edit #harga').val();

      $.ajax({
          url: "{{ route('update.harga') }}",
          type:'POST',
          data: {_token:'{{ csrf_token() }}',id_kelas_program:id_kelas_program,harga:harga},
          cache: false,
          dataType: 'json',
          success: function(dataResult){
            window.location.reload();
          }
      });
    }); 

  });


  
  // pass value to modal
  $(document).on("click", ".btn_verif", function () {

    var id = $(this).data('id-rombel');
    var nama = $(this).data('nama');
    var email = $(this).data('email');
    var foto = $(this).data('foto');
    var tanggal_lahir = $(this).data('tanggal_lahir');
    var jenis_kelamin = $(this).data('jenis_kelamin');
    var no_telp = $(this).data('telp');
    var nisn = $(this).data('nisn');
    var nama_wali = $(this).data('nama_wali');
    var telp_wali = $(this).data('telp_wali');
    var bukti_bayar = $(this).data('bukti');
    var status = $(this).data('status');

    if(foto.length){
      foto='/'+foto;
    }else{
      foto="{{asset('AdminLTE/dist/img/default-150x150.png')}}";
    }

    $(".judul_verifikasi").text('Data Siswa');
    $("#id").attr( "value",id);
    $("#text_foto").attr( "src",foto);
    $(".text_nama").text(nama);
    $(".text_nisn").text('NISN: '+nisn);

    // alert(nama);
    $(".text_email").html( '<span class="fa-li"><i class="fas fa-envelope-open-text"></i></span>'+email );
    $(".text_tgl_lahir").html( '<span class="fa-li"><i class="fas fa-birthday-cake"></i></span>'+tanggal_lahir );
    $(".text_gender").html( '<span class="fa-li"><i class="fas fa-venus-mars"></i></span>'+jenis_kelamin );
    $(".text_no_telp").html( '<span class="fa-li"><i class="fas fa-mobile-alt"></i></span>'+no_telp );
    $(".text_nama_wali").html( '<span class="fa-li"><i class="fas fa-user-tie"></i></span>'+nama_wali );
    $(".text_no_wali").html( '<span class="fa-li"><i class="fas fa-envelope-open-text"></i></span>'+telp_wali );

    if(status==0){
      $(".btn_terima").prop('hidden', '');
      $("#link_bukti").attr( "href",'/'+bukti_bayar);
    }
    else if(status==1){
      $(".btn_terima").prop('hidden', 'true');
      $("#link_bukti").attr( "href",'/'+bukti_bayar);
    }
  });

</script>

@endsection