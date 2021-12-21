@extends('AdminLTE.app')

@section('js-start')

  
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    
    <!-- Data Instansi Pendidikan -->
    <div class="row mt-2 mb-2">
      <div class="col-md-12">
        <div class="card">
          
          <div class="card-header border-0">
            <h3 class="card-title"><b>Data Instansi Pendidikan</b></h3>

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

          @if (Route::current()->getName()=='home.instansi')
          <div class="card-body">
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
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                  <div class="card-body">
                    
                    <table id="example1" class="table table-hover table-valign-middle"style="table-layout: fixed">
                      <thead>
                        <tr>
                          <th style="width: 5%; text-align: center;">No</th>
                          <th style="width: 35%;">Nama</th>
                          <th style="width: 45%;">Alamat</th>
                          <th style="width: 10%;">Tingkat</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php ($no = 1)
                        @foreach($instansis as $instansi)
                        @if($instansi->tipe=='sekolah')
                        <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td><strong>{{ $instansi->nama }}</strong><br>
                            <h6><span class="badge bg-purple">{{'NPSN: '.$instansi->nomor_induk}}</span></h6>
                          </td>
                          <td>
                            <strong>{{ ucwords($instansi->alamat) }}</strong><br>
                            {{ ucwords(strtolower($instansi->desa)).' - '.ucwords(strtolower($instansi->kecamatan)).' - '.ucwords(strtolower($instansi->kota)).' - '.ucwords(strtolower($instansi->provinsi)) }}
                          </td>
                          <td><h5><span class="badge badge-info">{{$instansi->jenjang}}</span></h5></td>
                        </tr>
                        @endif
                        @endforeach
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
                          <th style="width: 5%; text-align: center;">No</th>
                          <th style="width: 35%;">Nama</th>
                          <th style="width: 45%;">Alamat</th>
                          <th style="width: 10%;">Tingkat</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php ($no = 1)
                        @foreach($instansis as $instansi)
                        @if($instansi->tipe=='lembaga_kursus')
                        <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td><strong>{{ $instansi->nama }}</strong><br>
                            <h6><span class="badge bg-purple">{{'NILEK: '.$instansi->nomor_induk}}</span></h6>
                          </td>
                          <td>
                            <strong>{{ ucwords($instansi->alamat) }}</strong><br>
                            {{ ucwords(strtolower($instansi->desa)).' - '.ucwords(strtolower($instansi->kecamatan)).' - '.ucwords(strtolower($instansi->kota)).' - '.ucwords(strtolower($instansi->provinsi)) }}
                          </td>
                          <td><h5><span class="badge badge-info">{{$instansi->jenjang}}</span></h5></td>
                        </tr>
                        @endif
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>


            </div>
          </div>
          <!-- /.card-body -->

          @elseif (Route::current()->getName()=='home.kelas.program')
          <div class="card-body">

            <table id="example" class="table table-hover table-valign-middle" style="table-layout: fixed">
              <thead>
                  <tr>
                      <th style="width: 5%; text-align: center;">Kelas</th>
                      <th style="width: 5%; text-align: center;">No</th>
                      <th style="width: 40%;">Mata Pelajaran</th>
                      <th style="width: 40%;">Data Guru</th>
                      <th style="width: 10%; text-align: center;">Harga</th>
                  </tr>
              </thead>
              <tbody>
                @php ($no = 1)
                @foreach($kelas_programs as $kelas_program)
                  <tr>
                    @if($kelas_program->jurusan!=null) @php($tanda=' - ')
                    @else @php($tanda=' ')
                    @endif
                    <td>{{'Kelas '.$kelas_program->kelas.' '.$kelas_program->tingkat.'/Sederajat'.$tanda.ucwords($kelas_program->jurusan)}}</td>
                    <td style="text-align: center;">{{$no++}}</td>
                    <td><strong>{{ucwords($kelas_program->nama)}}</strong><br>{{ucwords($kelas_program->materi)}}</td>
                    <td>
                      <img src="{{$kelas_program->foto}}" class='img-circle mr-4' alt='User Image' style='max-width:50px'>
                      {{$kelas_program->name}}
                    </td>
                    <td style="text-align: center;">{{'Rp '.$kelas_program->harga}}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
            
          </div>
          <!-- /.card-body -->

          @elseif (Route::current()->getName()=='home.mapel')
          <div class="card-body">
            
            <table id="example3" class="table table-hover table-valign-middle"style="table-layout: fixed">
              <thead>
                <tr>
                  <th style="width: 10%; text-align: center;">No</th>
                  <th style="width: 40%;">Mata Pelajaran</th>
                  <th style="width: 50%;">Materi</th>
                </tr>
              </thead>
              <tbody>
                @php ($no = 1)
                @foreach($mapels as $mapel)
                <tr>
                  <td style="text-align: center;">{{$no++}}</td>
                  <td>{{ ucwords($mapel->nama) }}</td>
                  <td>{{ ucwords($mapel->materi) }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
          <!-- /.card-body -->
          @endif

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


<!-- pass value to modal -->
<script>

  // menampilkan tabel guru sesuai mapel
  $('.btn_pilih').on('click',function(){
    $("#pilih_guru #bodyData").empty();
    
    var id_instansi = $(this).data('id-instansi');
    var nama_instansi = $(this).data('nama-instansi');
    var tipe_instansi = $(this).data('tipe-instansi');

    // alert(id_instansi+nama_instansi+tipe_instansi);

    if(tipe_instansi=='sekolah'){
      $("#pilih_guru #judul_modal").html("<strong>List Kelas "+nama_instansi+"</strong>");
    }
    else{
      $("#pilih_guru #judul_modal").html("<strong>List Program Kursus "+nama_instansi+"</strong>");
    }
    $.ajax({
      url: "{{ route('show.kelas_program') }}",
      type:'POST',
      data: {_token:'{{ csrf_token() }}', id:id_instansi},
      cache: false,
      dataType: 'json',
      success: function(dataResult){
        var resultData = dataResult.data;
        var bodyData = '';
        var profil = '';
        // console.log(resultData);

        $.each(resultData,function(index,row){
            if(row.foto===null){
              profil="{{asset('AdminLTE/dist/img/default-150x150.png')}}";
            }else{
              profil=row.foto;
            }

            if(row.jurusan===null){
              row.jurusan='';
            }

            
            row.nama_mapel = row.nama_mapel.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            row.materi = row.materi.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });

            bodyData+="<tr>"
            bodyData+="<td>"+row.kelas+" "+row.tingkat+" "+row.jurusan+"</td>"+
            "<td><img src="+profil+" class='img-circle mr-4' alt='User Image' style='max-width:40px'>"+row.name+"</td>"+
            "<td>"+row.nama_mapel+" - "+row.materi+"</td>"+
            "<td><center><form method='POST' action='{{ route('daftar.siswa') }}' enctype='multipart/form-data'>"+
              "<input type='hidden' name='_token' id='csrf-token' value='{{ csrf_token() }}' />"+
              "<input type='hidden' name='id_kelas_program' value='"+row.id_kelas_program+"'>"+
              "<button type='submit' class='btn bg-purple btn-sm'><i class='fas fa-check-circle'></i> Pilih</button>"+
            "</form></center></td>";
            bodyData+="</tr>";
        })
        $("#pilih_guru #bodyData").append(bodyData);

      }
    });
  }); 
  
</script>

<!-- Custom Datatable -->
<script>
  $(function () {
    $('#collapseTwo').on('shown.bs.collapse', function(e){
      $('#example1').DataTable()
          .columns.adjust()
          .responsive.recalc();
    });

    
    var groupColumn = 0;
    var table = $('#example').DataTable({
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
    $('#example tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
            table.order( [ groupColumn, 'desc' ] ).draw();
        }
        else {
            table.order( [ groupColumn, 'asc' ] ).draw();
        }
    });

    $("#example1").DataTable({
      "paging": true,
      // "info": true,
      "responsive": true, 
      // "lengthChange": false, 
      "autoWidth": false,
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  
    $("#example2").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  
    $("#example3").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "pageLength": 10,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    
  });

</script>

@endsection