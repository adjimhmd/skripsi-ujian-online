@extends('AdminLTE.app')

@section('js-start')

  
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    
    <!-- Info update pembayaran -->
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
                  <b>Belum mendaftar kelas / program kursus apapun!</b> <br> 
          
                  @if (Auth::user()->hasRole('guru'))
                    {{'Total Kelas: '.$total_kelas.', Total Program Kursus: '.$total_program}}
                  @else
                    {{$jumlah_terdaftar.' terdaftar, '.$jumlah_menunggu.' menunggu pembayaran'}}
                  @endif

                @else
                  @foreach($last_update as $last)
                    @if ($loop->first)
                    <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> 
          
                    @if (Auth::user()->hasRole('guru'))
                      {{'Total Kelas: '.$total_kelas.', Total Program Kursus: '.$total_program}}
                    @else
                      {{$jumlah_terdaftar.' terdaftar, '.$jumlah_menunggu.' menunggu pembayaran'}}
                    @endif

                    @endif
                  @endforeach
                @endif
            </div>
          </div>
          
        </div>
      </div>
    </div>
    
    @foreach($list_kelass as $list_kelas)
      @if($list_kelas->kelas!=null or $list_kelas->kelas!='')
        @php($kelas='Tingkat '.$list_kelas->kelas.' '.$list_kelas->tingkat.'/sederajat')
      @endif
    @endforeach
    <div class="row mt-2 mb-2">

      <!-- Data Kelas -->
      <div class="col-12">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>List Kelas  {{$kelas ?? ""}}</b></h3>

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
              <!-- list kelas -->
              <table id="example1" class="table table-hover table-valign-middle"style="table-layout: fixed">
                <thead>
                  <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 5%;">Sekolah</th>
                    <!-- <th style="width: 40%;">Siswa</th> -->
                    <th style="width: 65%;">Data Kelas</th>
                    <th style="width: 10%; text-align: center;">Status</th>
                    <th style="width: 5%; text-align: center;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php ($no = 1)
                  @foreach($list_kelass as $list_kelas)
                  @if($list_kelas->tipe=='sekolah')
                  
                    @if($list_kelas->foto===null)
                      @php($profil="/AdminLTE/dist/img/default-150x150.png")
                    @else
                      @php($profil="/"."$list_kelas->foto")
                    @endif

                    @if($list_kelas->jurusan===null)
                      @php($jurusan='')
                    @else
                      @php($jurusan=' - '.$list_kelas->jurusan)
                    @endif
                    <tr>
                      <td style="text-align:center;">{{$no++}}</td>
                      <td><b>{{$list_kelas->nama_instansi}}</b>{{' | NPSN: '.$list_kelas->nomor_induk}}
                      </td>
                      <!-- <td><img src="{{$profil}}" class="img-circle mr-4" alt="User Image" style="max-width:40px">{{$list_kelas->name ?? 'Guru belum ditentukan!'}}</td> -->
                      <td> 
                          @php($i=0)
                          <h6 style="margin-bottom:0;">{{'Kelas '.$list_kelas->kls_program}}
                          <small><b>(Mata Pelajaran: 
                          @foreach($mapel_rombels as $mapel_rombel)
                            @if($mapel_rombel->id_rombongan_belajar==$list_kelas->id_rombongan_belajar)
                            @php($i++)
                              @if($i!=1){{', '.ucwords($mapel_rombel->nama)}}
                              @else{{ucwords($mapel_rombel->nama)}}
                              @endif
                            @endif
                          @endforeach
                          )</b></small>
                          </h6>
                        <!-- <p style="margin-bottom:0;"> -->
                          <!-- @if($list_kelas->materi==='' || $list_kelas->materi===null) {{' | '.ucwords($list_kelas->nama_mapel)}}
                          @else {{' | '.ucwords($list_kelas->nama_mapel)}}{{' - '.$list_kelas->materi}}
                          @endif -->
                          
                          @if($list_kelas->status=='1')
                            @foreach($total_ujians as $total_ujian)
                              @if($total_ujian->kelas_program_id==$list_kelas->id_kelas_program)
                                <a href="{{route('ruang-ujian.index')}}" class="btn bg-secondary btn-xs">Ujian <small class="badge bg-white">{{$total_ujian->jumlah}}</small></a>
                              @endif
                            @endforeach
                          @endif
                        </h6>
                      </td> 
                      <td style="text-align: center;">
                        @if($list_kelas->status==null)
                          <small class="badge bg-maroon mb-2"><i class="fas fa-times"></i>{{' Belum bayar'}}</small><br>
                        @elseif($list_kelas->status=='0')
                          <small class="badge badge-warning mb-2"><i class="fas fa-exclamation"></i>{{' Menunggu'}}</small><br>
                        @elseif($list_kelas->status=='1')
                          <small class="badge badge-success mb-2"><i class="fas fa-check"></i>{{' Terdaftar'}}</small><br>
                        @endif
                      </td>
                      <td style="text-align: center;">
                        
                        @if (Auth::user()->hasRole('guru'))
                          <a href="{{route('kelas-program.show',$list_kelas->id_kelas_program)}}" class="btn bg-purple btn-sm" >Detail</a>
                        @else
                          @if($list_kelas->status==null)
                            <!-- <form method="POST" action="{{ route('bayar.dulu') }}" enctype="multipart/form-data"> -->
                            <form method='POST' action='{{ route("orders.store") }}' enctype='multipart/form-data'>
                              @csrf
                              <input type="hidden" name="id_kelas_program" value="{{$list_kelas->id_kelas_program}}">
                              <input type="hidden" name="id_rombongan_belajar" value="{{$list_kelas->id_rombongan_belajar}}">
                              <input type='hidden' name='id_harga' value='{{$list_kelas->id_harga}}'>
                              <button type="submit" class="btn btn-sm bg-maroon">Bayar</button>
                            </form>
                          @else
                            <a href="{{route('kelas-program.show',$list_kelas->id_kelas_program)}}" class="btn bg-purple btn-sm" >Detail</a>
                          @endif
                        @endif
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
      <!-- /.col -->

      <!-- Data Program Kursus -->
      <div class="col-12">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>List Program Kursus  {{$kelas ?? ""}}</b></h3>

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
              
              <!-- list program kursus -->
              <table id="example2" class="table table-hover table-valign-middle"style="table-layout: fixed">
                <thead>
                  <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 5%;">Sekolah</th>
                    <!-- <th style="width: 40%;">Siswa</th> -->
                    <th style="width: 65%;">Data Program Kursus</th>
                    <th style="width: 10%; text-align: center;">Status</th>
                    <th style="width: 5%; text-align: center;">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @php ($no = 1)
                  @foreach($list_kelass as $list_kelas)
                  @if($list_kelas->tipe=='lembaga_kursus')
                  
                    @if($list_kelas->foto===null) @php($profil="/AdminLTE/dist/img/default-150x150.png")
                    @else @php($profil="/"."$list_kelas->foto")
                    @endif

                    @if($list_kelas->jurusan===null) @php($jurusan='')
                    @else @php($jurusan=' - '.$list_kelas->jurusan)
                    @endif

                    <tr>
                      <td style="text-align:center;">{{$no++}}</td>
                      <td><b>{{$list_kelas->nama_instansi}}</b>{{' | NILEK: '.$list_kelas->nomor_induk}}
                      </td>
                      <!-- <td><img src="{{$profil}}" class="img-circle mr-4" alt="User Image" style="max-width:40px">{{$list_kelas->name ?? 'Guru belum ditentukan!'}}</td> -->
                      <td> 
                        <h6 style="margin-bottom:0;">{{'Program '.$list_kelas->kls_program}}
                        <small><b>{{'(Mapel: '.ucwords($list_kelas->nama_mapel).')'}}</b></small></h6>
                          <!-- @if($list_kelas->materi==='' || $list_kelas->materi===null) {{ucwords($list_kelas->nama_mapel)}}
                          @else {{ucwords($list_kelas->nama_mapel)}}{{' - '.$list_kelas->materi}}
                          @endif -->
                          
                          @if($list_kelas->status=='1')
                            @foreach($total_ujians as $total_ujian)
                              @if($total_ujian->kelas_program_id==$list_kelas->id_kelas_program)
                                <a href="{{route('ruang-ujian.index')}}" class="btn bg-secondary btn-xs">Ujian <small class="badge bg-white">{{$total_ujian->jumlah}}</small></a>
                              @endif
                            @endforeach
                          @endif
                        </h6>
                      </td> 
                      <td style="text-align: center;">
                        @if($list_kelas->status==null)
                          <small class="badge bg-maroon mb-2"><i class="fas fa-times"></i>{{' Belum bayar'}}</small><br>
                        @elseif($list_kelas->status=='0')
                          <small class="badge badge-warning mb-2"><i class="fas fa-exclamation"></i>{{' Menunggu'}}</small><br>
                        @elseif($list_kelas->status=='1')
                          <small class="badge badge-success mb-2"><i class="fas fa-check"></i>{{' Terdaftar'}}</small><br>
                        @endif
                      </td>
                      <td style="text-align: center;">
                        
                        @if (Auth::user()->hasRole('guru'))
                          <a href="{{route('kelas-program.show',$list_kelas->id_kelas_program)}}" class="btn bg-purple btn-sm" >Detail</a>
                        @else
                          @if($list_kelas->status==null)
                            <!-- <form method="POST" action="{{ route('bayar.dulu') }}" enctype="multipart/form-data"> -->
                            <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                              @csrf
                              <input type="hidden" name="id_kelas_program" value="{{$list_kelas->id_kelas_program}}">
                              <input type="hidden" name="id_rombongan_belajar" value="{{$list_kelas->id_rombongan_belajar}}">
                              <input type='hidden' name='id_harga' value='{{$list_kelas->id_harga}}'>
                              <button type="submit" class="btn btn-sm bg-maroon">Bayar</button>
                            </form>
                          @else
                            <a href="{{route('kelas-program.show',$list_kelas->id_kelas_program)}}" class="btn bg-purple btn-sm" >Detail</a>
                          @endif
                        @endif
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
      <!-- /.col -->

    </div>
    <!-- /.row -->

  </div>


</section>
<!-- /.content -->
@endsection

@section('js-end')

<!-- Custom Datatable -->
<script>
  $(function () {
    $('#collapseTwo').on('shown.bs.collapse', function(e){
      $('#example1').DataTable()
          .columns.adjust()
          .responsive.recalc();
    });


    var groupColumn = 1;
    var table = $('#example1').DataTable({
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
            } );
        }
    } );
 
    // Order by the grouping
    $('#example1 tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
            table.order( [ groupColumn, 'desc' ] ).draw();
        }
        else {
            table.order( [ groupColumn, 'asc' ] ).draw();
        }
    });

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
  
    
  });

</script>

@endsection