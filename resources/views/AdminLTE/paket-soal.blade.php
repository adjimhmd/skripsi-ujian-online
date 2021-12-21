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

    @if($kelas_program->jurusan==null or $kelas_program->jurusan=='') @php($tanda='')
    @else @php($tanda=' - '.ucwords($kelas_program->jurusan))
    @endif


    <div class="row mt-3 mb-2">

      <!-- About sekolah & Guru Box -->
      
      <div class="col-12">

        <div class="card card-outline card-purple">
        
        <div class="card-header">
          <h1 class="card-title"><strong>{{'Paket Soal '.$kelas_program->deskripsi}}</strong></h1>
        </div>
        <!-- /.card-header -->
        
        <div class="card-body py-auto">
              
            <div class="row">
              <div class="col-4">
                <h6><b>Data Guru: </b><br style="display: block; content: ''; margin-top: 0.2rem;">{{$kelas_program->name.' - '.$kelas_program->nuptk}}</h6>
              </div>
              
              <div class="col-4">
                <h6><b>Master Kelas</b><br style="display: block; content: ''; margin-top: 0.2rem;">{{$kelas_program->kelas.' '.$kelas_program->tingkat.'/sederajat'.$tanda}}</h6>
              </div>

              <div class="col-4">
                <h6><b>Mata Pelajaran</b><br style="display: block; content: ''; margin-top: 0.2rem;">
                  @if($kelas_program->materi) {{ucwords($kelas_program->nama).' - '.ucwords($kelas_program->materi)}}
                  @else {{ucwords($kelas_program->nama)}}
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
    
    <!-- Bank Soal Terpilih -->
    <div class="row mb-2">
      <div class="col-md-12">
        <div class="card">
          
          <form method="POST" action="{{ route('hapus.soal') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="master_paket_soal_id" value="{{$master_paket_soal->id}}">

            <div class="card-header">
              <h3 class="card-title"><b>Soal Terpilih</b></h3>

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
              <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
              <div id="accordion">
                
                <!-- bank soal objektif -->
                <div class="card card-light">
                  <div class="card-header">
                    <h4 class="card-title w-100">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                        <b>Pilihan Ganda</b>
                        @foreach($jumlah_soals as $jumlah_soal)
                        @if($jumlah_soal->tipe_soal=='objektif')<span class="badge bg-purple ml-1">{{$jumlah_soal->jumlah}}</span>
                        @endif
                        @endforeach
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-valign-middle" style="table-layout: fixed">
                        <thead>
                          <tr>
                            <th style="width: 5%; text-align: center;">NO</th>
                            <th style="width: 45%; text-align: center;">SOAL</th>
                            <th style="width: 50%; text-align: center;">JAWABAN</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($no = 1)
                          @php ($i = 0)
                          @foreach($soal_objektif_terpilih as $select_soal_objektif)
                          <tr>
                            <td style="text-align: center;">{{$no++}}</td>
                            <td class="media_tabel">{!! $select_soal_objektif->soal !!}<h6>
                              <span class="badge bg-secondary">{{'Kelas '. $select_soal_objektif->kelas.' '.$select_soal_objektif->tingkat.'/sederajat'}}</span>
                              <span class="badge bg-secondary">{{ucwords($select_soal_objektif->nama).' - '.ucwords($select_soal_objektif->materi)}}</span></h6><br>
                              <div class="icheck-danger d-inline">
                                <input type="checkbox" name="hapus_soal[]" value="{{$select_soal_objektif->id_paket_soal}}" id="{{$select_soal_objektif->id_paket_soal}}">
                                <label for="{{$select_soal_objektif->id_paket_soal}}">HAPUS SOAL</label><br><br>
                              </div>
                            </td>
                            <td>
                              @php ($huruf = 'A')
                              @php ($kunci = '')
                              @php ($kunci_hidden = '')
                              <ol type="A">
                              @foreach($list_jawaban_objektif as $jawaban_objektif)
                                @if($jawaban_objektif->banksoal_id == $select_soal_objektif->id_bank_soal)
                                  @if($jawaban_objektif->status == 1) 
                                    <?php $kunci=$huruf++; ?>
                                  @endif
                                  @if($jawaban_objektif->jawaban != '0')
                                    <li>{!! $jawaban_objektif->jawaban !!}</li>
                                    <?php $kunci_hidden=$huruf++; ?>
                                    <?php $bahasan_objektif=$select_soal_objektif->pembahasan; ?>
                                  @endif
                                @endif
                              @endforeach
                              </ol>
                              <b>KUNCI JAWABAN : {{$kunci}}</b><br><br>
                              <button type="button" class="btn bg-purple btn-sm lihat_pembahasan" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $bahasan_objektif }}">Lihat Pembahasan</button><br>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
                
                <!-- bank soal subjektif -->
                <div class="card card-light">
                  <div class="card-header">
                    <h4 class="card-title w-100">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                        <b>Essay</b>
                        @foreach($jumlah_soals as $jumlah_soal)
                        @if($jumlah_soal->tipe_soal=='subjektif')<span class="badge bg-purple ml-1">{{$jumlah_soal->jumlah}}</span>
                        @endif
                        @endforeach
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                      <table id="example2" class="table table-bordered table-valign-middle"style="table-layout: fixed">
                        <thead>
                          <tr>
                            <th style="width: 5%; text-align: center;">NO</th>
                            <th style="width: 45%; text-align: center;">SOAL</th>
                            <th style="width: 50%; text-align: center;">JAWABAN</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($no = 1)
                          @foreach($soal_subjektif_terpilih as $select_soal_subjektif)
                          <tr>
                            <td style="text-align: center;">{{$no++}}</td>
                            <td class="media_tabel">{!! $select_soal_subjektif->soal !!}<h6>
                              <span class="badge bg-secondary">{{'Kelas '. $select_soal_subjektif->kelas.' '.$select_soal_subjektif->tingkat.'/sederajat'}}</span>
                              <span class="badge bg-secondary">{{ucwords($select_soal_subjektif->nama).' - '.ucwords($select_soal_subjektif->materi)}}</span></h6><br>
                              <div class="icheck-danger d-inline">
                                <input type="checkbox" name="hapus_soal[]" value="{{$select_soal_subjektif->id_paket_soal}}" id="{{$select_soal_subjektif->id_paket_soal}}">
                                <label for="{{$select_soal_subjektif->id_paket_soal}}">HAPUS SOAL</label><br><br>
                              </div>
                            </td>
                            <td class="media_tabel">
                              {!! $select_soal_subjektif->jawaban !!}
                                <button type="button" class="btn shadow-sm bg-purple btn-sm mb-1 lihat_pembahasan" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $select_soal_subjektif->pembahasan }}">Lihat Pembahasan</button><br>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <!-- bank soal penjodohan -->
                <div class="card card-light">
                  <div class="card-header">
                    <h4 class="card-title w-100">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                        <b>Penjodohan</b>
                        @foreach($jumlah_soals as $jumlah_soal)
                        @if($jumlah_soal->tipe_soal=='penjodohan')<span class="badge bg-purple ml-1">{{$jumlah_soal->jumlah}}</span>
                        @endif
                        @endforeach
                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                      <table id="example3" class="table table-bordered table-valign-middle" style="table-layout: fixed">
                        <thead>
                          <tr>
                            <th style="width: 5%; text-align: center;">NO</th>
                            <th style="width: 50%; text-align: center;">SOAL</th>
                            <th style="width: 45%; text-align: center;">JAWABAN</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($no = 1)
                          @foreach($soal_penjodohan_terpilih as $select_soal_penjodohan)
                          <tr>
                            <td style="text-align: center;">{{$no++}}</td>
                            <td class="media_tabel">{!! $select_soal_penjodohan->soal !!}<h6>
                              <span class="badge bg-secondary">{{'Kelas '. $select_soal_penjodohan->kelas.' '.$select_soal_penjodohan->tingkat.'/sederajat'}}</span>
                              <span class="badge bg-secondary">{{ucwords($select_soal_penjodohan->nama).' - '.ucwords($select_soal_penjodohan->materi)}}</span></h6><br>
                              <div class="icheck-danger d-inline">
                                <input type="checkbox" name="hapus_soal[]" value="{{$select_soal_penjodohan->id_paket_soal}}" id="{{$select_soal_penjodohan->id_paket_soal}}">
                                <label for="{{$select_soal_penjodohan->id_paket_soal}}">HAPUS SOAL</label><br><br>
                              </div>
                            </td>
                            <td class="media_tabel">
                              {!! $select_soal_penjodohan->jawaban !!}
                                <button type="button" class="btn shadow-sm bg-purple btn-sm mb-1 lihat_pembahasan" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $select_soal_penjodohan->pembahasan }}">Lihat Pembahasan</button><br>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                
                <!-- bank soal true-false -->
                <div class="card card-light">
                  <div class="card-header">
                    <h4 class="card-title w-100">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapseFour">
                        <b>True-false/Benar-salah</b>
                        @foreach($jumlah_soals as $jumlah_soal)
                        @if($jumlah_soal->tipe_soal=='true-false')<span class="badge bg-purple ml-1">{{$jumlah_soal->jumlah}}</span>
                        @endif
                        @endforeach
                      </a>
                    </h4>
                  </div>
                  <div id="collapseFour" class="collapse" data-parent="#accordion">
                    <div class="card-body">
                      <table id="example4" class="table table-bordered table-valign-middle" style="table-layout: fixed">
                        <thead>
                          <tr>
                            <th style="width: 5%; text-align: center;">NO</th>
                            <th style="width: 85%; text-align: center;">SOAL</th>
                            <th style="width: 10%; text-align: center;">JAWABAN</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($no = 1)
                          @foreach($soal_truefalse_terpilih as $select_soal_truefalse)
                          <tr>
                            <td style="text-align: center;">{{$no++}}</td>
                            <td class="media_tabel">{!! $select_soal_truefalse->soal !!}<h6>
                              <span class="badge bg-secondary">{{'Kelas '. $select_soal_truefalse->kelas.' '.$select_soal_truefalse->tingkat.'/sederajat'}}</span>
                              <span class="badge bg-secondary">{{ucwords($select_soal_truefalse->nama).' - '.ucwords($select_soal_truefalse->materi)}}</span></h6><br>
                              <div class="icheck-danger d-inline">
                                <input type="checkbox" name="hapus_soal[]" value="{{$select_soal_truefalse->id_paket_soal}}" id="{{$select_soal_truefalse->id_paket_soal}}">
                                <label for="{{$select_soal_truefalse->id_paket_soal}}">HAPUS SOAL</label><br><br>
                              </div>
                            </td>
                            <td class="text-center">
                              @if($select_soal_truefalse->jawaban == 1)
                              <div class="icheck-success d-inline">
                                <input type="radio" checked id="benar">
                                <label for="benar">Benar</label>
                              </div>
                              @else 
                              <div class="icheck-danger d-inline">
                                <input type="radio" checked id="salah">
                                <label for="salah">Salah</label>
                              </div>
                              @endif<br><br>
                              <button type="button" class="btn shadow-sm bg-purple btn-sm mb-1 lihat_pembahasan" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $select_soal_truefalse->pembahasan }}">Pembahasan</button>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>

                <!-- /.modal lihat pembahasan-->
                <div class="modal fade" id="lihat-pembahasan">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Pembahasan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body p-4">
                        <div class="row col-12">
                          <div id="text_pembahasan" class="media_tabel"></div>
                        </div>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

              </div>
            </div>
            <!-- /.card-body -->

            <div class="modal-footer justify-content-between">
              <button id="submit" type="submit" class="btn bg-purple btn-block shadow-sm btn_hapus">Update Semua Soal</button>
              <!-- <button id="submit" type="submit" class="btn bg-purple btn-block shadow-sm btn_hapus" disabled>Update Semua Soal</button> -->
            </div>
            <!-- /.card-footer -->

          </form>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->
    
    <!-- Bank Soal Tersedia -->
    <div class="row mb-2">
      <div class="col-md-12">
        <div class="card">
          
          <form method="POST" action="{{ route('pilih.soal') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="master_paket_soal_id" value="{{$master_paket_soal->id}}">

            <div class="card-header">
              <h3 class="card-title"><b>Bank Soal Tersedia<small><i> (4 Tipe Soal)</i></small></b></h3>

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
                <div class="text-center col-12">
                  <h6><strong>Pilih dulu ya tipe soal yang ingin digunakan</strong></h6>
                </div>

                <div class="form-check ml-auto mr-2">
                  <input class="form-check-input" type="checkbox" style="margin-left:-1rem;" id="cb_objektif">
                  <label class="form-check-label">Pilihan Ganda</label>
                </div>

                <div class="form-check mr-2">
                  <input class="form-check-input" type="checkbox" style="margin-left:-1rem;" id="cb_subjektif">
                  <label class="form-check-label">Essay</label>
                </div>

                <div class="form-check mr-2">
                  <input class="form-check-input" type="checkbox" style="margin-left:-1rem;" id="cb_penjodohan">
                  <label class="form-check-label">Penjodohan</label>
                </div>

                <div class="form-check mr-auto ">
                  <input class="form-check-input" type="checkbox" style="margin-left:-1rem;" id="cb_truefalse">
                  <label class="form-check-label">True-false</label>
                </div>
              </div>

              <!-- we are adding the accordion ID so Bootstrap's collapse plugin detects it -->
              <div id="accordionn">
                
                <!-- bank soal objektif -->
                <div class="card card-light" id="list_objektif" hidden>
                  <div class="card-header">
                    <h4 class="card-title w-100">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapseSatu">
                        <b>Pilihan Ganda</b>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseSatu" class="collapse" data-parent="#accordionn">
                    <div class="card-body">
                      <table id="exampleSatu" class="table table-bordered table-valign-middle" style="table-layout: fixed">
                        <thead>
                          <tr>
                            <th style="width: 5%; text-align: center;">NO</th>
                            <th style="width: 45%; text-align: center;">SOAL</th>
                            <th style="width: 50%; text-align: center;">JAWABAN</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($no = 1)
                          @php ($i = 0)
                          @foreach($list_soal_objektif as $select_soal_objektif)
                          <tr>
                            <td style="text-align: center;">{{$no++}}</td>
                            <td class="media_tabel">{!! $select_soal_objektif->soal !!}<h6>
                              <span class="badge bg-secondary">{{'Kelas '. $select_soal_objektif->kelas.' '.$select_soal_objektif->tingkat.'/sederajat'}}</span>
                              <span class="badge bg-secondary">{{ucwords($select_soal_objektif->nama).' - '.ucwords($select_soal_objektif->materi)}}</span></h6><br>
                              <div class="icheck-primary d-inline">
                                <input type="checkbox" name="pilih_objektif[]" value="{{$select_soal_objektif->id_bank_soal}}" id="{{$select_soal_objektif->id_bank_soal}}">
                                <label for="{{$select_soal_objektif->id_bank_soal}}">PILIH SOAL</label><br><br>
                              </div>
                            </td>
                            <td>
                              @php ($huruf = 'A')
                              @php ($kunci = '')
                              @php ($kunci_hidden = '')
                              <ol type="A">
                              @foreach($list_jawaban_objektif as $jawaban_objektif)
                                @if($jawaban_objektif->banksoal_id == $select_soal_objektif->id_bank_soal)
                                  @if($jawaban_objektif->status == 1) 
                                    <?php $kunci=$huruf++; ?>
                                  @endif
                                  @if($jawaban_objektif->jawaban != '0')
                                    <li>{!! $jawaban_objektif->jawaban !!}</li>
                                    <?php $kunci_hidden=$huruf++; ?>
                                    <?php $bahasan_objektif=$select_soal_objektif->pembahasan; ?>
                                  @endif
                                @endif
                              @endforeach
                              </ol>
                              <b>KUNCI JAWABAN : {{$kunci}}</b><br><br>
                              <button type="button" class="btn bg-purple btn-sm lihat_pembahasan" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $bahasan_objektif }}">Lihat Pembahasan</button><br>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
                
                <!-- bank soal subjektif -->
                <div class="card card-light" id="list_subjektif" hidden>
                  <div class="card-header">
                    <h4 class="card-title w-100">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapseDua">
                        <b>Essay</b>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseDua" class="collapse" data-parent="#accordionn">
                    <div class="card-body">
                      <table id="exampleDua" class="table table-bordered table-valign-middle"style="table-layout: fixed">
                        <thead>
                          <tr>
                            <th style="width: 5%; text-align: center;">NO</th>
                            <th style="width: 45%; text-align: center;">SOAL</th>
                            <th style="width: 50%; text-align: center;">JAWABAN</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($no = 1)
                          @foreach($list_soal_subjektif as $select_soal_subjektif)
                          <tr>
                            <td style="text-align: center;">{{$no++}}</td>
                            <td class="media_tabel">{!! $select_soal_subjektif->soal !!}<h6>
                              <span class="badge bg-secondary">{{'Kelas '. $select_soal_subjektif->kelas.' '.$select_soal_subjektif->tingkat.'/sederajat'}}</span>
                              <span class="badge bg-secondary">{{ucwords($select_soal_subjektif->nama).' - '.ucwords($select_soal_subjektif->materi)}}</span></h6><br>
                              <div class="icheck-primary d-inline">
                                <input type="checkbox" name="pilih_subjektif[]" value="{{$select_soal_subjektif->id_bank_soal}}" id="{{$select_soal_subjektif->id_bank_soal}}">
                                <label for="{{$select_soal_subjektif->id_bank_soal}}">PILIH SOAL</label><br><br>
                              </div>
                            </td>
                            <td class="media_tabel">
                              {!! $select_soal_subjektif->jawaban !!}
                                <button type="button" class="btn shadow-sm bg-purple btn-sm mb-1 lihat_pembahasan" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $select_soal_subjektif->pembahasan }}">Lihat Pembahasan</button><br>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <!-- bank soal penjodohan -->
                <div class="card card-light" id="list_penjodohan" hidden>
                  <div class="card-header">
                    <h4 class="card-title w-100">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapseTiga">
                        <b>Penjodohan</b>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTiga" class="collapse" data-parent="#accordionn">
                    <div class="card-body">
                      <table id="exampleTiga" class="table table-bordered table-valign-middle" style="table-layout: fixed">
                        <thead>
                          <tr>
                            <th style="width: 5%; text-align: center;">NO</th>
                            <th style="width: 50%; text-align: center;">SOAL</th>
                            <th style="width: 45%; text-align: center;">JAWABAN</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($no = 1)
                          @foreach($list_soal_penjodohan as $select_soal_penjodohan)
                          <tr>
                            <td style="text-align: center;">{{$no++}}</td>
                            <td class="media_tabel">{!! $select_soal_penjodohan->soal !!}<h6>
                              <span class="badge bg-secondary">{{'Kelas '. $select_soal_penjodohan->kelas.' '.$select_soal_penjodohan->tingkat.'/sederajat'}}</span>
                              <span class="badge bg-secondary">{{ucwords($select_soal_penjodohan->nama).' - '.ucwords($select_soal_penjodohan->materi)}}</span></h6><br>
                              <div class="icheck-primary d-inline">
                                <input type="checkbox" name="pilih_penjodohan[]" value="{{$select_soal_penjodohan->id_bank_soal}}" id="{{$select_soal_penjodohan->id_bank_soal}}">
                                <label for="{{$select_soal_penjodohan->id_bank_soal}}">PILIH SOAL</label><br><br>
                              </div>
                            </td>
                            <td class="media_tabel">
                              {!! $select_soal_penjodohan->jawaban !!}
                                <button type="button" class="btn shadow-sm bg-purple btn-sm mb-1 lihat_pembahasan" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $select_soal_penjodohan->pembahasan }}">Lihat Pembahasan</button><br>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                
                <!-- bank soal true-false -->
                <div class="card card-light" id="list_truefalse" hidden>
                  <div class="card-header">
                    <h4 class="card-title w-100">
                      <a class="d-block w-100" data-toggle="collapse" href="#collapseEmpat">
                        <b>True-false/Benar-salah</b>
                      </a>
                    </h4>
                  </div>
                  <div id="collapseEmpat" class="collapse" data-parent="#accordionn">
                    <div class="card-body">
                      <table id="exampleEmpat" class="table table-bordered table-valign-middle" style="table-layout: fixed">
                        <thead>
                          <tr>
                            <th style="width: 5%; text-align: center;">NO</th>
                            <th style="width: 85%; text-align: center;">SOAL</th>
                            <th style="width: 10%; text-align: center;">JAWABAN</th>
                          </tr>
                        </thead>
                        <tbody>
                          @php ($no = 1)
                          @foreach($list_soal_truefalse as $select_soal_truefalse)
                          <tr>
                            <td style="text-align: center;">{{$no++}}</td>
                            <td class="media_tabel">{!! $select_soal_truefalse->soal !!}<h6>
                              <span class="badge bg-secondary">{{'Kelas '. $select_soal_truefalse->kelas.' '.$select_soal_truefalse->tingkat.'/sederajat'}}</span>
                              <span class="badge bg-secondary">{{ucwords($select_soal_truefalse->nama).' - '.ucwords($select_soal_truefalse->materi)}}</span></h6><br>
                              <div class="icheck-primary d-inline">
                                <input type="checkbox" name="pilih_truefalse[]" value="{{$select_soal_truefalse->id_bank_soal}}" id="{{$select_soal_truefalse->id_bank_soal}}">
                                <label for="{{$select_soal_truefalse->id_bank_soal}}">PILIH SOAL</label><br><br>
                              </div>
                            </td>
                            <td class="text-center">
                              @if($select_soal_truefalse->jawaban == 1)
                              <div class="icheck-success d-inline">
                                <input type="radio" checked id="benar">
                                <label for="benar">Benar</label>
                              </div>
                              @else 
                              <div class="icheck-danger d-inline">
                                <input type="radio" checked id="salah">
                                <label for="salah">Salah</label>
                              </div>
                              @endif<br><br>
                              <button type="button" class="btn shadow-sm bg-purple btn-sm mb-1 lihat_pembahasan" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $select_soal_truefalse->pembahasan }}">Pembahasan</button>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>

                <!-- /.modal lihat pembahasan-->
                <div class="modal fade" id="lihat-pembahasan">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Pembahasan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body p-4">
                        <div class="row col-12">
                          <div id="text_pembahasan" class="media_tabel"></div>
                        </div>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

              </div>
            </div>
            <!-- /.card-body -->

            <div class="modal-footer justify-content-between">
              <button id="submit" type="submit" class="btn bg-purple btn-block shadow-sm simpan_soal">Simpan Semua Soal</button>
            </div>
            <!-- /.card-footer -->

          </form>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->

    
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
                        <div class="text-right">
                          <!-- <button id="btn1">Set Text</button> -->
                          <input id="id" name="id" hidden value="">
                          <a id="link_bukti" href="#" class="btn btn-sm btn-secondary" target="_blank"><i class="fas fa-file-invoice-dollar"></i> Lihat Bukti Pembayaran</a>
                          <button id="submit" type="submit" class="btn bg-purple btn-sm btn_terima" hidden><i class="fas fa-user-check"></i> Terima</button>
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

  </div>


</section>
<!-- /.content -->
@endsection

@section('js-end')

<!-- Bootstrap Switch -->
<script src="{{asset('AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>

<script type="text/javascript">


  $("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  })
  // Initialize Select2 Elements
  $(document).ready(function() {
    
    $(".media_tabel img").addClass("img-responsive");
    $(".media_tabel iframe").addClass("embed-responsive-item");
    $(".media_tabel img").css("max-height", "150px");
    $(".media_tabel img").css("width", "auto");
    $(".media_tabel iframe").css("max-height", "150px");
    $(".media_tabel iframe").css("width", "auto");
    $("ol").css("padding-left", "1.2em");
    $("ol").css("text-align", "justify");

    var old_value = '';
    $('.btn_hapus').click(function() {
      var $form = $(this);

      if ($('input[name="hapus_soal[]"]').length==0) {
        toastr.error('Kamu belum menambahkan soal :(')
        return false;
      }
      else{
      
        var table1 = $('#example1').DataTable();
        var table2 = $('#example2').DataTable();
        var table3 = $('#example3').DataTable();
        var table4 = $('#example4').DataTable();
        var total_checkbox = 1;
        var unselected_checkbox = 1;

        table1.$('input[name="hapus_soal[]"]').each(function(){
            if(!$.contains(document, this)){
              if(this.checked){
                if(old_value!=this.value){
                  $form.append($('<input>').attr('type', 'hidden').attr('name', this.name).val(this.value));
                  old_value = this.value;
                }
              }
            } 

            if(!$.contains(document, this && $.contains(document, this))){
              if(!this.checked){
                unselected_checkbox++;
              }
            }
            total_checkbox++;
        });

        table2.$('input[name="hapus_soal[]"]').each(function(){
            if(!$.contains(document, this)){
              if(this.checked){
                if(old_value!=this.value){
                  $form.append($('<input>').attr('type', 'hidden').attr('name', this.name).val(this.value));
                  old_value = this.value;
                }
              }
            } 

            if(!$.contains(document, this && $.contains(document, this))){
              if(!this.checked){
                unselected_checkbox++;
              }
            }
            total_checkbox++;
        });

        table3.$('input[name="hapus_soal[]"]').each(function(){
            if(!$.contains(document, this)){
              if(this.checked){
                if(old_value!=this.value){
                  $form.append($('<input>').attr('type', 'hidden').attr('name', this.name).val(this.value));
                  old_value = this.value;
                }
              }
            } 

            if(!$.contains(document, this && $.contains(document, this))){
              if(!this.checked){
                unselected_checkbox++;
              }
            }
            total_checkbox++;
        });

        table4.$('input[name="hapus_soal[]"]').each(function(){
            if(!$.contains(document, this)){
              if(this.checked){
                if(old_value!=this.value){
                  $form.append($('<input>').attr('type', 'hidden').attr('name', this.name).val(this.value));
                  old_value = this.value;
                }
              }
            } 

            if(!$.contains(document, this && $.contains(document, this))){
              if(!this.checked){
                unselected_checkbox++;
              }
            }
            total_checkbox++;
        });

        if(total_checkbox==unselected_checkbox){
          toastr.error('Kamu belum menandai soal yang ingin dihapus :(')
          return false;
        }
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

    var old_value_objektif = '';
    var old_value_subjektif = '';
    var old_value_penjodohan = '';
    var old_value_truefalse = '';
    $('.simpan_soal').click(function() {
      var $form = $(this);

      if($('#cb_objektif').is(":checked")||$('#cb_subjektif').is(":checked")||$('#cb_penjodohan').is(":checked")||$('#cb_truefalse').is(":checked")) {

        if($('#cb_objektif').is(":checked")){
          var table = $('#exampleSatu').DataTable();
          var total_checkbox = 1;
          var unselected_checkbox = 1;

          table.$('input[name="pilih_objektif[]"]').each(function(){
              if(!$.contains(document, this)){
                if(this.checked){
                  if(old_value_objektif!=this.value){
                    $form.append($('<input>').attr('type', 'hidden').attr('name', this.name).val(this.value));
                    old_value_objektif = this.value;
                  }
                }
              } 

              if(!$.contains(document, this && $.contains(document, this))){
                if(!this.checked){
                  unselected_checkbox++;
                }
              }
              total_checkbox++;
          });

          if(total_checkbox==unselected_checkbox){
            toastr.error('Kamu belum memilih soal pilihan ganda!')
            return false;
          }

        }

        if($('#cb_subjektif').is(":checked")){
          var table = $('#exampleDua').DataTable();
          var total_checkbox = 1;
          var unselected_checkbox = 1;

          table.$('input[name="pilih_subjektif[]"]').each(function(){
              if(!$.contains(document, this)){
                if(this.checked){
                  if(old_value_subjektif!=this.value){
                    $form.append($('<input>').attr('type', 'hidden').attr('name', this.name).val(this.value));
                    old_value_subjektif = this.value;
                  }
                }
              } 

              if(!$.contains(document, this && $.contains(document, this))){
                if(!this.checked){
                  unselected_checkbox++;
                }
              }
              total_checkbox++;
          });

          if(total_checkbox==unselected_checkbox){
            toastr.error('Kamu belum memilih soal essay!')
            return false;
          }

        }

        if($('#cb_penjodohan').is(":checked")){
          var table = $('#exampleTiga').DataTable();
          var total_checkbox = 1;
          var unselected_checkbox = 1;

          table.$('input[name="pilih_penjodohan[]"]').each(function(){
              if(!$.contains(document, this)){
                if(this.checked){
                  if(old_value_penjodohan!=this.value){
                    $form.append($('<input>').attr('type', 'hidden').attr('name', this.name).val(this.value));
                    old_value_penjodohan = this.value;
                  }
                }
              } 

              if(!$.contains(document, this && $.contains(document, this))){
                if(!this.checked){
                  unselected_checkbox++;
                }
              }
              total_checkbox++;
          });

          if(total_checkbox==unselected_checkbox){
            toastr.error('Kamu belum memilih soal penjodohan!')
            return false;
          }

        }

        if($('#cb_truefalse').is(":checked")){
          var table = $('#exampleEmpat').DataTable();
          var total_checkbox = 1;
          var unselected_checkbox = 1;

          table.$('input[name="pilih_truefalse[]"]').each(function(){
              if(!$.contains(document, this)){
                if(this.checked){
                  if(old_value_truefalse!=this.value){
                    $form.append($('<input>').attr('type', 'hidden').attr('name', this.name).val(this.value));
                    old_value_truefalse = this.value;
                  }
                }
              } 

              if(!$.contains(document, this && $.contains(document, this))){
                if(!this.checked){
                  unselected_checkbox++;
                }
              }
              total_checkbox++;
          });

          if(total_checkbox==unselected_checkbox){
            toastr.error('Kamu belum memilih soal true-false!')
            return false;
          }

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
    
    $("#example1").DataTable({
      "paging": true,
      "responsive": true, 
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
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    
    $("#example4").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
    
    $("#exampleSatu").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#exampleSatu_wrapper .col-md-6:eq(0)');
    
    $("#exampleDua").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#exampleDua_wrapper .col-md-6:eq(0)');
    
    $("#exampleTiga").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#exampleTiga_wrapper .col-md-6:eq(0)');
    
    $("#exampleEmpat").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#exampleEmpat_wrapper .col-md-6:eq(0)');


  });



</script>

@endsection