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
          
          <div class="card-header border-0">
            <!-- <h3 class="card-title"><b>{{'Data Nilai Siswa'}}</b></h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="maximize">
                <i class="fas fa-expand"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div> -->
            <!-- /.card-tools -->
          
          </div>
          <!-- /.card-header -->
          
          <div class="card-body">

            @foreach($nama_instansis as $nama_instansi)
              @if($nama_instansi->tipe=='sekolah')
                @php($tipe='Kelas')
                @php($no_induk='NPSN')
              @elseif($nama_instansi->tipe=='lembaga_kursus')
                @php($tipe='Program Kursus')
                @php($no_induk='NUPTK')
              @endif
            @endforeach

            @foreach($nama_instansis as $lembaga_pendidikan)
            <center>
              <h4><b>{{$lembaga_pendidikan->nama}}</b></h4>
              <h5><b>{{$no_induk.': '.$lembaga_pendidikan->nomor_induk}}</b></h5>
              <h6>{{'Alamat: '.ucwords($lembaga_pendidikan->alamat)}}</h6><br>
            </center>
            @endforeach

            
  <hr>
  @foreach($data_siswas as $data_siswa)
    @if($loop->first)
      <p style="line-height:10px;"><b>Nama: </b>{{$data_siswa->name}}</p>
      <p style="line-height:10px;"><b>NISN: </b>{{$data_siswa->nisn}}</p>
      <p style="line-height:10px;"><b>Wali Siswa: </b>{{$data_siswa->nama_wali}}</p>
      <!-- <div style="clear: both;">
        <p style="float:left;"><b>Wali Siswa: </b>{{$data_siswa->nama_wali}}</p>
        <img style="float:right; margin-top:-50px" src="{{$data_siswa->foto}}">
      </div> -->
    @endif
  @endforeach<br>

            <table id="example" class="table table-bordered table-hover mb-4" style="table-layout: fixed">
              <thead>
                <tr>
                  <th style="width: 5%; text-align: center;">No</th>
                  <th style="width: 20%;">{{$tipe}}</th>
                  <th style="width: 30%;">Detail Ujian</th>
                  <th style="width: 10%; text-align: center;">Nilai</th>
                  <th style="width: 35%;">Komentar</th>
                </tr>
              </thead>
              <tbody>
                @php ($no=1)
                @php ($nama_kelas_program='.')
                @php ($id_master_ruang_ujian='.')
                @php ($total_nilai='.')
                @foreach($data_siswas as $data_siswa)
                  <!-- {{$id_master_ruang_ujian.'!='.$data_siswa->id_master_ruang_ujian.' and '.$total_nilai.'!='.$data_siswa->total_nilaii}}<br> -->
                  @if($id_master_ruang_ujian!=$data_siswa->id_master_ruang_ujian)
                  <tr>
                    <td style="text-align: center;">
                      @if($nama_kelas_program!=$data_siswa->nama_kelas_program)
                        {{$no++}}
                      @endif
                    </td>
                    <td>
                      @if($nama_kelas_program!=$data_siswa->nama_kelas_program)
                        {{$data_siswa->nama_kelas_program}}</b>
                      @endif
                      @php($nama_kelas_program=$data_siswa->nama_kelas_program)
                    </td>
                    <td>
                      {{$data_siswa->deskripsi}}
                    </td>
                    <td style="text-align: center;">
                      {{$data_siswa->total_nilaii}}
                    </td>
                    <td>
                      @foreach($komentar_ujian as $ku)
                        @if($data_siswa->id_master_ruang_ujian==$ku->master_ruang_ujian_id)
                        <div class="row">
                          <div class="col-1 mr-3"> 
                            @if($ku->foto==null)
                              <img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class="img-circle" alt="User Image" style="max-width:40px"> 
                            @else
                              <img src="{{'/'.$ku->foto}}" class="img-circle" alt="User Image" style="max-width:40px"> 
                            @endif
                          </div> 
                          <div class="col-10"> 
                            <p style="line-height:15px;margin-bottom:2px;"><b>{{$ku->name}}</b><br></p>
                            {{$ku->komentar}}
                          </div> 
                        </div>
                        <br>
                        @endif
                      @endforeach
                    </td>
                  </tr>
                  @endif
                  @php($id_master_ruang_ujian=$data_siswa->id_master_ruang_ujian)
                  @php($total_nilai=$data_siswa->total_nilaii)
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