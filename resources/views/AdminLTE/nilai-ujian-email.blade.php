<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  
  <style>
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    h1, h2, h3, h4, h5, h6, p{
      margin-top:0px;
      margin-bottom:5px;
      text-align: center;
    }
  </style>
</head>
<body>

  @foreach($nama_instansis as $nama_instansi)
    @if($nama_instansi->tipe=='sekolah')
      @php($tipe='Kelas')
    @elseif($nama_instansi->tipe=='lembaga_kursus')
      @php($tipe='Program Kursus')
    @endif
  @endforeach

  @foreach($nama_instansis as $lembaga_pendidikan)
    <h2>{{$lembaga_pendidikan->nama}}</h2>
    <h3>{{'Nomor Induk: '.$lembaga_pendidikan->nomor_induk}}</h3>
    <h4>{{ucwords($lembaga_pendidikan->alamat)}}</h4>
  @endforeach

  <hr><br>

  @foreach($data_siswas as $data_siswa)
    @if($loop->first)
      <p style="text-align:left;"><b>Nama: </b>{{$data_siswa->name}}</p>
      <p style="text-align:left;"><b>NISN: </b>{{$data_siswa->nisn}}</p>
      <p style="text-align:left;"><b>Wali Siswa: </b>{{$data_siswa->nama_wali}}</p>
      <!-- <div style="clear: both;">
        <p style="float:left;"><b>Wali Siswa: </b>{{$data_siswa->nama_wali}}</p>
        <img style="float:right; margin-top:-50px" src="{{$data_siswa->foto}}">
      </div> -->
    @endif
  @endforeach<br><br>
  
  <table style="width:100%">
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
      @foreach($data_siswas as $data_siswa)
        <tr>
          <td><center>
            @if($nama_kelas_program!=$data_siswa->nama_kelas_program)
              <b>{{$no++}}</b>
            @endif
          </center></td>
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
          <td><center>{{$data_siswa->total_nilai}}</center></td>
                    <td>
                      @foreach($komentar_ujian as $ku)
                        @if($data_siswa->id_master_ruang_ujian==$ku->master_ruang_ujian_id)
                        
                        <p style="line-height:15px;margin-bottom:2px;text-align:justify"><b>{{$ku->name}}</b><br>{{$ku->komentar}}</p>
                        <br>
                        @endif
                      @endforeach
                    </td>
        </tr>
      @endforeach
    </tbody>
  </table>

</body>
</html>