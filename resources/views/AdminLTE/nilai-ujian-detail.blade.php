@extends('AdminLTE.app')

@section('js-start')

@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">

    <!-- Row Form Input Program Mapel -->
    <div class="row mt-3 mb-2">
      
      <div class="col-12 col-md-12">
        <div class="card card-outline card-purple">
          
          <div class="card-header">
            <h3 class="card-title"><b>{{'Data Nilai Siswa'}}</b></h3>

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

@foreach($nama_instansis as $lembaga_pendidikan)
  <h4>{{$lembaga_pendidikan->nama}}</h4>
  <h5>{{$lembaga_pendidikan->nomor_induk}}</h5>
  <h6>{{$lembaga_pendidikan->alamat}}</h6>
@endforeach

            @foreach($nama_instansis as $nama_instansi)
              @if($nama_instansi->tipe=='sekolah')
                @php($tipe='Kelas')
              @elseif($nama_instansi->tipe=='lembaga_kursus')
                @php($tipe='Program Kursus')
              @endif
            @endforeach

            <table id="example4" class="table table-hover" style="table-layout: fixed">
              <thead>
                <tr>
                  <th style="width: 40%;">{{$tipe}}</th>
                  <th style="width: 40%;">Detail Ujian</th>
                  <th style="width: 20%;">Nilai</th>
                </tr>
              </thead>
              <tbody>
                @php ($nama_kelas_program='.')
                @foreach($data_siswas as $data_siswa)
                  <tr>
                    <td>
                      @if($nama_kelas_program!=$data_siswa->nama_kelas_program)
                        <b>{{$data_siswa->nama_kelas_program}}</b>
                      @else
                        <b hidden>{{$data_siswa->nama_kelas_program}}</b>
                      @endif
                      @php($nama_kelas_program=$data_siswa->nama_kelas_program)
                    </td>
                    <td>
                      {{$data_siswa->deskripsi}}
                    </td>
                    <td>{{$data_siswa->total_nilai}}</td>
                  </tr>
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


</section>
<!-- /.content -->
@endsection

@section('js-end')

<script type="text/javascript">

  // datatable

  $("#example4").DataTable({
    "paging": true,
    "responsive": true, 
    "autoWidth": false,
    "pageLength": 10,
    "scrollCollapse": true
  }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');

</script>

@endsection