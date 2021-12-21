@extends('AdminLTE.app')

@section('js-start')

  
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    
    <!-- Info update soal -->
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
                  <b>Bank soal kosong!</b> <br> {{'Pilihan Ganda : '.$jumlah_objektif.' soal, Essay : '.$jumlah_subjektif.' soal, Penjodohan : '.$jumlah_penjodohan.' soal, True-false : '.$jumlah_truefalse.' soal'}}
                @else
                  @foreach($last_update as $last)
                    @if ($loop->first)
                    <b>Pembaruan terakhir pada {{$last->updated_at->isoFormat('dddd, D MMMM Y hh:mm').' WITA'}} </b> <br> {{'Pilihan Ganda : '.$jumlah_objektif.' soal, Essay : '.$jumlah_subjektif.' soal, Penjodohan : '.$jumlah_penjodohan.' soal, True-false : '.$jumlah_truefalse.' soal'}}
                    @endif
                  @endforeach
                @endif
            </div>
          </div>
          
        </div>
      </div>
    </div>
    
    <!-- Info simpan soal -->
    <div class="row mt-2 mb-2">
      <div class="col-12 col-md-12">
        @foreach (['danger', 'warning', 'success', 'info'] as $key)
          @if(Session::has($key))
            <div class="alert alert-default-{{ $key }} alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <div style="justify-content:flex-start; display: flex;">

                <div style="display: table-cell; vertical-align: middle;">
                  {{ Session::get($key) }}
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>

    <!-- Row Form Input Bank Soal -->
    <div class="row mt-3 mb-2">

      <div class="col-12 col-md-12">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>Form Buat Soal <small><i> (4 Tipe Soal)</i></small></b></h3>

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
          
          <div id="collapseForm" class="card-body collapse show">
            <form method="POST" action="{{ route('bank_soals.store') }}" enctype="multipart/form-data">
              @csrf
                  
              <!-- form input -->
              <div class="row">

                <!-- Tipe Soal -->
                <div class="form-group col-12 col-md-6">

                  <label for="tipe">Tipe Soal</label>
                  <select id="tipe" name="tipe" value="{{ old('tipe') }}" class="form-control select2 @error('tipe') is-invalid @enderror">
                      @php ($list_tipe = ['objektif','subjektif','penjodohan','true-false'])
                      <option value="" selected disabled>Pilih Tipe</option>
                      @foreach($list_tipe as $select_tipe)
                      @if($select_tipe=='objektif')@php($tipe='Pilihan Ganda')
                      @elseif($select_tipe=='subjektif')@php($tipe='Essay')
                      @elseif($select_tipe=='penjodohan')@php($tipe='Penjodohan')
                      @elseif($select_tipe=='true-false')@php($tipe='True False')
                      @endif
                          <option {{old('tipe') =="$select_tipe" ? "selected" : ""}} value="{{$select_tipe}}">{{$tipe}}</option>
                      @endforeach
                  </select>
                  
                  @error('tipe')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>

                <!-- Kelas -->
                <div class="form-group col-12 col-md-6">

                  <label for="kelas">Kelas</label>
                  <select id="kelas" name="kelas" class="form-control select2 @error('kelas') is-invalid @enderror">
                      <option value="" selected disabled>Pilih kelas</option>
                      @foreach($list_kelas as $select_kelas)
                          <option {{old('kelas') =="$select_kelas->id" ? "selected" : ""}} value="{{$select_kelas->id}}">{{$select_kelas->kelas.' '.$select_kelas->tingkat.'/sederajat'}}</option>
                      @endforeach
                  </select>

                  @error('kelas')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>

                <!-- Mata Pelajaran -->
                <div class="form-group col-12 col-md-6">

                  <label for="mapel">Mata Pelajaran</label>
                  <select id="mapel" name="mapel" class="form-control select2 @error('mapel') is-invalid @enderror">
                      <option value="" selected disabled>Pilih Mata Pelajaran</option>
                      @foreach($program_mapels as $program_mapel)
                      @if($program_mapel->materi)
                      @php($spesial=ucwords($program_mapel->nama).' - '.ucwords($program_mapel->materi))
                      @else
                      @php($spesial=ucwords($program_mapel->nama))
                      @endif
                        <option {{old('mapel') =="$program_mapel->id" ? "selected" : ""}} value="{{$program_mapel->id}}">{{$spesial}}</option>
                      @endforeach
                  </select>

                  @error('mapel')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>

                <!-- Banyak Jawaban -->
                <div class="form-group col-12 col-md-6">

                  <label for="jml_objektif">Banyak Jawaban</label>
                  <input id="jml_objektif" name="jml_objektif" type="number" max="5" min="3" class="form-control @error('jml_objektif') is-invalid @enderror" placeholder="3" value="{{ old('jml_objektif') }} " disabled>
                  
                  @error('jml_objektif')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>

              </div>
              
              <!-- Soal / Pertanyaan -->
              <div class="row">
                <div class="form-group col-12 col-md-12">
                  <label for="summernote-soal">Pertanyaan</label>
                  <textarea id="summernote-soal" name="summernote-soal" class="form-control @error('summernote-soal') is-invalid @enderror">{{ old('summernote-soal') }}</textarea>
                  
                  @error('summernote-soal')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>

              <!-- button  -->
              <div class="row">
                <div class="form-group col-12">
                  <button id="modal_jawaban" type="button" class="btn bg-purple btn-block" data-toggle="modal" data-target="#modal-xl">
                    <i class="fas fa-pencil-alt"></i> Input Jawaban
                  </button>
                </div>
              </div>
              
          
              <!-- Modal Objektif -->
              <div class="modal fade" id="modal_objektif">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Input Jawaban Soal Objektif</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">

                        <!-- Tipe Soal Objektif -->
                        <div id="objektif" class="form-group col-12 col-md-12">

                          <div class="row">
                            <!-- Pilihan A -->
                            <div id="div-a" class="form-group col-12">
                              <!-- <label for="pilihan-a" class="col-form-label">{{ __('Pilihan A') }}</label> -->
                              <textarea id="pilihan-a" class="form-control @error('pilihan-a') is-invalid @enderror pilihan" name="jawaban_pilihan[]" placeholder="Masukkan pilihan A">{{ old('jawaban_pilihan.0') }}</textarea>
                          
                              @error('pilihan-a')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                              <input type="hidden" name="cb[]" value="0">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" prevvalue="{{old('cb.1')}}" id="cb-a" name="cb[]" value="1" {{old('cb.1') =="1" ? "checked" : ""}} class="form-control @error('cb') is-invalid @enderror" onclick="cbFunction();">
                                <label for="cb-a">Pilih jika <span class="badge badge-info">OPSI A</span> adalah jawaban yang benar</label>
                              </div>

                            </div>

                            <!-- Pilihan B -->
                            <div id="div-b" class="form-group col-12 mt-2">
                              <!-- <label for="pilihan-b" class="col-form-label">{{ __('Pilihan B') }}</label> -->
                              <textarea id="pilihan-b" class="form-control @error('pilihan-b') is-invalid @enderror pilihan" name="jawaban_pilihan[]" placeholder="Masukkan pilihan B">{{ old('jawaban_pilihan.1') }}</textarea>
                        
                              @error('pilihan-b')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                              <input type="hidden" name="cb[]" value="0">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" prevvalue="{{old('cb.2')}}" id="cb-b" name="cb[]" value="1" {{old('cb.2') =="1" ? "checked" : ""}} class="form-control @error('cb') is-invalid @enderror" onclick="cbFunction()">
                                <label for="cb-b">Pilih jika <span class="badge badge-info">OPSI B</span> adalah jawaban yang benar</label>
                              </div>

                            </div>

                            <!-- Pilihan C -->
                            <div id="div-c" class="form-group col-12 mt-2">
                              <!-- <label for="pilihan-c" class="col-form-label">{{ __('Pilihan C') }}</label> -->
                              <textarea id="pilihan-c" class="form-control @error('pilihan-c') is-invalid @enderror pilihan" name="jawaban_pilihan[]" placeholder="Masukkan pilihan C">{{ old('jawaban_pilihan.2') }}</textarea>
                        
                              @error('pilihan-c')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                              <input type="hidden" name="cb[]" value="0">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" prevvalue="{{old('cb.3')}}" id="cb-c" name="cb[]" value="1" {{old('cb.3') =="1" ? "checked" : ""}} class="form-control @error('cb') is-invalid @enderror" onclick="cbFunction()">
                                <label for="cb-c">Pilih jika <span class="badge badge-info">OPSI C</span> adalah jawaban yang benar</label>
                              </div>

                            </div>

                            <!-- Pilihan D -->
                            <div id="div-d" class="form-group col-12 mt-2" hidden>
                              <!-- <label for="pilihan-d" class="col-form-label">{{ __('Pilihan D') }}</label> -->
                              <textarea id="pilihan-d" class="form-control @error('pilihan-d') is-invalid @enderror pilihan" name="jawaban_pilihan[]" placeholder="Masukkan pilihan D">{{ old('jawaban_pilihan.3') }}</textarea>
                              
                              @error('pilihan-d')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                              <input type="hidden" name="cb[]" value="0">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" prevvalue="{{old('cb.4')}}" id="cb-d" name="cb[]" value="1" {{old('cb.4') =="1" ? "checked" : ""}} class="form-control @error('cb') is-invalid @enderror" onclick="cbFunction()">
                                <label for="cb-d">Pilih jika <span class="badge badge-info">OPSI D</span> adalah jawaban yang benar</label>
                              </div>

                            </div>

                            <!-- Pilihan E -->
                            <div id="div-e" class="form-group col-12 mt-2" hidden>
                              <!-- <label for="pilihan-e" class="col-form-label">{{ __('Pilihan E') }}</label> -->
                              <textarea id="pilihan-e" class="form-control @error('pilihan-e') is-invalid @enderror pilihan" name="jawaban_pilihan[]" placeholder="Masukkan pilihan E">{{ old('jawaban_pilihan.4') }}</textarea>
                        
                              @error('pilihan-e')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                              <input type="hidden" name="cb[]" value="0">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" prevvalue="{{old('cb.5')}}" id="cb-e" name="cb[]" value="1" {{old('cb.5') =="1" ? "checked" : ""}} class="form-control @error('cb') is-invalid @enderror" onclick="cbFunction()">
                                <label for="cb-e">Pilih jika <span class="badge badge-info">OPSI E</span> adalah jawaban yang benar</label>
                              </div>

                            </div>

                            <!-- Pembahasan -->
                            <div class="form-group col-12 mb-0 mt-4">
                              <hr>
                              <label for="pembahasan">Pembahasan</label>
                              <textarea name="pembahasan_objektif" class="form-control @error('pembahasan') is-invalid @enderror pembahasan">{{ old('pembahasan') }}</textarea>
                            </div>

                          </div>

                        </div>

                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button> -->
                      <button id="submit" type="submit" class="btn btn-block bg-purple validasi_objektif">Simpan Data</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

              <!-- Modal Subjektif / Penjodohan -->
              <div class="modal fade" id="modal_subjektif_penjodohan">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Input Jawaban</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">

                        <!-- Tipe Soal Subjektif / Penjodohan -->
                        <div id="subjektif_penjodohan" class="form-group col-12 col-md-12">
                          <label for="summernote-jawaban">Jawaban</label>
                          <textarea id="summernote-jawaban" name="summernote-jawaban" class="form-control @error('summernote-jawaban') is-invalid @enderror">{{ old('summernote-jawaban') }}</textarea>
                          
                          @error('summernote-jawaban')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                        <!-- Pembahasan -->
                        <div class="form-group col-12 mb-0">
                          <hr>
                          <label for="pembahasan">Pembahasan</label>
                          <textarea name="pembahasan_subjektif_penjodohan" class="form-control @error('pembahasan_subjektif') is-invalid @enderror pembahasan">{{ old('pembahasan_subjektif') }}</textarea>
                        </div>

                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button id="submit" type="submit" class="btn btn-block bg-purple validasi_subjektif_penjodohan">Simpan Data</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>

              <!-- Modal True-false -->
              <div class="modal fade" id="modal_true_false">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Input Jawaban Soal True-false</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">

                        <!-- Tipe Soal True False -->
                        <div id="true-false" class="form-group col-12 col-md-12">
                          <label>Jawaban</label>

                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group clearfix">
                                Silahkan pilih salah satu opsi dibawah untuk menentukan jawaban dari soal, apakah benar atau salah.
                              </div>
                            </div>
                          </div>
                          
                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group clearfix">
                                <div class="icheck-success d-inline">
                                  <input type="radio" name="radioJawaban" id="radioTrue" value="1" {{old('radioJawaban') =="1" ? "checked" : ""}} class="form-control @error('radioJawaban') is-invalid @enderror">
                                  <label for="radioTrue">
                                    Benar
                                  </label>
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-12">
                              <div class="form-group clearfix">
                                <div class="icheck-danger d-inline">
                                  <input type="radio" name="radioJawaban" id="radioFalse" value="0" {{old('radioJawaban') =="0" ? "checked" : ""}} class="form-control @error('radioJawaban') is-invalid @enderror">
                                  <label for="radioFalse">
                                    Salah
                                  </label>
                                  @error('radioJawaban')
                                    <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                  @enderror
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Pembahasan -->
                        <div class="form-group col-12 mb-0">
                          <hr>
                          <label for="pembahasan">Pembahasan</label>
                          <textarea name="pembahasan_true_false" class="form-control @error('pembahasan') is-invalid @enderror pembahasan">{{ old('pembahasan') }}</textarea>
                    
                          @error('pembahasan')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button id="submit" type="submit" class="btn btn-block bg-purple validasi_truefalse">Simpan Data</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              
              <!-- /.modal -->

            </form>
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
      </div>
      
    </div>
    <!-- /.row -->
    
    <!-- Row List Bank Soal -->
    <div class="row mt-3 mb-2">
      <div class="col-md-12">
        <div class="card">
          
          <div class="card-header">
            <h3 class="card-title"><b>Daftar Bank Soal <small><i> (4 Tipe Soal)</i></small></b></h3>

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
                      <b>Pilihan Ganda <span class="badge bg-purple">{{$list_soal_objektif->count().' soal'}}</span></b>
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-valign-middle" style="table-layout: fixed">
                      <thead>
                        <tr>
                          <th style="width: 5%; text-align: center;">NO</th>
                          <th style="width: 40%; text-align: center;">SOAL</th>
                          <th style="width: 55%; text-align: center;">JAWABAN</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php ($no = 1)
                        @php ($i = 0)
                        @foreach($list_soal_objektif as $select_soal_objektif)
                        @if($select_soal_objektif->materi)
                        @php($materi=ucwords($select_soal_objektif->nama).' - '.ucwords($select_soal_objektif->materi))
                        @else
                        @php($materi=ucwords($select_soal_objektif->nama))
                        @endif
                        <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td class="media_tabel">{!! $select_soal_objektif->soal !!}<h6>
                            <span class="badge bg-secondary shadow-sm">{{'Kelas '. $select_soal_objektif->kelas.' '.$select_soal_objektif->tingkat.'/sederajat'}}</span>
                            <span class="badge bg-secondary shadow-sm">{{$materi}}</span></h6>
                          </td>
                          <td class="media_tabel">
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
                            
                            <button type="button" class="btn bg-purple btn-sm lihat_pembahasan shadow-sm" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $bahasan_objektif }}">Lihat Pembahasan</button>
                            <a href="{{ route('bank_soals.edit',$select_soal_objektif->id_bank_soal) }}" type="button" class="btn btn-warning btn-sm shadow-sm">Edit Soal</a>
                            <button  onclick="return false" class="btn shadow-sm btn-sm bg-maroon delete_soal" data-id="{{ $select_soal_objektif->id_bank_soal }}" data-tipe="{{ $select_soal_objektif->tipe_soal }}">Hapus Soal</button><br>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>

              <!-- modal verifikasi hapus objektif -->
              @foreach($list_soal_objektif as $select_soal_objektif)
                <div class="modal fade" id="hapus-objektif">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title me-auto">Ingin Menghapus Data?</h5>
                      </div>
                      <div class="modal-footer ms-auto">
                        <form action="{{ route('bank_soals.destroy',$select_soal_objektif->id) }}" method="POST">   
                          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                          @csrf
                          @method('DELETE')      
                          <input id="id" name="id" hidden value="">
                          <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
              @endforeach
              
              <!-- bank soal subjektif -->
              <div class="card card-light">
                <div class="card-header">
                  <h4 class="card-title w-100">
                    <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                      <b>Essay <span class="badge bg-purple">{{$list_soal_subjektif->count().' soal'}}</span></b>
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
                        @foreach($list_soal_subjektif as $select_soal_subjektif)
                        @if($select_soal_subjektif->materi)
                        @php($materi=ucwords($select_soal_subjektif->nama).' - '.ucwords($select_soal_subjektif->materi))
                        @else
                        @php($materi=ucwords($select_soal_subjektif->nama))
                        @endif
                        <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td class="media_tabel">{!! $select_soal_subjektif->soal !!}<h6>
                            <span class="badge bg-secondary">{{'Kelas '. $select_soal_subjektif->kelas.' '.$select_soal_subjektif->tingkat.'/sederajat'}}</span>
                            <span class="badge bg-secondary">{{$materi}}</span></h6>
                          </td>
                          <td class="media_tabel">
                            {!! $select_soal_subjektif->jawaban !!}
                              <button type="button" class="btn shadow-sm bg-purple btn-sm lihat_pembahasan" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $select_soal_subjektif->pembahasan }}">Lihat Pembahasan</button>
                              <a href="{{ route('bank_soals.edit',$select_soal_subjektif->id_bank_soal) }}" type="button" class="btn shadow-sm btn-warning btn-sm">Edit Soal</a>
                              <button  onclick="return false" class="btn shadow-sm btn-sm bg-maroon delete_soal" data-id="{{ $select_soal_subjektif->id_bank_soal }}" data-tipe="{{ $select_soal_subjektif->tipe_soal }}">Hapus Soal</button><br>
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
                      <b>Penjodohan <span class="badge bg-purple">{{$list_soal_penjodohan->count().' soal'}}</span></b>
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="collapse" data-parent="#accordion">
                  <div class="card-body">
                    <table id="example3" class="table table-bordered table-valign-middle" style="table-layout: fixed">
                      <thead>
                        <tr>
                          <th style="width: 5%; text-align: center;">NO</th>
                          <th style="width: 45%; text-align: center;">SOAL</th>
                          <th style="width: 50%; text-align: center;">JAWABAN</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php ($no = 1)
                        @foreach($list_soal_penjodohan as $select_soal_penjodohan)
                        @if($select_soal_penjodohan->materi)
                        @php($materi=ucwords($select_soal_penjodohan->nama).' - '.ucwords($select_soal_penjodohan->materi))
                        @else
                        @php($materi=ucwords($select_soal_penjodohan->nama))
                        @endif
                        <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td class="media_tabel">{!! $select_soal_penjodohan->soal !!}<h6>
                            <span class="badge bg-secondary">{{'Kelas '. $select_soal_penjodohan->kelas.' '.$select_soal_penjodohan->tingkat.'/sederajat'}}</span>
                            <span class="badge bg-secondary">{{$materi}}</span></h6>
                          </td>
                          <td class="media_tabel">
                            {!! $select_soal_penjodohan->jawaban !!}
                              <button type="button" class="btn shadow-sm bg-purple btn-sm lihat_pembahasan" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $select_soal_penjodohan->pembahasan }}">Lihat Pembahasan</button>
                              <a href="{{ route('bank_soals.edit',$select_soal_penjodohan->id_bank_soal) }}" type="button" class="btn shadow-sm btn-warning btn-sm">Edit Soal</a>
                              <button  onclick="return false" class="btn shadow-sm btn-sm bg-maroon delete_soal" data-id="{{ $select_soal_penjodohan->id_bank_soal }}" data-tipe="{{ $select_soal_penjodohan->tipe_soal }}">Hapus Soal</button>
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
                      <b>True False <span class="badge bg-purple">{{$list_soal_truefalse->count().' soal'}}</span></b>
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
                        @foreach($list_soal_truefalse as $select_soal_truefalse)
                        @if($select_soal_truefalse->materi)
                        @php($materi=ucwords($select_soal_truefalse->nama).' - '.ucwords($select_soal_truefalse->materi))
                        @else
                        @php($materi=ucwords($select_soal_truefalse->nama))
                        @endif
                        <tr>
                          <td style="text-align: center;">{{$no++}}</td>
                          <td class="media_tabel">{!! $select_soal_truefalse->soal !!}<h6>
                            <span class="badge bg-secondary">{{'Kelas '. $select_soal_truefalse->kelas.' '.$select_soal_truefalse->tingkat.'/sederajat'}}</span>
                            <span class="badge bg-secondary">{{$materi}}</span></h6><br>
                              <button type="button" class="btn shadow-sm bg-purple btn-sm lihat_pembahasan" data-toggle="modal" data-target="#lihat-pembahasan" data-pembahasan="{{ $select_soal_truefalse->pembahasan }}">Lihat Pembahasan</button>
                              <a href="{{ route('bank_soals.edit',$select_soal_truefalse->id_bank_soal) }}" type="button" class="btn shadow-sm btn-warning btn-sm">Edit Soal</a>
                              <button  onclick="return false" class="btn shadow-sm btn-sm bg-maroon delete_soal" data-id="{{ $select_soal_truefalse->id_bank_soal }}" data-tipe="{{ $select_soal_truefalse->tipe_soal }}">Hapus Soal</button><br><br>
                          </td>
                          @if($select_soal_truefalse->jawaban == 1)
                            <td class="bg-success"><h5><center>Benar</center></h5></td>
                          @else 
                            <td class="bg-maroon"><h5><center>Salah</center></h5></td>
                          @endif
                          
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
  $('body').on('click', '.delete_soal', function (event) {
    var id = $(this).data('id');
    var tipe = $(this).data('tipe');
    // $("#id").attr( "value",id);

    Swal.fire({
      title: 'Yakin mengahpus?',
      text: "Tindakan ini bersifat permanen",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Ya, hapus!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: ' bank_soals/' + id,
          type: 'POST',
          data: {
            _method: "DELETE",
            _token: "{{ csrf_token() }}",
            tipe: tipe,
          },
          dataType: 'json',
          success: function (data) {
            window.location.href = '/bank_soals'
          }
        });
      }
    })
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
</script>


<!-- Expand & Collapse Card || Custom Summernote || Form Validate -->
<script type="text/javascript">

  // toogle button for expand and collapse change icon
  // $('.btn-tool').click(function() {
  //     $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
  // });

  // Validate Checkbox Jawaban Pilihan Ganda 
  $( "#modal_objektif" ).on('shown.bs.modal', function (e) {
    if($("#cb-a").is(':checked')){
        // alert('value : '+$("#cb-a").val());
        console.log('masuk')
        $("#cb-b").prop('disabled', true);
        $("#cb-c").prop('disabled', true);
        $("#cb-d").prop('disabled', true);
        $("#cb-e").prop('disabled', true);
    } 
    else if($("#cb-b").is(':checked')){
        $("#cb-a").prop('disabled', true);
        $("#cb-c").prop('disabled', true);
        $("#cb-d").prop('disabled', true);
        $("#cb-e").prop('disabled', true);
    }  
    else if($("#cb-c").is(':checked')){
        $("#cb-a").prop('disabled', true);
        $("#cb-b").prop('disabled', true);
        $("#cb-d").prop('disabled', true);
        $("#cb-e").prop('disabled', true);
    }  
    else if($("#cb-d").is(':checked')){
        $("#cb-a").prop('disabled', true);
        $("#cb-b").prop('disabled', true);
        $("#cb-c").prop('disabled', true);
        $("#cb-e").prop('disabled', true);
    }   
    else if($("#cb-e").is(':checked')){
        $("#cb-a").prop('disabled', true);
        $("#cb-b").prop('disabled', true);
        $("#cb-c").prop('disabled', true);
        $("#cb-d").prop('disabled', true);
    }   
    else if(!$("#cb-a").is(':checked') && !$("#cb-b").is(':checked') || !$("#cb-c").is(':checked') || !$("#cb-d").is(':checked') || !$("#cb-e").is(':checked')){
        $("#cb-a").prop('disabled', false);
        $("#cb-b").prop('disabled', false);
        $("#cb-c").prop('disabled', false);
        $("#cb-d").prop('disabled', false);
        $("#cb-e").prop('disabled', false);
    } 
  });

  // change answer modal 
  $("#tipe").on("change keyup keydown paste click", function(){
    if ($("#tipe option:selected").val() == 'objektif') {
      $("#jml_objektif").prop('disabled', false);
      $('#modal_jawaban').attr('data-target','#modal_objektif');
    } 
    else if ($("#tipe option:selected").val() == 'true-false'){
      $("#jml_objektif").prop('disabled', true);
      $('#modal_jawaban').attr('data-target','#modal_true_false');
    }
    else if ($("#tipe option:selected").val() == 'subjektif' || $("#tipe option:selected").val() == 'penjodohan'){
      $("#jml_objektif").prop('disabled', true);
      $('#modal_jawaban').attr('data-target','#modal_subjektif_penjodohan');
    }
  })

  $(document).ready(function() {
    if ($("#tipe option:selected").val() == 'objektif') {
      $("#jml_objektif").prop('disabled', false);
      $('#modal_jawaban').attr('data-target','#modal_objektif');
    } 
    else if ($("#tipe option:selected").val() == 'true-false'){
      $("#jml_objektif").prop('disabled', true);
      $('#modal_jawaban').attr('data-target','#modal_true_false');
    }
    else if ($("#tipe option:selected").val() == 'subjektif' || $("#tipe option:selected").val() == 'penjodohan'){
      $("#jml_objektif").prop('disabled', true);
      $('#modal_jawaban').attr('data-target','#modal_subjektif_penjodohan');
    }
  });

  // validasi input form
  $(document).ready(function() {
    const jml_objektif = document.getElementById("jml_objektif");
    
    // validasi form soal
    $('#modal_jawaban').click(function() {
      if (!$('#tipe').val()) {
        toastr.error('Isi kolom tipe soal.')
        return false;
      }
      else if (!$('#kelas').val()) {
        toastr.error('Isi kolom kelas.')
        return false;
      }
      else if (!$('#mapel').val()) {
        toastr.error('Isi kolom mata pelajaran/program.')
        return false;
      }
      else if ($("#tipe option:selected").val() == 'objektif' && !$('#jml_objektif').val()) {
        toastr.error('Isi kolom banyak jawaban.')
        return false;
      }
      else if (!jml_objektif.checkValidity()) {
        toastr.error('Banyak jawaban objektif adalah 3-5 opsi.')
        return false;
      }
      else if (!$('#summernote-soal').val()) {
        toastr.error('Isi kolom pertanyaan.')
        return false;
      }
      else if ($('#jml_objektif').val() == 3) {
        $("#div-d").prop('hidden', 'true');
        $("#div-e").prop('hidden', 'true');
                
        $("#cb-a").prop('disabled', false);
        $("#cb-b").prop('disabled', false);
        $("#cb-c").prop('disabled', false);

        if ($("#cb-d").is( ":checked" ) ) {
          $("#cb-d").prop('checked', false);
        }
        else if ($("#cb-e").is( ":checked" ) ) {
          $("#cb-e").prop('checked', false);
        }
      }
      else if ($('#jml_objektif').val() == 4) {
        $("#div-d").prop('hidden', '');
        $("#div-e").prop('hidden', 'true');

        $("#cb-a").prop('disabled', false);
        $("#cb-b").prop('disabled', false);
        $("#cb-c").prop('disabled', false);
        $("#cb-d").prop('disabled', false);

        if ($("#cb-e").is( ":checked" ) ) {
          $("#cb-e").prop('checked', false);
        }
      }
      else if ($('#jml_objektif').val() == 5) {
        $("#div-d").prop('hidden', '');
        $("#div-e").prop('hidden', '');
      }
      
    })

    // validasi modal jawaban objektif
    $('.validasi_objektif').click(function() {
      
      $("#summernote-jawaban").val('');
      $("input:radio[name=radioJawaban]").val('');   
        
      if ($('#jml_objektif').val() == 3) {
        
        $("#pilihan-d").val('');
        $("#pilihan-e").val('');

        if (!$('#pilihan-a').val()) {
          toastr.error('Isi kolom jawaban pilihan A.')
          return false;
        }
        else if (!$('#pilihan-b').val()) {
          toastr.error('Isi kolom jawaban pilihan B.')
          return false;
        }
        else if (!$('#pilihan-c').val()) {
          toastr.error('Isi kolom jawaban pilihan C.')
          return false;
        }

      }
      else if ($('#jml_objektif').val() == 4) {
        
        $("#pilihan-e").val('');

        if (!$('#pilihan-a').val()) {
          toastr.error('Isi kolom jawaban pilihan A.')
          return false;
        }
        else if (!$('#pilihan-b').val()) {
          toastr.error('Isi kolom jawaban pilihan B.')
          return false;
        }
        else if (!$('#pilihan-c').val()) {
          toastr.error('Isi kolom jawaban pilihan C.')
          return false;
        }
        else if (!$('#pilihan-d').val()) {
          toastr.error('Isi kolom jawaban pilihan D.')
          return false;
        }

      }
      else if ($('#jml_objektif').val() == 5) {
        
        if (!$('#pilihan-a').val()) {
          toastr.error('Isi kolom jawaban pilihan A.')
          return false;
        }
        else if (!$('#pilihan-b').val()) {
          toastr.error('Isi kolom jawaban pilihan B.')
          return false;
        }
        else if (!$('#pilihan-c').val()) {
          toastr.error('Isi kolom jawaban pilihan C.')
          return false;
        }
        else if (!$('#pilihan-d').val()) {
          toastr.error('Isi kolom jawaban pilihan D.')
          return false;
        }
        else if (!$('#pilihan-e').val()) {
          toastr.error('Isi kolom jawaban pilihan E.')
          return false;
        }

      }
      
      if (!$('input[name="cb[]"]:checked').length > 0) {
        toastr.error('Tandai jawaban objektif yang benar.')
        return false;
      }
      
      // if (!$('#modal_objektif .pembahasan').val()) {
      //   toastr.error('Isi kolom pembahasan.')
      //   return false;
      // }
    })

    // validasi modal jawaban subjektif_penjodohan
    $('.validasi_subjektif_penjodohan').click(function() {

      $("#jml_objektif").val('');
      $("input:radio[name=radioJawaban]").val('');
      $("#pilihan-a").val(''); $("#pilihan-b").val(''); $("#pilihan-c").val(''); $("#pilihan-d").val(''); $("#pilihan-e").val('');
      $("#cb-a").val(''); $("#cb-b").val(''); $("#cb-c").val(''); $("#cb-d").val(''); $("#cb-e").val('');
      
      if (!$('#summernote-jawaban').val()) {
        toastr.error('Input jawaban terlebih dahulu.')
        return false;
      }
      
      // if (!$('#modal_subjektif_penjodohan .pembahasan').val()) {
      //   toastr.error('Isi kolom pembahasan.')
      //   return false;
      // }
    })

    // validasi modal jawaban truefalse
    $('.validasi_truefalse').click(function() {

      $("#jml_objektif").val('');
      $("#summernote-jawaban").val('');
      $("#pilihan-a").val(''); $("#pilihan-b").val(''); $("#pilihan-c").val(''); $("#pilihan-d").val(''); $("#pilihan-e").val('');
      $("#cb-a").val(''); $("#cb-b").val(''); $("#cb-c").val(''); $("#cb-d").val(''); $("#cb-e").val('');
      
      if (!$('input:radio[name=radioJawaban]').is(':checked')) {
        toastr.error('Input opsi jawaban benar/salah.')
        return false;
      }
      
      // if (!$('#modal_true_false .pembahasan').val()) {
      //   toastr.error('Isi kolom pembahasan.')
      //   return false;
      // }
    })
      
  });

  // custom summernote & img datatables
  $(document).ready(function () {
    $(".media_tabel img").addClass("img-responsive");
    $(".media_tabel iframe").addClass("embed-responsive-item");
    $(".media_tabel img").css("max-height", "150px");
    $(".media_tabel img").css("width", "auto");
    $(".media_tabel iframe").css("max-height", "150px");
    $(".media_tabel iframe").css("width", "auto");
    $("ol").css("padding-left", "1.2em");
    $("ol").css("text-align", "justify");
    
    
    $('#summernote-soal').summernote({
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
        height: 150,
        placeholder: 'Masukkan soal disini',
        maximumImageFileSize: 1048576,
        toolbar: [
          ['insert', ['link', 'picture', 'video']],
          ['style', ['bold', 'italic', 'underline']],
          ['font', ['superscript', 'subscript']],
          ['para', ['ul', 'ol']],
          ['view',['codeview']],
        ]
    });

    $('#summernote-jawaban').summernote({
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
        height: 200,
        placeholder: 'Masukkan jawaban disini',
        maximumImageFileSize: 1048576,
        toolbar: [
          ['insert', ['link', 'picture', 'video']],
          ['style', ['bold', 'italic', 'underline']],
          ['font', ['superscript', 'subscript']],
          ['para', ['ul', 'ol']],
        ]
    });

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

    $('.pembahasan').summernote({
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
        height: 150,
        placeholder: 'Jelaskan pembahasan dari soal yang kamu buat!',
        maximumImageFileSize: 1048576,
        toolbar: [
          ['insert', ['link', 'picture', 'video']],
          ['style', ['bold', 'italic', 'underline']],
          ['font', ['superscript', 'subscript']],
          ['para', ['ul', 'ol']],
          ['view',['codeview']],
        ]
    });

    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })
    })
  });
</script>

<!-- Custom Datatable -->
<script>
  $(function () {
    $('#collapseTwo').on('shown.bs.collapse', function(e){
      $('#example2').DataTable()
          .columns.adjust()
          .responsive.recalc();
    });
    $('#collapseThree').on('shown.bs.collapse', function(e){
      $('#example3').DataTable()
          .columns.adjust()
          .responsive.recalc();
    });
    $('#collapseFour').on('shown.bs.collapse', function(e){
      $('#example4').DataTable()
          .columns.adjust()
          .responsive.recalc();
    });

    $("#example1").DataTable({
      "paging": true,
      // "info": true,
      "responsive": true, 
      // "lengthChange": false, 
      "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
      // "buttons": [
      //   { extend: 'excel', className: 'btn bg-purple' },
      //   { extend: 'pdf', className: 'bg-purple' },
      //   { extend: 'print', className: 'bg-purple' },
      //   { extend: 'colvis', className: 'btn-info', text: 'Pilih Kolom' },
      // ],
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
  });

</script>

<!-- Validate Checkbox Jawaban Pilihan Ganda -->
<script type="text/javascript">
  
  // if at least one checkbox in selected checkboxes is checked then disable target checkboxes
  function cbFunction(){
    // var oldvalue = id.getAttribute("prevvalue");
    // alert('id : '+id);

    if($("#cb-a").is(':checked')){
        // alert('value : '+$("#cb-a").val());
        $("#cb-b").prop('disabled', true);
        $("#cb-c").prop('disabled', true);
        $("#cb-d").prop('disabled', true);
        $("#cb-e").prop('disabled', true);
    } 
    else if($("#cb-b").is(':checked')){
        $("#cb-a").prop('disabled', true);
        $("#cb-c").prop('disabled', true);
        $("#cb-d").prop('disabled', true);
        $("#cb-e").prop('disabled', true);
    }  
    else if($("#cb-c").is(':checked')){
        $("#cb-b").prop('disabled', true);
        $("#cb-a").prop('disabled', true);
        $("#cb-d").prop('disabled', true);
        $("#cb-e").prop('disabled', true);
    }  
    else if($("#cb-d").is(':checked')){
        $("#cb-a").prop('disabled', true);
        $("#cb-b").prop('disabled', true);
        $("#cb-c").prop('disabled', true);
        $("#cb-e").prop('disabled', true);
    }   
    else if($("#cb-e").is(':checked')){
        $("#cb-a").prop('disabled', true);
        $("#cb-b").prop('disabled', true);
        $("#cb-c").prop('disabled', true);
        $("#cb-d").prop('disabled', true);
    }   
    else if(!$("#cb-a").is(':checked') && !$("#cb-b").is(':checked') || !$("#cb-c").is(':checked') || !$("#cb-d").is(':checked') || !$("#cb-e").is(':checked')){
        $("#cb-a").prop('disabled', false);
        $("#cb-b").prop('disabled', false);
        $("#cb-c").prop('disabled', false);
        $("#cb-d").prop('disabled', false);
        $("#cb-e").prop('disabled', false);
    } 
  }

</script>

@endsection