<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" http-equiv="Content-Type" content="width=device-width, initial-scale=1, text/html, charset=ISO-8859-1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Adji | 1705551004</title>

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- ckeditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script>
    @yield('js-start')

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')}}">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/toastr/toastr.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/jqvmap/jqvmap.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/daterangepicker/daterangepicker.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('AdminLTE/plugins/summernote/summernote-bs4.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('AdminLTE/dist/css/adminlte.min.css')}}">
    <!-- sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    

  </head>
  <body class="sidebar-collapse layout-navbar-fixed layout-fixed sidebar-mini">
    <div class="wrapper">

      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
      </div>

      <!-- Navbar -->
      @include('AdminLTE/header')
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @include('AdminLTE/sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">


            @if (Auth::user()->hasRole('adm_instansi'))
              @foreach($user_admin_instansis as $user_admin_instansi)
                @if($user_admin_instansi->tipe=='sekolah')
                  @php($tipe='Sekolah')
                  @php($text='Kelas')
                @elseif($user_admin_instansi->tipe=='lembaga_kursus')
                  @php($tipe='Lembaga Kursus')
                  @php($text='Program Kursus')
                @endif
              @endforeach
            @endif
            
              @if(Route::currentRouteNamed('kelas-program.show'))
                @if($user_admin_instansis->isEmpty())
                  @if($tipe_siswa)
                    @if($tipe_siswa->tipe=='sekolah')
                      @php($tipe='Sekolah')
                      @php($text='Kelas')
                    @elseif($tipe_siswa->tipe=='lembaga_kursus')
                      @php($tipe='Lembaga Kursus')
                      @php($text='Program Kursus')
                    @endif
                  
                  @endif
                @endif
              @endif

              

              <div class="col-sm-6">
                @if (Route::currentRouteNamed('home'))
                  <h1 class="m-0">Beranda</h1>
                @elseif (Route::currentRouteNamed('bank_soals.index') || Route::currentRouteNamed('bank_soals.edit'))
                  <h1 class="m-0">Bank Soal</h1>
                @elseif (Route::currentRouteNamed('profile.index'))
                  <h1 class="m-0">Profile</h1>
                @elseif (Route::currentRouteNamed('rating.guru'))
                  <h1 class="m-0">Penilaian Guru</h1>
                @elseif (Route::currentRouteNamed('rating.instansi'))
                  <h1 class="m-0">Penilaian Lembaga Pendidikan</h1>
                @elseif (Route::currentRouteNamed('list-instansi.index'))
                  <h1 class="m-0">Lembaga Pendidikan</h1>
                @elseif (Route::currentRouteNamed('instansi-pendidikan.index'))
                  <h1 class="m-0">Data {{$tipe}}</h1>
                @elseif (Route::currentRouteNamed('list.kelas.program'))
                  <h1 class="m-0">Kelas & Program Kursus</h1>
                @elseif (Route::currentRouteNamed('paket_soal.index') || Route::currentRouteNamed('paket_soal.show'))
                  <h1 class="m-0">Paket Soal
                  @foreach($nama_instansis as $nama_instansi)
                    @if($nama_instansi->nama!=NULL) <small><i> ({{$nama_instansi->nama}})</i></small> @endif
                  @endforeach</h1>
                @elseif (Route::currentRouteNamed('kelas-program.index') || Route::currentRouteNamed('kelas-program.show') || Route::currentRouteNamed('show.kelas_program'))
                  <h1 class="m-0">Data {{$text}}
                  @foreach($nama_instansis as $nama_instansi)
                    @if($nama_instansi->nama!=NULL) <small><i> ({{$nama_instansi->nama}})</i></small> @endif
                  @endforeach</h1>
                @elseif (Route::currentRouteNamed('ruang-ujian.index') || Route::currentRouteNamed('ruang-ujian.show') || Route::currentRouteNamed('hasil.ujian'))
                  <h1 class="m-0">Ruang Ujian
                  @foreach($nama_instansis as $nama_instansi)
                    @if($nama_instansi->nama!=NULL) <small><i> ({{$nama_instansi->nama}})</i></small> @endif
                  @endforeach</h1>
                @elseif (Route::currentRouteNamed('list.siswa'))
                  <h1 class="m-0">Daftar Siswa
                  @foreach($nama_instansis as $nama_instansi)
                    @if($nama_instansi->nama!=NULL) <small><i> ({{$nama_instansi->nama}})</i></small> @endif
                  @endforeach</h1>
                @elseif (Route::currentRouteNamed('list.guru'))
                  <h1 class="m-0">Daftar Guru
                  @foreach($nama_instansis as $nama_instansi)
                    @if($nama_instansi->nama!=NULL) <small><i> ({{$nama_instansi->nama}})</i></small> @endif
                  @endforeach</h1>
                @elseif (Route::currentRouteNamed('nilai-ujian.index') || Route::currentRouteNamed('nilai-ujian.show') || Route::currentRouteNamed('nilai-ujian.store'))
                  <h1 class="m-0">Nilai Ujian
                  @foreach($nama_instansis as $nama_instansi)
                    @if($nama_instansi->nama!=NULL) <small><i> ({{$nama_instansi->nama}})</i></small> @endif
                  @endforeach</h1>
                @elseif (Route::currentRouteNamed('list-guru.index'))
                  <h1 class="m-0">Data Guru
                  @foreach($nama_instansis as $nama_instansi)
                    @if($nama_instansi->nama!=NULL) <small><i> ({{$nama_instansi->nama}})</i></small> @endif
                  @endforeach</h1>
                @elseif (Route::currentRouteNamed('master-kelas.index') || Route::currentRouteNamed('master-kelas.edit'))
                  <h1 class="m-0">Data Master Kelas</h1>
                @elseif (Route::currentRouteNamed('master-mapel.index') || Route::currentRouteNamed('master-mapel.edit'))
                  <h1 class="m-0">Data Master Mata Pelajaran</h1>
                @elseif (Route::currentRouteNamed('master-tahun-ajaran.index') || Route::currentRouteNamed('master-tahun-ajaran.edit'))
                  <h1 class="m-0">Data Tahun Ajaran</h1>
                @endif
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  @if (Route::currentRouteNamed('home'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                  @elseif (Route::currentRouteNamed('bank_soals.index') || Route::currentRouteNamed('bank_soals.edit'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Bank Soal</li>
                  @elseif (Route::currentRouteNamed('profile.index'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Profile</li>                    
                  @elseif (Route::currentRouteNamed('rating.guru'))
                      <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                      <li class="breadcrumb-item active">Penilaian Guru</li>
                  @elseif (Route::currentRouteNamed('rating.instansi'))
                      <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                      <li class="breadcrumb-item active">Penilaian Lembaga Pendidikan</li>
                  @elseif (Route::currentRouteNamed('list-instansi.index'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Lembaga Pendidikan</li>
                  @elseif (Route::currentRouteNamed('instansi-pendidikan.index'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Data {{$tipe}}</li>
                  @elseif (Route::currentRouteNamed('list.kelas.program'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Kelas & Program Kursus</li>
                  @elseif (Route::currentRouteNamed('paket_soal.index') || Route::currentRouteNamed('paket_soal.show'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Paket Soal</li>
                  @elseif (Route::currentRouteNamed('kelas-program.index') || Route::currentRouteNamed('kelas-program.show') || Route::currentRouteNamed('show.kelas_program'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Data {{$text}}</li>
                  @elseif (Route::currentRouteNamed('ruang-ujian.index') || Route::currentRouteNamed('ruang-ujian.show') || Route::currentRouteNamed('hasil.ujian'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Ruang Ujian</li>
                  @elseif (Route::currentRouteNamed('list.siswa'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Siswa</li>
                  @elseif (Route::currentRouteNamed('list.guru'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Daftar Guru</li>
                  @elseif (Route::currentRouteNamed('nilai-ujian.index') || Route::currentRouteNamed('nilai-ujian.show') || Route::currentRouteNamed('nilai-ujian.store'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Nilai Ujian</li>
                  @elseif (Route::currentRouteNamed('list-guru.index'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Data Guru</li>
                  @elseif (Route::currentRouteNamed('master-kelas.index') || Route::currentRouteNamed('master-kelas.editMaster Kelas'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Data Master Kelas</li>
                  @elseif (Route::currentRouteNamed('master-mapel.index') || Route::currentRouteNamed('master-mapel.edit'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Data Master Mata Pelajaran</li>
                  @elseif (Route::currentRouteNamed('master-tahun-ajaran.index') || Route::currentRouteNamed('master-tahun-ajaran.edit'))
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active">Data Master Tahun Ajaran</li>
                  @endif
                </ol>
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
              
          @if(Route::current()->getName() == 'kelas-program.index')

            @foreach($nama_instansis as $nama_instansi)

              @if($nama_instansi->nama==NULL)
            
                <!-- modal profil instansi -->
                <script>
                  $(function() {
                    Swal.fire({
                      title: 'Data '+<?php echo json_encode($tipe); ?>,
                      text: 'Lengkapi data '+<?php echo json_encode(strtolower($tipe)); ?>+'mu sekarang!',
                      icon: 'warning',
                      showCloseButton: true,
                      confirmButtonText: 'Lengkapi sekarang!'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = "{{ route('instansi-pendidikan.index')}}";
                      }
                    })
                  });
                </script>

              @endif
            
            @endforeach

          @endif

          
          @foreach($foto_profil as $fp)

            @if($fp->foto==NULL)
              @if(!Route::currentRouteNamed('profile.index'))
              <!-- modal profil diri -->
              <script>
                $(function() {
                  Swal.fire({
                    title: 'Data Diri',
                    text: "Lengkapi data dirimu sekarang!",
                    icon: 'warning',
                    showCloseButton: true,
                    confirmButtonText: 'Lengkapi sekarang!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = "{{ route('profile.index')}}";
                    }
                  })
                });
              </script>
              @endif 
            @endif

          @endforeach

          @yield('content')
          <!-- /.content -->

      </div>
      <!-- /.content-wrapper -->
      @include('AdminLTE/footer')

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{asset('AdminLTE/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('AdminLTE/plugins/toastr/toastr.min.js')}}"></script>
    
    <!-- Select2 -->
    <script src="{{asset('AdminLTE/plugins/select2/js/select2.full.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{asset('AdminLTE/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{asset('AdminLTE/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('AdminLTE/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('AdminLTE/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('AdminLTE/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{asset('AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('AdminLTE/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <script src="summernote-cleaner.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/pdfmake/vfs_fonts.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- overlayScrollbars -->
    <script src="{{asset('AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('AdminLTE/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('AdminLTE/dist/js/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('AdminLTE/dist/js/pages/dashboard.js')}}"></script>
    @yield('js-end')
  </body>

</html>
