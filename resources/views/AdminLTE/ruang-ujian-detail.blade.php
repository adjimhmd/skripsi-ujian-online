@extends('AdminLTE.app')

@section('js-start')

@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">

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

    <!-- HASIL UJIAN -->
    @if(Route::currentRouteNamed('hasil.ujian'))
      <div class="row mb-2">
      
        <div class="col-md-12">

          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><b>Hasil Ujian <small><i>({{$nama_siswa->name.' - NISN: '.$nama_siswa->nisn}})</i></small></b></h3>

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

            <form method="POST" action="{{ route('ujian.siswa') }}" enctype="multipart/form-data" id="myForm">
              @csrf

              <div class="card-body">

                @php($no_objektif=1)
                @php($no_subjektif=1)
                @php($no_penjodohan=1)
                @php($no_truefalse=1)
                @php($total_soal=count($bank_soals))

                  <div id="accordion">
                    @php($jml_objektif=0)
                    @php($jml_subjektif=0)
                    @php($jml_penjodohan=0)
                    @php($jml_truefalse=0)

                    @foreach($bank_soals as $bs)
                      @if($bs->tipe_soal==='objektif') @php($jml_objektif++) @endif
                      @if($bs->tipe_soal==='subjektif') @php($jml_subjektif++) @endif
                      @if($bs->tipe_soal==='penjodohan') @php($jml_penjodohan++) @endif
                      @if($bs->tipe_soal==='true-false') @php($jml_truefalse++) @endif
                    @endforeach

                    @php($jumlah_soal=$jml_objektif+$jml_subjektif+$jml_penjodohan+$jml_truefalse)

                    @if($jml_objektif>0)
                    <div class="card card-light">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                            Soal Pilihan Ganda
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          @php($opsi=['A. ','B. ','C. ','D. ','E. '])
                          @php($kunci_jawaban='')
                          @foreach($bank_soals as $bank_soal)
                          @if($bank_soal->tipe_soal==='objektif')
                            <h6><strong>Soal No <span class="badge bg-purple">{{$no_objektif}}</span></strong></h6>

                            <div class="media_tabel">{!!$bank_soal->soal!!}</div><br>

                            <h6><b>Jawaban Siswa: </b></h6>
                            <input type="hidden" name="id_soal_objektif[]" value="{{$bank_soal->id}}">
                            <input type="hidden" id="{{'jawaban_objektif_'.$bank_soal->id}}" value="{{$no_objektif++}}">

                            <div class="form-group clearfix">
                              @php($x=0)
                              @foreach($jawabans as $jawaban)
                              @foreach($detail_ujians as $detail_ujian)
                                @if($jawaban->banksoal_id==$bank_soal->id and $detail_ujian->bank_soal_id==$bank_soal->id and $jawaban->jawaban!='0')
                                @php($jawaban->jawaban=substr($jawaban->jawaban, 3))
                                <div class="icheck-primary d-inline">
                                  <input disabled type="radio" id="{{$jawaban->id}}" name="{{'jawaban_objektif_'.$jawaban->banksoal_id}}" value="{{$jawaban->id}}" required class="class_objektif" {{($jawaban->id==$detail_ujian->jawaban)? "checked" : "" }}>
                                  <label for="{{$jawaban->id}}" style="font-weight:400;">{{$opsi[$x++]}}{!!$jawaban->jawaban!!}</label>
                                </div><br>
                                @if($jawaban->status=='1')@php($kunci_jawaban=$jawaban->jawaban)@endif
                                @php($nilai_objektif=$detail_ujian->nilai)
                                @endif
                              @endforeach
                              @endforeach
                            </div>

                            <div class="form-group row">
                              <b class="col-auto col-form-label">Nilai </b>
                              <div class="col-1 my-auto">
                                <input type="text" class="form-control form-control-sm" name="{{'nilai_objektif_'.$bank_soal->id}}" value="{{$nilai_objektif}}" id="nilai_objektif_{{$bank_soal->id}}" disabled>
                              </div>
                              <div class="col-auto my-auto">
                                <button type="button" class="btn bg-purple btn-sm lihat_pembahasan shadow-sm" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $bank_soal->pembahasan }}" data-kunci-jawaban="{{ $kunci_jawaban }}">Lihat Kunci Jawaban & Pembahasan</button>
                              </div>
                            </div>
                            <hr><br>

                          @endif
                          @endforeach
                        </div>
                      </div>
                    </div>
                    @endif

                    
                    @if($jml_subjektif>0)
                    <div class="card card-light">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo" id="dua">
                            Soal Essay
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          @foreach($bank_soals as $bank_soal)
                          @foreach($detail_ujians as $detail_ujian)
                          @if($bank_soal->tipe_soal==='subjektif' and $detail_ujian->bank_soal_id==$bank_soal->id)
                            <h6><strong>Soal No <span class="badge bg-purple">{{$no_subjektif}}</span></strong></h6>

                            <div class="media_tabel">{!!$bank_soal->soal!!}</div><br>

                            <!-- <h6><b>Kunci Jawaban: </b></h6>
                            <div class="media_tabel">{!!$bank_soal->jawaban!!}</div> -->

                            <h6><b>Jawaban Siswa: </b></h6>
                            <div class="media_tabel">{!!$detail_ujian->jawaban!!}</div><br>
                            
                            <div class="form-group row mb-0">
                              <b class="col-auto col-form-label">Nilai </b>
                              <div class="col-1 my-auto">
                                <input type="number" step="0.1" class="form-control form-control-sm" value="{{$detail_ujian->nilai}}" id="nilai_subjektif_{{$detail_ujian->id}}" maxlength="1" min="0" max="1">
                              </div>
                              <div class="col-auto my-auto">
                                <button type="button" class="btn btn-warning btn-sm update_nilai shadow-sm" data-id-detail-ujian="{{ $detail_ujian->id }}" data-jumlah-soal="{{ $jumlah_soal }}">Update Nilai</button>
                              </div>
                              <div class="col-auto my-auto">
                                <button type="button" class="btn bg-purple btn-sm lihat_pembahasan shadow-sm" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $bank_soal->pembahasan }}" data-kunci-jawaban="{{ $bank_soal->jawaban }}">Lihat Kunci Jawaban & Pembahasan</button>
                              </div><br>
                            </div>
                            <small style="color: red;"><b><i class="far fa-question-circle mr-2"></i>Note: </b>Rentang nilai adalah 0 s/d 1</small>
                            <hr><br>

                            <!-- <textarea id="{{'pilihan_siswa_'.$no_subjektif++}}" class="form-control pilihan_siswa pilihan" disabled>{!!$bank_soal->jawaban!!}</textarea> -->


                          @endif
                          @endforeach
                          @endforeach

                        </div>
                      </div>
                    </div>
                    @endif

                    
                    @if($jml_penjodohan>0)
                    <div class="card card-light">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                            Soal Penjodohan
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          @php($no_penjodohan=1)
                          @foreach($bank_soals as $bank_soal)

                            @if($bank_soal->tipe_soal==='penjodohan')
                              <h6><strong>Soal No <span class="badge bg-purple">{{$no_penjodohan++}}</span></strong></h6>

                              <div class="media_tabel">{!!$bank_soal->soal!!}</div><br>

                              <h6><b>Jawaban Siswa: </b></h6>
                              @php($id_soal=$bank_soals[$loop->index]->id)

                              @foreach($detail_ujians as $detail_ujian)
                                @if($detail_ujian->tipe_soal==='penjodohan')
                                  @php($id_jawaban=$detail_ujians[$loop->index]->jawaban)
                                  @if($id_jawaban==$id_soal)
                                    <div class="media_tabel">{!!$detail_ujian->jawaban_siswa!!}</div><br>

                                    <div class="form-group row">
                                      <b class="col-auto col-form-label">Nilai </b>
                                      <div class="col-1 my-auto">
                                        <input type="text" class="form-control form-control-sm" value="{{$detail_ujian->nilai}}" disabled>
                                      </div>
                                      <div class="col-auto my-auto">
                                        <button type="button" class="btn bg-purple btn-sm lihat_pembahasan shadow-sm" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $bank_soal->pembahasan }}" data-kunci-jawaban="{{ $bank_soal->jawaban }}">Lihat Kunci Jawaban & Pembahasan</button>
                                      </div>
                                    </div>
                                    <hr><br>
                                  @endif
                                @endif
                              @endforeach
                              
                            @endif
                          @endforeach

                        </div>
                      </div>
                    </div>
                    @endif

                    
                    @if($jml_truefalse>0)
                    <div class="card card-light">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                            Soal True-False
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          @foreach($bank_soals as $bank_soal)
                          @foreach($detail_ujians as $detail_ujian)
                          @if($bank_soal->tipe_soal==='true-false' and $detail_ujian->bank_soal_id==$bank_soal->id)
                            <h6><strong>Soal No <span class="badge bg-purple">{{$no_truefalse}}</span></strong></h6>

                            <div class="media_tabel">{!!$bank_soal->soal!!}</div><br>
                            <!-- {{$bank_soal->id}} -->

                            <h6><b>Jawaban Siswa: </b></h6>
                            <input type="hidden" name="id_soal_truefalse[]" value="{{$bank_soal->id}}">
                            <input type="hidden" id="{{'jawaban_truefalse_'.$bank_soal->id}}" value="{{$no_truefalse++}}">

                            <div class="form-group clearfix">
                              <div class="icheck-success d-inline mr-4">
                                <input disabled type="radio" id="{{'benar_'.$bank_soal->id}}" name="{{'jawaban_truefalse_'.$bank_soal->id}}" value="1" required class="class_truefalse" {{($detail_ujian->jawaban=="1")? "checked" : "" }}>
                                <label for="{{'benar_'.$bank_soal->id}}" style="font-weight:400;">Benar</label>
                              </div>
                              <div class="icheck-danger d-inline">
                                <input disabled type="radio" id="{{'salah_'.$bank_soal->id}}" name="{{'jawaban_truefalse_'.$bank_soal->id}}" value="0" required class="class_truefalse" {{($detail_ujian->jawaban=="0")? "checked" : "" }}>
                                <label for="{{'salah_'.$bank_soal->id}}" style="font-weight:400;">Salah</label>
                              </div>
                            </div>

                            @if($bank_soal->jawaban=='1')
                            @php($jawaban_truefalse='<div class="form-group clearfix">
                                <div class="icheck-success d-inline mr-4">
                                  <input checked type="radio" id="1">
                                  <label for="1" style="font-weight:400;">Benar</label>
                                </div>
                              </div>')
                            @else
                            @php($jawaban_truefalse='<div class="form-group clearfix">
                                <div class="icheck-danger d-inline mr-4">
                                  <input checked type="radio" id="0">
                                  <label for="0" style="font-weight:400;">Salah</label>
                                </div>
                              </div>')
                            @endif
                            <div class="form-group row">
                              <b class="col-auto col-form-label">Nilai </b>
                              <div class="col-1 my-auto">
                                <input type="text" class="form-control form-control-sm" value="{{$detail_ujian->nilai}}" disabled>
                              </div>
                              <div class="col-auto my-auto">
                                <button type="button" class="btn bg-purple btn-sm lihat_pembahasan shadow-sm" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $bank_soal->pembahasan }}" data-kunci-jawaban="{{ $jawaban_truefalse }}">Lihat Kunci Jawaban & Pembahasan</button>
                              </div>
                            </div>
                            
                            <hr><br>

                          @endif
                          @endforeach
                          @endforeach
                        </div>
                      </div>
                    </div>
                    @endif

                  </div>
                
                  <!-- <button onclick="myFunction()" id="submit" type="submit" class="btn bg-purple btn-block shadow-sm">Simpan Data</button> -->

              </div>
              <!-- /.card-body -->

              <!-- /.modal lihat pembahasan-->
              <div class="modal fade" id="lihat-pembahasan">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Jawaban & Pembahasan</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body p-4">
                      <div class="col-12">
                        <h6><b>Kunci Jawaban: </b></h6>
                        <div id="kunci_jawaban" class="media_tabel"></div><br>

                        <h6><b>Pembahasan: </b></h6>
                        <div id="text_pembahasan" class="media_tabel"></div>
                      </div>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

            </form>

          </div>
          <!-- /.card -->
          
        </div>


      </div>
      <!-- /.row -->

    <!-- MENEGRJAKAN UJIAN -->
    @else

      <div class="row mt-3 mb-2" id="row_info" hidden>

        <!-- About Ruang Ujian -->
        <div class="col-12">

          <div class="card card-outline card-purple">
          
          <div class="card-header">
            <h1 class="card-title"><strong>{{$master_ruang_ujian->deskripsi}}</strong><i>{{' (TA '.$master_ruang_ujian->tahun_awal.'/'.$master_ruang_ujian->tahun_akhir.' - Semester '.ucwords($master_ruang_ujian->semester).')'}}</i></h1>
          </div>
          <!-- /.card-header -->
          
            <div class="card-body py-auto">
                
              @if($master_ruang_ujian->tipe=='lembaga_kursus') @php($text='Program Kursus')
              @elseif($master_ruang_ujian->tipe=='sekolah') @php($text='Nama Kelas')
              @endif
              <div class="row">
                
                <div class="col-4">
                  <h6>
                    <b>{{$text}}</b><br style="display: block; content: ''; margin-top: 0.2rem;">{{$master_ruang_ujian->kelas_program}}
                    @if (Auth::user()->hasRole('adm_instansi') or Auth::user()->hasRole('guru'))
                      <a href="{{route('kelas-program.show',$master_ruang_ujian->kelas_program_id)}}" class="ml-1 btn btn-xs bg-secondary shadow-sm" >Lihat {{$text ?? "siswa"}}</a>
                    @endif
                  </h6>
                  <h6>
                    <b>Paket Soal</b><br style="display: block; content: ''; margin-top: 0.2rem;">{{$master_ruang_ujian->master_paket_soal}}
                    @if (Auth::user()->hasRole('adm_instansi') || Auth::user()->hasRole('guru'))
                      <a href="{{route('paket_soal.show',$master_ruang_ujian->master_paket_soal_id)}}" class="ml-1 btn btn-xs bg-secondary shadow-sm" >Lihat soal</a>
                    @endif
                  </h6>
                </div>

                <div class="col-4">
                  <h6><b>Master Kelas</b><br style="display: block; content: ''; margin-top: 0.2rem;">{{$master_ruang_ujian->kelas.' '.$master_ruang_ujian->tingkat.'/sederajat'}}</h6>
                  <h6><b>Hari, Tanggal</b><br style="display: block; content: ''; margin-top: 0.2rem;">{{Carbon\Carbon::parse($master_ruang_ujian->waktu_mulai)->isoFormat('dddd, D MMMM Y').''}}</h6>
                </div>

                <div class="col-4">
                  <h6>
                    <b>Mata Pelajaran</b><br style="display: block; content: ''; margin-top: 0.2rem;">
                    @if($mapel_kelas_programs->materi)
                    {{ucwords($mapel_kelas_programs->nama).' - '.ucwords($mapel_kelas_programs->materi)}}
                    @else
                    {{ucwords($mapel_kelas_programs->nama)}}
                    @endif
                  </h6>
                  <h6>
                    <b>Waktu</b><br style="display: block; content: ''; margin-top: 0.2rem;">
                    {{Carbon\Carbon::parse($master_ruang_ujian->waktu_mulai)->isoFormat('hh:mm').' - '}}
                    {{Carbon\Carbon::parse($master_ruang_ujian->waktu_selesai)->isoFormat('hh:mm').' WITA'}}
                    {{'('.$master_ruang_ujian->durasi.' menit)'}}
                  </h6>
                </div>

                <div class="col-12 mt-5 mb-4 text-center">
                  @if(\Carbon\Carbon::now()->lt($master_ruang_ujian->waktu_mulai))
                    <h1>UJIAN BELUM DIMULAI</h1>

                  @elseif(\Carbon\Carbon::now()->gte($master_ruang_ujian->waktu_mulai) && \Carbon\Carbon::now()->lte($master_ruang_ujian->waktu_selesai))
                    <h3 class="berlangsung">UJIAN SEDANG BERLANGSUNG</h3>
                    <input type="hidden" data-countdown="{{$master_ruang_ujian->waktu_selesai}}">
                    <h1 id="demo"></h1>

                    @if (Auth::user()->hasRole('siswa'))
                    <div class="berlangsung">
                    <h6 style="color: red;"><b><i class="far fa-info-circle mr-2"></i>Note: </b>
                      @if($ujian_ke) {{'Kamu sudah mengerjakan '.$ujian_ke.' dari '.$master_ruang_ujian->batas.' kesempatan ujian'}}
                      @else {{'Kamu belum mengerjakan ujian dari '.$master_ruang_ujian->batas.' kesempatan ujian'}}
                      @endif</h6>
                      
                      @if($detail_ujians->count()==0 or $master_ruang_ujian->batas>$ujian_ke)
                        <button type="button" class="btn bg-purple mt-4 kerjakan">Kerjakan Sekarang</button>
                      @else
                        <button type="button" class="btn bg-purple mt-4 kerjakan" disabled>Kamu Sudah Mengerjakan</button>
                      @endif

                      
                      @if($rating_ruang_ujian->isEmpty())
                        <button type="button" class="btn btn-warning mt-4" data-toggle="modal" data-target="#modal-default"><i class="fa fa-star"></i> Penilaian</button>
                      @endif

                    </div>
                    @endif

                  @elseif(\Carbon\Carbon::now()->gt($master_ruang_ujian->waktu_selesai))
                    <h1>UJIAN TELAH BERAKHIR</h1>
                  @endif
                </div>
              </div>
                    
              
            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->

        </div>
        
      </div>
      <!-- /.row -->

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">

            <form method="POST" action="{{ route('rating') }}" enctype="multipart/form-data" autocomplete="off">
              @csrf
              <input type="hidden" name="id_master_ruang_ujian" value="{{$master_ruang_ujian->id_master_ruang_ujian}}">
              <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="hidden" id="{{'lembaga_'.$master_ruang_ujian->id_instansi_pendidikan}}" name="lembaga" value="">
                <h6><center>Berikan Ulasan Untuk</center></h6>
                <h3><center>{{$master_ruang_ujian->instansi_pendidikan}}</center></h3>
                <div class="row">
                  <div class="col-12 d-flex justify-content-center mb-2">
                    <button type="button" class="btn bg-transparent rating-lembaga" id="{{'btn_'.$master_ruang_ujian->id_instansi_pendidikan.'_1'}}"><img id="{{'img_'.$master_ruang_ujian->id_instansi_pendidikan.'_1'}}" src="{{asset('/img/star-unselect.png')}}" style='width:25px'></button>

                    <button type="button" class="btn bg-transparent rating-lembaga" id="{{'btn_'.$master_ruang_ujian->id_instansi_pendidikan.'_2'}}"><img id="{{'img_'.$master_ruang_ujian->id_instansi_pendidikan.'_2'}}" src="{{asset('/img/star-unselect.png')}}" style='width:25px'></button>

                    <button type="button" class="btn bg-transparent rating-lembaga" id="{{'btn_'.$master_ruang_ujian->id_instansi_pendidikan.'_3'}}"><img id="{{'img_'.$master_ruang_ujian->id_instansi_pendidikan.'_3'}}" src="{{asset('/img/star-unselect.png')}}" style='width:25px'></button>

                    <button type="button" class="btn bg-transparent rating-lembaga" id="{{'btn_'.$master_ruang_ujian->id_instansi_pendidikan.'_4'}}"><img id="{{'img_'.$master_ruang_ujian->id_instansi_pendidikan.'_4'}}" src="{{asset('/img/star-unselect.png')}}" style='width:25px'></button>

                    <button type="button" class="btn bg-transparent rating-lembaga" id="{{'btn_'.$master_ruang_ujian->id_instansi_pendidikan.'_5'}}"><img id="{{'img_'.$master_ruang_ujian->id_instansi_pendidikan.'_5'}}" src="{{asset('/img/star-unselect.png')}}" style='width:25px'></button>
                  </div>
                  <div class="col-12 d-flex justify-content-center">
                    <textarea class="form-control" rows="3" placeholder="Berikan komentarmu" style="width: 99%"></textarea>
                  </div>
                </div>

                @foreach($data_guru_banksoal as $dg)
                <br><hr>
                <input type="hidden" id="{{'guru_'.$dg->id}}" name="guru[]" value="">
                <div class="row">
                  <div class="col-12 d-flex justify-content-center">
                    @if($dg->foto==null)
                      <img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class='img-circle elevation-1' alt='User Image' style='max-width:40px'>
                    @else
                      <img src="{{'/'.$dg->foto}}" class='img-circle elevation-1' alt='User Image' style='max-width:40px'>
                    @endif
                    <h5 class="my-auto ml-2">{{$dg->name}}</h5>
                  </div>
                  <div class="col-12 d-flex justify-content-center mb-2">
                    <button type="button" class="btn bg-transparent rating-guru" id="{{'btn_'.$dg->id.'_1'}}"><img id="{{'img_'.$dg->id.'_1'}}" src="{{asset('/img/star-unselect.png')}}" style='width:25px'></button>
                    
                    <button type="button" class="btn bg-transparent rating-guru" id="{{'btn_'.$dg->id.'_2'}}"><img id="{{'img_'.$dg->id.'_2'}}" src="{{asset('/img/star-unselect.png')}}" style='width:25px'></button>
                    
                    <button type="button" class="btn bg-transparent rating-guru" id="{{'btn_'.$dg->id.'_3'}}"><img id="{{'img_'.$dg->id.'_3'}}" src="{{asset('/img/star-unselect.png')}}" style='width:25px'></button>
                    
                    <button type="button" class="btn bg-transparent rating-guru" id="{{'btn_'.$dg->id.'_4'}}"><img id="{{'img_'.$dg->id.'_4'}}" src="{{asset('/img/star-unselect.png')}}" style='width:25px'></button>
                    
                    <button type="button" class="btn bg-transparent rating-guru" id="{{'btn_'.$dg->id.'_5'}}"><img id="{{'img_'.$dg->id.'_5'}}" src="{{asset('/img/star-unselect.png')}}" style='width:25px'></button>
                    
                    <br><br>
                  </div>
                  <div class="col-12 d-flex justify-content-center">
                    <textarea class="form-control" rows="3" placeholder="Berikan komentarmu" style="width: 99%"></textarea>
                  </div>
                </div>
                @endforeach

              </div>
              <div class="modal-footer justify-content-between">
                <button id="submit" type="submit" class="btn bg-purple btn-block">Simpan Data</button>
              </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      
      @if (Auth::user()->hasRole('siswa'))
      <div class="row mb-2" id="row_soal" hidden>
      
        <div class="col-md-12">

          <div class="card">
            <div class="card-header">
              <h6 class="mb-0">
                <button type="button" class="btn p-0 mr-3 balik"><i class="fas fa-arrow-left"></i></button>
                <input type="hidden" data-countdown="{{$master_ruang_ujian->waktu_selesai}}">
                <div id="demo2" class="float-right"></div>
              </h6>
            </div>
            <form method="POST" action="{{ route('ujian.siswa') }}" enctype="multipart/form-data" id="myForm">
              @csrf

              <div class="card-body">
                @php($no_objektif=1)
                @php($no_subjektif=1)
                @php($no_penjodohan=1)
                @php($no_truefalse=1)
                @php($total_soal=count($bank_soals))

                  <div id="accordion">
                    @php($jml_objektif=0)
                    @php($jml_subjektif=0)
                    @php($jml_penjodohan=0)
                    @php($jml_truefalse=0)

                    @foreach($bank_soals as $bs)
                      @if($bs->tipe_soal==='objektif') @php($jml_objektif++) @endif
                      @if($bs->tipe_soal==='subjektif') @php($jml_subjektif++) @endif
                      @if($bs->tipe_soal==='penjodohan') @php($jml_penjodohan++) @endif
                      @if($bs->tipe_soal==='true-false') @php($jml_truefalse++) @endif
                    @endforeach

                    @php($jumlah_soal=$jml_objektif+$jml_subjektif+$jml_penjodohan+$jml_truefalse)
                    <input type="hidden" name="id_master_ruang_ujian" value="{{$master_ruang_ujian->id_master_ruang_ujian}}">
                    <input type="hidden" name="jumlah_soal" value="{{$jumlah_soal}}">
                    
                    @if($jml_objektif>0)
                    <div class="card card-light">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                            Soal Pilihan Ganda
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          @php($opsi=['A. ','B. ','C. ','D. ','E. '])
                          @foreach($bank_soals as $bank_soal)
                          @if($bank_soal->tipe_soal==='objektif')
                            <h6><strong>Soal No <span class="badge bg-purple">{{$no_objektif}}</span></strong></h6>

                            <div class="media_tabel">{!!$bank_soal->soal!!}</div><br>

                            <h6><b>Opsi Jawaban: </b></h6>
                            <input type="hidden" name="id_soal_objektif[]" value="{{$bank_soal->id}}">
                            <input type="hidden" id="{{'jawaban_objektif_'.$bank_soal->id}}" value="{{$no_objektif++}}">

                            <div class="form-group clearfix">
                              @php($x=0)
                              @foreach($jawabans as $jawaban)
                              @if($jawaban->banksoal_id==$bank_soal->id and $jawaban->jawaban!='0')
                              @php($jawaban->jawaban=substr($jawaban->jawaban, 3))
                              <div class="icheck-primary d-inline">
                                <input type="radio" id="{{$jawaban->id}}" name="{{'jawaban_objektif_'.$jawaban->banksoal_id}}" value="{{$jawaban->id}}" required class="class_objektif">
                                <label for="{{$jawaban->id}}" style="font-weight:400;">{{$opsi[$x++]}}{!!$jawaban->jawaban!!}</label>
                              </div><br>
                              @endif
                              @endforeach
                            </div>
                            <hr>
                          @endif
                          @endforeach
                        </div>
                      </div>
                    </div>
                    @endif

                    
                    @if($jml_subjektif>0)
                    <div class="card card-light">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                            Soal Essay
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          @foreach($bank_soals as $bank_soal)
                          @if($bank_soal->tipe_soal==='subjektif')
                            <h6><strong>Soal No <span class="badge bg-purple">{{$no_subjektif}}</span></strong></h6>

                            <div class="media_tabel">{!!$bank_soal->soal!!}</div><br>

                            <h6><b>Jawaban: </b></h6>
                            <input type="hidden" name="id_soal_subjektif[]" value="{{$bank_soal->id}}">
                            <input type="hidden" id="{{'subjektif_'.$bank_soal->id}}" value="{{$no_subjektif++}}">

                            <textarea id="jawaban_subjektif_{{$bank_soal->id}}" class="form-control @error('jawaban_subjektif_{{$bank_soal->id}}') is-invalid @enderror pilihan class_subjektif" name="{{'jawaban_subjektif_'.$bank_soal->id}}" placeholder="Masukkan jawaban kamu disini..." required>{{ old('jawaban_subjektif.'.$bank_soal->id) }}</textarea>


                          @endif
                          @endforeach
                        </div>
                      </div>
                    </div>
                    @endif

                    
                    @if($jml_penjodohan>0)
                    <div class="card card-light">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                            Soal Penjodohan
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">

                            <table id="example" class="table table-bordered table-valign-middle">
                              <thead>
                                <tr>
                                  <th style="width: 60%;">Pertanyaan</th>
                                  <th style="width: 40%;">Opsi Jawaban</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php($no_penjodohan=1)
                                @php($no_abjad="A")
                                @php($count_a=$jml_penjodohan)
                                @php($count_a-=1)
                                @php($numbers=range(0,$count_a))
                                @php(shuffle($numbers))
                                @php($array=array_slice($numbers,0,$jml_penjodohan))
                                @php($i=0)

                                <tr>
                                  <td class="media_tabel">
                                    @foreach($bank_soals as $banksoal)
                                    @if($banksoal->tipe_soal==='penjodohan')
                                    <input type="hidden" name="id_soal_penjodohan[]" value="{{$banksoal->id}}">
                                    <input type="hidden" id="{{'penjodohan_'.$banksoal->id}}" value="{{$no_penjodohan}}">

                                      <div class="row">
                                        <div class="col-auto">{{$no_penjodohan.') '}}</div>
                                        <div class="col">
                                          {{$banksoal->id}}
                                          {!!$banksoal->soal!!}
                                        </div>
                                      </div>
                                      
                                      <div class="form-group row mt-2 mb-4">
                                        <div class="col-auto"style="opacity: 0;">{{$no_penjodohan++.'. '}}</div>
                                        <p class="col-auto col-form-label">Jawaban </p>
                                        <div class="col-auto my-auto">
                                          <input onkeypress="return /[a-z]/i.test(event.key)" type="text" class="form-control form-control-sm class_penjodohan" name="{{'jawaban_penjodohan_'.$banksoal->id}}" placeholder="(Input: a/b/c/dst)" id="jawaban_penjodohan_{{$banksoal->id}}" required maxlength="1">
                                        </div>
                                      </div>
                                    @endif
                                    @endforeach
                                  </td>
                                  
                                  <td class="media_tabel">
                                    @foreach($bank_soal_penjodohans as $banksoal)
                                      <div class="row mb-2 ">
                                        <input type="hidden" id="{{'opsi_'.$no_abjad}}" class="class_jawaban_penjodohan" value="{{$bank_soal_penjodohans[$array[$i]]->id}}">
                                        <div class="col-auto">{{$no_abjad++.'. '}}</div>
                                        <div class="col">
                                          {{$bank_soal_penjodohans[$array[$i]]->id}}
                                          {!!$bank_soal_penjodohans[$array[$i]]->jawaban!!}
                                        </div>
                                      </div>
                                      <!-- {{$array[$i]}} -->
                                      @php($i++)
                                    @endforeach
                                  </td>
                                  
                                </tr>
                              </tbody>
                            </table>

                        </div>
                      </div>
                    </div>
                    @endif

                    
                    @if($jml_truefalse>0)
                    <div class="card card-light">
                      <div class="card-header">
                        <h4 class="card-title w-100">
                          <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                            Soal True-False
                          </a>
                        </h4>
                      </div>
                      <div id="collapseFour" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          @foreach($bank_soals as $bank_soal)
                          @if($bank_soal->tipe_soal==='true-false')
                            <h6><strong>Soal No <span class="badge bg-purple">{{$no_truefalse}}</span></strong></h6>

                            <div class="media_tabel">{!!$bank_soal->soal!!}</div><br>
                            <!-- {{$bank_soal->id}} -->

                            <h6><b>Opsi Jawaban: </b></h6>
                            <input type="hidden" name="id_soal_truefalse[]" value="{{$bank_soal->id}}">
                            <input type="hidden" id="{{'jawaban_truefalse_'.$bank_soal->id}}" value="{{$no_truefalse++}}">

                            <div class="form-group clearfix">
                              <div class="icheck-success d-inline mr-4">
                                <input type="radio" id="{{'benar_'.$bank_soal->id}}" name="{{'jawaban_truefalse_'.$bank_soal->id}}" value="1" required class="class_truefalse">
                                <label for="{{'benar_'.$bank_soal->id}}" style="font-weight:400;">Benar</label>
                              </div>

                              <div class="icheck-danger d-inline">
                                <input type="radio" id="{{'salah_'.$bank_soal->id}}" name="{{'jawaban_truefalse_'.$bank_soal->id}}" value="0" required class="class_truefalse">
                                <label for="{{'salah_'.$bank_soal->id}}" style="font-weight:400;">Salah</label>
                              </div>
                            </div>

                            <hr>

                          @endif
                          @endforeach
                        </div>
                      </div>
                    </div>
                    @endif

                  </div>
                
                  <button onclick="myFunction()" id="submit" type="submit" class="btn bg-purple btn-block shadow-sm">Simpan Data</button>

              </div>
              <!-- /.card-body -->

            </form>

          </div>
          <!-- /.card -->
          
        </div>


      </div>
      <!-- /.row -->
      
      @elseif (Auth::user()->hasRole('guru') || Auth::user()->hasRole('adm_instansi') )
      <!-- Daftar Siswa -->
      <div class="row mb-2">
        <div class="col-md-12">
          <div class="card">

              <div class="card-header">
                <h3 class="card-title"><b>Nilai Ujian Siswa</b></h3>

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

                <table id="example2" class="table table-hover table-valign-middle">
                <thead>
                  <tr>
                    <th style="width: 10%; text-align: center;">No</th>
                    <th style="width: 60%;">Data Siswa</th>
                    <th style="width: 30%; text-align: center;">Keterangan Ujian</th>
                  </tr>
                </thead>
                <tbody>

                  @php($data_siswaaa='.')
                  @php($no_nilai=1)  
                  @foreach($rombongan_belajars as $rombongan_belajar)
                      @foreach($nilai as $n)
                        @if($rombongan_belajar->id_user==$n->user_siswa_id)
                  <tr>
                    <td style="text-align: center;">
                      @if($data_siswaaa!=$rombongan_belajar->name)
                        <b>{{$no_nilai++}}</b>
                      @else
                        <p style="color: transparent;">{{$no_nilai}}</p>
                      @endif
                    </td>
                    <td>
                    @if($data_siswaaa!=$rombongan_belajar->name)
                      @if($rombongan_belajar->foto==null)
                        <img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}"  class="img-circle mr-3" alt="User Image" style="max-width:35px"> 
                      @else
                        <img src="{{'/'.$rombongan_belajar->foto}}"  class="img-circle mr-3" alt="User Image" style="max-width:35px"> 
                      @endif
                      {{$rombongan_belajar->name}}
                      <small><b>{{' (NISN: '.$rombongan_belajar->nisn.')'}}</b></small>
                    @endif
                    @php($data_siswaaa=$rombongan_belajar->name)
                    </td>
                    <td style="text-align: center;">
                          {{'Ujian ke-'.$n->ujian_ke.' | Nilai: '.$n->total_nilai}}
                          @if(Auth::user()->hasRole('guru'))
                          <a href="{{route('hasil.ujian',$master_ruang_ujian->id_master_ruang_ujian.'-'.$rombongan_belajar->id_user.'-'.$n->id)}}" class="btn btn-xs bg-purple shadow-sm ml-2" ><i class="fas fa-eye"></i> Jawaban</a>
                          @endif
                          <br>
                    </td>
                  </tr>
                        @endif
                      @endforeach
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

      @endif

    @endif

  </div>


</section>
<!-- /.content -->
@endsection

@section('js-end')

<!-- Bootstrap Switch -->
<script src="{{asset('AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

<script type="text/javascript">

  $(document).on('click', '.update_nilai', function(){
    var id_detail_ujian = $(this).data('id-detail-ujian');
    var nilai_subjektif = $("#nilai_subjektif_"+id_detail_ujian).val();
    var jumlah_soal = $(this).data('jumlah-soal');

    if(nilai_subjektif>1){
      toastr.error('Nilai melebihi batas (range 0-1)');
      return false;
    }
    // alert(id_detail_ujian+nilai_subjektif);
    $.ajax({
        type: 'POST',
        url: "/update-nilai",
        data: {
          _token:'{{ csrf_token() }}',
          id_detail_ujian:id_detail_ujian,
          nilai_subjektif:nilai_subjektif,
          jumlah_soal:jumlah_soal
        },
        dataType:'json',
        success: function(dataResult){
          console.log(dataResult.data.nilai);
          $("#nilai_subjektif_"+id_detail_ujian).val(dataResult.data.nilai);
          toastr.success('Nilai berhasil diperbarui');
        }
    });
  });

  $('body').on('click', '.lihat_pembahasan', function (event) {
    var kunci_jawaban = $(this).data('kunci-jawaban');
    var pembahasan = $(this).data('pembahasan');

    $("#lihat-pembahasan #kunci_jawaban").html(kunci_jawaban);
    $("#lihat-pembahasan #text_pembahasan").html(pembahasan);
    $(".media_tabel img").addClass("img-responsive");
    $(".media_tabel iframe").addClass("embed-responsive-item");
    $(".media_tabel img").css("max-width", "100%");
    $(".media_tabel img").css("height", "auto");
    $(".media_tabel iframe").css("max-width", "100%");
    $(".media_tabel iframe").css("height", "auto");
    $("ol").css("padding-left", "1.2em");
    $("ol").css("text-align", "justify");
  });

  function myFunction() {
    var classNameObjektif = document.getElementsByClassName("class_objektif");
    var classNameSubjektif = document.getElementsByClassName("class_subjektif");
    var classNamePenjodohan = document.getElementsByClassName("class_penjodohan");
    var classNameTruefalse = document.getElementsByClassName("class_truefalse");
    var id_soal_objektif=[];
    var id_soal_subjektif=[];
    var id_soal_penjodohan=[];
    var id_soal_truefalse=[];

    // get PILIHAN GANDA input name
    for (let i = 0; i < classNameObjektif.length; i++) {
      id_soal_objektif.push(classNameObjektif[i].name);
    }

    // get ESSAY input id
    for (let i = 0; i < classNameSubjektif.length; i++) {
      id_soal_subjektif.push(classNameSubjektif[i].id);
    }

    // get PENJODOHAN input id
    for (let i = 0; i < classNamePenjodohan.length; i++) {
      id_soal_penjodohan.push(classNamePenjodohan[i].id);
    }

    // get TRUEFALSE input id
    for (let i = 0; i < classNameTruefalse.length; i++) {
      id_soal_truefalse.push(classNameTruefalse[i].name);
    }
    
    // remove PILIHAN GANDA duplicate of input name
    id_soal_objektif = id_soal_objektif.filter(function(element,index,self){
        return index === self.indexOf(element); 
    });
    
    // remove PILIHAN GANDA duplicate of input name
    id_soal_truefalse = id_soal_truefalse.filter(function(element,index,self){
        return index === self.indexOf(element); 
    });

    // =========================
    
    // =========== validasi PILIHAN GANDA ===========
    for (let i = 0; i < id_soal_objektif.length; i++) {
      if (!$('input[name="'+id_soal_objektif[i]+'"]').is(':checked')){
        toastr.error('Kamu belum menjawab soal pilihan ganda nomor '+$("#"+id_soal_objektif[i]).val())
        return false;
      }
    }

    // =========== validasi ESSAY ===========
    for (let i = 0; i < id_soal_subjektif.length; i++) {
      if ($('#'+id_soal_subjektif[i]).summernote('isEmpty')) {
        var no_subjektif = id_soal_subjektif[i].split("_");
        toastr.error('Kamu belum menjawab soal essay nomor '+$('#'+no_subjektif[1]+'_'+no_subjektif[2]).val())
        return false;
      }
    }

    // =========== validasi PENJODOHAN ===========
    var batas_input_penjodohan='a';
    
    for (let i = 0; i < id_soal_penjodohan.length; i++) {
      batas_input_penjodohan=String.fromCharCode(batas_input_penjodohan.charCodeAt(0) + 1);
    }

    for (let i = 0; i < id_soal_penjodohan.length; i++) {

      if ($('#'+id_soal_penjodohan[i]).val()=='') {
        var no_penjodohan = id_soal_penjodohan[i].split("_");
        toastr.error('Kamu belum menjawab soal penjodohan nomor '+$('#'+no_penjodohan[1]+'_'+no_penjodohan[2]).val())
        return false;
      }
      else if ($('#'+id_soal_penjodohan[i]).val()>=batas_input_penjodohan) {
        var no_penjodohan = id_soal_penjodohan[i].split("_");
        toastr.error('Jawaban soal penjodohan nomor '+$('#'+no_penjodohan[1]+'_'+no_penjodohan[2]).val()+' tidak ada dalam opsi jawaban')
        event.preventDefault();
        return false;
      }
      
        for (let j = 0; j < id_soal_penjodohan.length; j++) {
          if($('#'+id_soal_penjodohan[i]).val()==$('#'+id_soal_penjodohan[j]).val() && i!=j){
            var no_penjodohan = id_soal_penjodohan[i].split("_");
            var no_penjodohan2 = id_soal_penjodohan[j].split("_");

            toastr.error('Jawaban soal penjodohan nomor '+$('#'+no_penjodohan[1]+'_'+no_penjodohan[2]).val()+' sama dengan '+$('#'+no_penjodohan2[1]+'_'+no_penjodohan2[2]).val())
            event.preventDefault();
            return false;
          }
        }

    }

    // =========== validasi TRUE-FALSE ===========
    for (let i = 0; i < id_soal_truefalse.length; i++) {
      if (!$('input[name="'+id_soal_truefalse[i]+'"]').is(':checked')){
        toastr.error('Kamu belum menjawab soal true-false nomor '+$("#"+id_soal_truefalse[i]).val())
        return false;
      }
    }

    // ganti input huruf, jadi id jawaban - POSISI SEBENARNYA TERAKHIR SETELAH SEMUA VALIDASI BERHASIL
    for (let i = 0; i < id_soal_penjodohan.length; i++) {
      var id_penjodohan = id_soal_penjodohan[i].split("_");
      let str = $('#'+id_soal_penjodohan[i]).val();

      // alert($('#opsi_'+str.toUpperCase()).val())
      // value dari inputnya diganti sama value pilihan jawaban??
      $('#'+id_soal_penjodohan[i]).val($('#opsi_'+str.toUpperCase()).val());
    }
  };

  $(".btn_prev").click(function(){
    var id=$(this).val();
    var div_id="#div_soal_"+id;
    id--;
    var div_id_prev="#div_soal_"+id;

    // alert(id+' === '+i_min)
    if(id>=0){
      $(div_id).prop("hidden",true);
      $(div_id_prev).prop("hidden",false);
    }
    else{
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Kamu ada di soal pertama',
      })
    }
  });

  $(".btn_next").click(function(){

    var id=$(this).val();

    if ($(".jawaban_objektif_"+id).is(':checked')) {
    // if ($("input[name='jawaban_objektif_"+id+"']").is(':checked')) {
      var div_id="#div_soal_"+id;
      id++;
      var div_id_next="#div_soal_"+id;
      var i_max=$('#i_max').val();

      if(id==i_max){
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Kamu sudah di soal terakhir',
        })
      }
      else{
        $(div_id).prop("hidden",true);
        $(div_id_next).prop("hidden",false);
      }
    }
    else{
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Kamu belum memilih jawaban',
      })
    }
  });

  $(".btn_next_subjektif").click(function(){

    var id=$(this).val();

    // whitespace tetep lolos karena <p>&nbsp; &nbsp;&nbsp;</p>
    if($("#jawaban_subjektif_"+id).val().trim().length===0){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Kamu belum memilih jawaban',
      })
    }
    else{
      var div_id="#div_soal_"+id;
      id++;
      var div_id_next="#div_soal_"+id;
      var i_max=$('#i_max').val();

      if(id==i_max){
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Kamu sudah di soal terakhir',
        })
      }
      else{
        $(div_id).prop("hidden",true);
        $(div_id_next).prop("hidden",false);
      }
    }
  });

  $(".balik").click(function(){
    $("#row_info").prop("hidden",false);
    $("#row_soal").prop("hidden",true);
  });

  $(".kerjakan").click(function(){
    $("#row_info").prop("hidden",true);
    $("#row_soal").prop("hidden",false);
  });


  $('[data-countdown]').each(function() {
    // Mengatur waktu akhir perhitungan mundur
    var finalDate = new Date($(this).data('countdown')).getTime();
    console.log('finalDate:', finalDate);
    var countDownDate = new Date("2021-12-5, 15:37:25").getTime();
    console.log('countDownDate:', countDownDate);

    // Memperbarui hitungan mundur setiap 1 detik
    var x = setInterval(function() {

      // Untuk mendapatkan tanggal dan waktu hari ini
      var now = new Date().getTime();
        
      // Temukan jarak antara sekarang dan tanggal hitung mundur
      var distance = finalDate - now;
        
      // Perhitungan waktu untuk hari, jam, menit dan detik
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Keluarkan hasil dalam elemen dengan id = "demo"
      document.getElementById("demo").innerHTML = days + " Hari " + hours + " Jam " + minutes + " Menit " + seconds + " Detik ";
      document.getElementById("demo2").innerHTML = days + " Hari " + hours + " Jam " + minutes + " Menit " + seconds + " Detik ";
        
      // Jika hitungan mundur selesai, tulis beberapa teks 
      if (distance < 0) {
        clearInterval(x);
        $(".berlangsung").empty();
        document.getElementById("demo").innerHTML = "UJIAN TELAH BERAKHIR";
        document.getElementById("demo2").innerHTML = "Waktu Habis!";
      }
    }, 1000);

  });

  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  })

  // Initialize Select2 Elements
  $(document).ready(function() {
    $('.rating-lembaga').click(function () {
      var id_btn  = $(this).attr('id').split("_");
      var id_img  = '#img_'+id_btn[1]+'_'+id_btn[2];
      var src     = $(id_img).attr('src').match(/img\/.*$/i)[0];

      if(id_btn[2]=='1'){
        $("#lembaga_"+id_btn[1]).val(id_btn[1]+'-1');
        $('#img_'+id_btn[1]+'_1').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_2').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_3').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_4').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_5').prop("src", "{{asset('img/star-unselect.png')}}");
      }
      else if(id_btn[2]=='2'){
        $("#lembaga_"+id_btn[1]).val(id_btn[1]+'-2');
        $('#img_'+id_btn[1]+'_1').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_2').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_3').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_4').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_5').prop("src", "{{asset('img/star-unselect.png')}}");
      }
      else if(id_btn[2]=='3'){
        $("#lembaga_"+id_btn[1]).val(id_btn[1]+'-3');
        $('#img_'+id_btn[1]+'_1').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_2').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_3').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_4').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_5').prop("src", "{{asset('img/star-unselect.png')}}");
      }
      else if(id_btn[2]=='4'){
        $("#lembaga_"+id_btn[1]).val(id_btn[1]+'-4');
        $('#img_'+id_btn[1]+'_1').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_2').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_3').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_4').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_5').prop("src", "{{asset('img/star-unselect.png')}}");
      }
      else if(id_btn[2]=='5'){
        $("#lembaga_"+id_btn[1]).val(id_btn[1]+'-5');
        $('#img_'+id_btn[1]+'_1').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_2').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_3').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_4').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_5').prop("src", "{{asset('img/star-select.png')}}");
      }
      else{
        $("#lembaga_"+id_btn[1]).val(id_btn[1]+'-0');
      }
    });

    $('.rating-guru').click(function () {
      var id_btn  = $(this).attr('id').split("_");
      var id_img  = '#img_'+id_btn[1]+'_'+id_btn[2];
      var src     = $(id_img).attr('src').match(/img\/.*$/i)[0];
      
      if(id_btn[2]=='1'){
        $("#guru_"+id_btn[1]).val(id_btn[1]+'-1');
        $('#img_'+id_btn[1]+'_1').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_2').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_3').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_4').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_5').prop("src", "{{asset('img/star-unselect.png')}}");
      }
      else if(id_btn[2]=='2'){
        $("#guru_"+id_btn[1]).val(id_btn[1]+'-2');
        $('#img_'+id_btn[1]+'_1').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_2').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_3').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_4').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_5').prop("src", "{{asset('img/star-unselect.png')}}");
      }
      else if(id_btn[2]=='3'){
        $("#guru_"+id_btn[1]).val(id_btn[1]+'-3');
        $('#img_'+id_btn[1]+'_1').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_2').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_3').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_4').prop("src", "{{asset('img/star-unselect.png')}}");
        $('#img_'+id_btn[1]+'_5').prop("src", "{{asset('img/star-unselect.png')}}");
      }
      else if(id_btn[2]=='4'){
        $("#guru_"+id_btn[1]).val(id_btn[1]+'-4');
        $('#img_'+id_btn[1]+'_1').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_2').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_3').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_4').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_5').prop("src", "{{asset('img/star-unselect.png')}}");
      }
      else if(id_btn[2]=='5'){
        $("#guru_"+id_btn[1]).val(id_btn[1]+'-5');
        $('#img_'+id_btn[1]+'_1').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_2').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_3').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_4').prop("src", "{{asset('img/star-select.png')}}");
        $('#img_'+id_btn[1]+'_5').prop("src", "{{asset('img/star-select.png')}}");
      }
      else{
        $("#guru_"+id_btn[1]).val(id_btn[1]+'-0');
      }
    });
    // $('#rating1').click(function () {
    //   var img = $('#img1').attr('src').match(/img\/.*$/i)[0];
      
    //   if(img=='img/star-unselect.png'){
    //     $("#img1").prop("src", "{{asset('img/star-select.png')}}");
    //   }
    //   else{
    //     $("#img2").prop("src", "{{asset('img/star-unselect.png')}}");
    //     $("#img3").prop("src", "{{asset('img/star-unselect.png')}}");
    //   }
    // });

    // $('#rating2').click(function () {
    //   var img = $('#img2').attr('src').match(/img\/.*$/i)[0];
      
    //   if(img=='img/star-unselect.png'){
    //     $("#img1").prop("src", "{{asset('img/star-select.png')}}");
    //     $("#img2").prop("src", "{{asset('img/star-select.png')}}");
    //   }
    //   else{
    //     $("#img3").prop("src", "{{asset('img/star-unselect.png')}}");
    //   }
    // });
    // $('#rating3').click(function () {
    //   var img = $('#img3').attr('src').match(/img\/.*$/i)[0];
      
    //   if(img=='img/star-unselect.png'){
    //     $("#img1").prop("src", "{{asset('img/star-select.png')}}");
    //     $("#img2").prop("src", "{{asset('img/star-select.png')}}");
    //     $("#img3").prop("src", "{{asset('img/star-select.png')}}");
    //   }
    //   else{
    //     $("#img1").prop("src", "{{asset('img/star-unselect.png')}}");
    //     $("#img2").prop("src", "{{asset('img/star-unselect.png')}}");
    //     $("#img3").prop("src", "{{asset('img/star-unselect.png')}}");
    //   }
    // });

    // $("#div_soal_objektif_0").prop("hidden",false);
    $("#div_soal_0").prop("hidden",false);
    
    $("#row_info").prop("hidden",false);
    $("#row_list_siswa").prop("hidden",false);
    
    $(".media_tabel img").addClass("img-responsive");
    $(".media_tabel iframe").addClass("embed-responsive-item");
    $(".media_tabel img").css("max-height", "150px");
    $(".media_tabel img").css("width", "auto");
    $(".media_tabel iframe").css("max-height", "150px");
    $(".media_tabel iframe").css("width", "auto");
    $(".media_tabel p").css("margin-bottom", "0");
    $("ol").css("padding-left", "1.2em");
    $("ol").css("text-align", "justify");

    $('input[name="hapus_soal[]"]').change(function(){
      if ($('input[name="hapus_soal[]"]:checked').length == $('input[name="hapus_soal[]"]').length) {
        $('.btn_hapus').prop('disabled', true);
      }
      else{
        $('.btn_hapus').prop('disabled', false);
      }
    });

    $('input[id="cb_objektif"]').click(function(){
        if($(this).prop("checked") == true){
          $("#list_objektif").prop('hidden', false);
        }
        else if($(this).prop("checked") == false){
          $("#list_objektif").prop('hidden', true);
          $('input[name="pilih_objektif[]"]').prop('checked', false);
        }
    });

    $('input[id="cb_subjektif"]').click(function(){
        if($(this).prop("checked") == true){
          $("#list_subjektif").prop('hidden', false);
        }
        else if($(this).prop("checked") == false){
          $("#list_subjektif").prop('hidden', true);
          $('input[name="pilih_subjektif[]"]').prop('checked', false);
        }
    });

    $('input[id="cb_penjodohan"]').click(function(){
        if($(this).prop("checked") == true){
          $("#list_penjodohan").prop('hidden', false);
        }
        else if($(this).prop("checked") == false){
          $("#list_penjodohan").prop('hidden', true);
          $('input[name="pilih_penjodohan[]"]').prop('checked', false);
        }
    });

    $('input[id="cb_truefalse"]').click(function(){
        if($(this).prop("checked") == true){
          $("#list_truefalse").prop('hidden', false);
        }
        else if($(this).prop("checked") == false){
          $("#list_truefalse").prop('hidden', true);
          $('input[name="pilih_truefalse[]"]').prop('checked', false);
        }
    });

    $('.simpan_soal').click(function() {
      if($('#cb_objektif').is(":checked")||$('#cb_subjektif').is(":checked")||$('#cb_penjodohan').is(":checked")||$('#cb_truefalse').is(":checked")) {
        if($('#cb_objektif').is(":checked") && $('input[name="pilih_objektif[]"]:checked').length==0){
          toastr.error('Kamu belum memilih soal pilihan ganda!')
          return false;
        }
        else if($('#cb_subjektif').is(":checked") && $('input[name="pilih_subjektif[]"]:checked').length==0){
          toastr.error('Kamu belum memilih soal essay!')
          return false;
        }
        else if($('#cb_penjodohan').is(":checked") && $('input[name="pilih_penjodohan[]"]:checked').length==0){
          toastr.error('Kamu belum memilih soal penjodohan!')
          return false;
        }
        else if($('#cb_truefalse').is(":checked") && $('input[name="pilih_truefalse[]"]:checked').length==0){
          toastr.error('Kamu belum memilih soal true-false!')
          return false;
        }
      }
      else{
        toastr.error('Pilih dulu ya tipe soal yang ingin digunakan.')
        return false;
      }
    });

    $('body').on('click', '.lihat_pembahasan', function (event) {
      var pembahasan = $(this).data('pembahasan');
      $("#lihat-pembahasan #text_pembahasan").html(pembahasan);
      $(".media_tabel img").addClass("img-responsive");
      $(".media_tabel iframe").addClass("embed-responsive-item");
      $(".media_tabel img").css("max-width", "100%");
      $(".media_tabel img").css("height", "auto");
      $(".media_tabel iframe").css("max-width", "100%");
      $(".media_tabel iframe").css("height", "auto");
      $("ol").css("padding-left", "1.2em");
      $("ol").css("text-align", "justify");
    });

    $('.select2').select2({
      theme: 'bootstrap4',
    })

    $('.pilihan').summernote({
        callbacks: {
            onPaste: function (e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                e.preventDefault();

                // Firefox fix
                setTimeout(function () {
                    document.execCommand('insertText', false, bufferText);
                }, 10);
            }
        },
        height: 100,
        maximumImageFileSize: 1048576,
        inheritPlaceholder: true,
        toolbar: [
          ['insert', ['link', 'picture', 'video']],
          ['style', ['bold', 'italic', 'underline']],
          ['font', ['superscript', 'subscript']],
          ['para', ['ul', 'ol']],
        ]
    });
    
    for(var i=1; i<=$('.pilihan_siswa').length; i++){
      $('#pilihan_siswa_'+i).summernote('disable');
    }

    $("#example").DataTable({
      "paging": false,
      "responsive": true, 
      "autoWidth": false,
      "pageLength": 10000,
      "scrollCollapse": true,
      "searching": false,
      "lengthChange": false,
    }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');

    $("#example2").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "pageLength": 10,
      "scrollCollapse": true,
      "order": [[ 0, "asc" ]],
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');

  });



</script>

@endsection