@extends('AdminLTE.app')

@section('js-start')

  
@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">
    
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
            <form method="POST" action="{{ route('bank_soals.update',$id) }}" enctype="multipart/form-data">
              @csrf
              @method('PATCH')
                  
              <!-- form input -->
              <div class="row">

                <!-- Tipe Soal -->
                <div class="form-group col-12 col-md-6">
                  @foreach($soal as $s)
                    <input type="hidden" name="tipe" value="{{$s->tipe_soal}}">
                    <!-- <label for="tipe">{{$s->tipe_soal}}</label> -->
                  @endforeach
                  <label for="tipe">Tipe Soal</label>
                  <select id="tipe" name="tipe" value="{{ old('tipe') }}" class="form-control select2 @error('tipe') is-invalid @enderror" disabled>
                      @php ($list_tipe = ['objektif','subjektif','penjodohan','true-false'])
                      @foreach($list_tipe as $select_tipe)
                      @foreach($soal as $s)
                          <option {{"$s->tipe_soal"=="$select_tipe" ? "selected" : ""}} value="{{$select_tipe}}" >{{ucfirst($select_tipe)}}</option>
                      @endforeach
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
                      @foreach($kelas as $kls)
                          <option {{"$kls->id"=="$select_kelas->id" ? "selected" : ""}} value="{{$select_kelas->id}}">{{$select_kelas->kelas.' '.$select_kelas->tingkat.'/sederajat'}}</option>
                      @endforeach
                      @endforeach
                  </select>

                  @error('kelas')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror

                </div>

                <!-- Mata Pelajaran/Program -->
                <div class="form-group col-12 col-md-6">

                  <label for="mapel">Mata Pelajaran/Program</label>
                  <select id="mapel" name="mapel" class="form-control select2 @error('mapel') is-invalid @enderror">
                      <option value="" selected disabled>Pilih Mapel/Program</option>
                      @foreach($list_program_mapels as $select_program_mapel)
                      @foreach($program_mapels as $pm)
                      @if($select_program_mapel->materi)
                      @php($spesial=ucwords($select_program_mapel->nama).' - '.ucwords($select_program_mapel->materi))
                      @else
                      @php($spesial=ucwords($select_program_mapel->nama))
                      @endif
                          <option {{"$pm->id"=="$select_program_mapel->id" ? "selected" : ""}} value="{{$select_program_mapel->id}}">{{$spesial}}</option>
                      @endforeach
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
                  @php($jml=0)
                  @foreach($jawaban as $jwb)
                    @if($jwb->jawaban != '0')
                      @php($jml++)
                    @endif
                  @endforeach
                  <label for="jml_objektif">Banyak Jawaban</label>
                  
                  <input id="jml_objektif" name="jml_objektif" type="number" max="5" min="3" class="form-control @error('jml_objektif') is-invalid @enderror" placeholder="3" value="{{ old('jml_objektif',$jml)}}" disabled>
                  
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
                  @foreach($soal as $s)
                    <textarea id="summernote-soal" name="summernote-soal" class="form-control @error('summernote-soal') is-invalid @enderror">{{ old('summernote-soal',$s->soal) }}</textarea>
                  @endforeach
                  
                  @error('summernote-soal')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
              </div>

              <!-- button  -->
              <div class="row">
                <div class="form-group col-12 col-md-12">
                  <button id="modal_jawaban" type="button" class="btn bg-purple btn-block shadow-sm" data-toggle="modal" data-target="#modal-xl">
                    <i class="fas fa-pencil-alt"></i> Edit Jawaban
                  </button>
                </div>
              </div>
              
          
              <!-- Modal Objektif -->
              <div class="modal fade" id="modal_objektif">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Jawaban Soal Objektif</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">

                        <!-- Tipe Soal Objektif -->
                        <div id="objektif" class="form-group col-12 col-md-12">
                        
                          <div class="row">
                            @if(count($jawaban) > 1)
                            <!-- Pilihan A -->
                            <div id="div-a" class="form-group col-12">
                              <!-- <label for="pilihan-a" class="col-form-label">{{ __('Pilihan A') }}</label> -->
                                <textarea id="pilihan-a" class="form-control @error('pilihan-a') is-invalid @enderror pilihan" name="jawaban_pilihan[]" placeholder="Masukkan pilihan A">{{ old('jawaban_pilihan.0',$jawaban[0]['jawaban']) }}</textarea>

                              @error('pilihan-a')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                              <input type="hidden" name="cb[]" value="0">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" prevvalue="{{old('cb.1')}}" id="cb-a" name="cb[]" value="1" {{old('cb.1',$jawaban[0]['status']) =="1" ? "checked" : ""}} class="form-control @error('cb') is-invalid @enderror" onclick="cbFunction();">
                                <label for="cb-a">Pilih jika <span class="badge badge-danger">opsi A</span> adalah jawaban yang benar</label>
                              </div>

                            </div>

                            <!-- Pilihan B -->
                            <div id="div-b" class="form-group col-12 mt-4">
                                <textarea id="pilihan-b" class="form-control @error('pilihan-b') is-invalid @enderror pilihan" name="jawaban_pilihan[]" placeholder="Masukkan pilihan B">{{ old('jawaban_pilihan.1',$jawaban[1]['jawaban']) }}</textarea>
                        
                              @error('pilihan-b')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                              <input type="hidden" name="cb[]" value="0">
                              <div class="icheck-success d-inline">
                                  <input type="checkbox" prevvalue="{{old('cb.2')}}" id="cb-b" name="cb[]" value="1" {{old('cb.2',$jawaban[1]['status'])=="1" ? "checked" : ""}} class="form-control @error('cb') is-invalid @enderror" onclick="cbFunction()">
                                <label for="cb-b">Pilih jika <span class="badge badge-danger">opsi B</span> adalah jawaban yang benar</label>
                              </div>

                            </div>

                            <!-- Pilihan C -->
                            <div id="div-c" class="form-group col-12 mt-4">
                                <textarea id="pilihan-c" class="form-control @error('pilihan-c') is-invalid @enderror pilihan" name="jawaban_pilihan[]" placeholder="Masukkan pilihan C">{{ old('jawaban_pilihan.2',$jawaban[2]['jawaban']) }}</textarea>
                        
                              @error('pilihan-c')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                              <input type="hidden" name="cb[]" value="0">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" prevvalue="{{old('cb.3')}}" id="cb-c" name="cb[]" value="1" {{old('cb.3',$jawaban[2]['status']) =="1" ? "checked" : ""}} class="form-control @error('cb') is-invalid @enderror" onclick="cbFunction()">
                                <label for="cb-c">Pilih jika <span class="badge badge-danger">opsi C</span> adalah jawaban yang benar</label>
                              </div>

                            </div>

                            <!-- Pilihan D -->
                            <div id="div-d" class="form-group col-12 mt-4" hidden>
                                @php($cek_jawab = '')
                                @if ($jawaban[3]['jawaban'] != '0')
                                  @php($cek_jawab = $jawaban[3]['jawaban'])
                                @endif
                                <textarea id="pilihan-d" class="form-control @error('pilihan-d') is-invalid @enderror pilihan" name="jawaban_pilihan[]" placeholder="Masukkan pilihan D">{{ old('jawaban_pilihan.3',$cek_jawab) }}</textarea>
                              
                              @error('pilihan-d')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                              <input type="hidden" name="cb[]" value="0">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" prevvalue="{{old('cb.4')}}" id="cb-d" name="cb[]" value="1" {{old('cb.4',$jawaban[3]['status']) =="1" ? "checked" : ""}} class="form-control @error('cb') is-invalid @enderror" onclick="cbFunction()">
                                <label for="cb-d">Pilih jika <span class="badge badge-danger">opsi D</span> adalah jawaban yang benar</label>
                              </div>

                            </div>

                            <!-- Pilihan E -->
                            <div id="div-e" class="form-group col-12 mt-4" hidden>
                                @php($cek_jawab = '')
                                @if ($jawaban[4]['jawaban'] != '0')
                                  @php($cek_jawab = $jawaban[4]['jawaban'])
                                @endif
                                <textarea id="pilihan-e" class="form-control @error('pilihan-e') is-invalid @enderror pilihan" name="jawaban_pilihan[]" placeholder="Masukkan pilihan E">{{ old('jawaban_pilihan.4',$cek_jawab) }}</textarea>
                        
                              @error('pilihan-e')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                              <input type="hidden" name="cb[]" value="0">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" prevvalue="{{old('cb.5')}}" id="cb-e" name="cb[]" value="1" {{old('cb.5',$jawaban[4]['status']) =="1" ? "checked" : ""}} class="form-control @error('cb') is-invalid @enderror" onclick="cbFunction()">
                                <label for="cb-e">Pilih jika <span class="badge badge-danger">opsi E</span> adalah jawaban yang benar</label>
                              </div>

                            </div>
                            @endif

                            <!-- Pembahasan -->
                            <div class="form-group col-12 mb-0 mt-4">
                              <hr>
                              <label for="pembahasan">Pembahasan</label>
                              @foreach($soal as $s)
                                <textarea name="pembahasan_objektif" class="form-control @error('pembahasan') is-invalid @enderror pembahasan">{{ old('pembahasan',$s->pembahasan) }}</textarea>
                              @endforeach
                            </div>

                          </div>

                        </div>

                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button> -->
                      <button id="submit" type="submit" class="btn btn-block my-2 shadow-sm bg-purple validasi_objektif">Simpan Data</button>
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
                      <h4 class="modal-title">Edit Jawaban</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">

                        <!-- Tipe Soal Subjektif / Penjodohan -->
                        <div id="subjektif_penjodohan" class="form-group col-12 col-md-12">
                          <label for="summernote-jawaban">Jawaban</label>
                          @foreach($soal as $s)
                            <textarea id="summernote-jawaban" name="summernote-jawaban" class="form-control @error('summernote-jawaban') is-invalid @enderror">{{ old('summernote-jawaban',$s->jawaban) }}</textarea>
                          @endforeach
                          
                          @error('summernote-jawaban')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>

                        <!-- Pembahasan -->
                        <div class="form-group col-12 mb-0 mt-4">
                          <hr>
                          <label for="pembahasan">Pembahasan</label>
                          @foreach($soal as $s)
                            <textarea name="pembahasan_subjektif_penjodohan" class="form-control @error('pembahasan') is-invalid @enderror pembahasan">{{ old('pembahasan',$s->pembahasan) }}</textarea>
                          @endforeach

                        </div>

                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button id="submit" type="submit" class="btn btn-block my-2 shadow-sm bg-purple validasi_subjektif_penjodohan">Simpan Data</button>
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
                      <h4 class="modal-title">Edit Jawaban Soal True-false</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row">

                        <!-- Tipe Soal True False -->
                        <div id="true-false" class="form-group col-12 mb-0">
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
                                  @foreach($soal as $s)
                                    <input type="radio" name="radioJawaban" id="radioTrue" value="1" {{old('radioJawaban',$s->jawaban) =="1" ? "checked" : ""}} class="form-control @error('radioJawaban') is-invalid @enderror">
                                    <label for="radioTrue">Benar</label>
                                  @endforeach
                                </div>
                              </div>
                            </div>

                            <div class="col-sm-12">
                              <div class="form-group clearfix">
                                <div class="icheck-danger d-inline">
                                  @foreach($soal as $s)
                                    <input type="radio" name="radioJawaban" id="radioFalse" value="0" {{old('radioJawaban',$s->jawaban) =="0" ? "checked" : ""}} class="form-control @error('radioJawaban') is-invalid @enderror">
                                    <label for="radioFalse">Salah</label>
                                  @endforeach
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
                        <div class="form-group col-12 mb-0 mt-1">
                          <hr>
                          <label for="pembahasan">Pembahasan</label>
                          @foreach($soal as $s)
                            <textarea name="pembahasan_true_false" class="form-control @error('pembahasan') is-invalid @enderror pembahasan">{{ old('pembahasan',$s->pembahasan) }}</textarea>
                          @endforeach
                        </div>

                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button id="submit" type="submit" class="btn btn-block my-2 shadow-sm bg-purple validasi_truefalse">Simpan Data</button>
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

  </div>


</section>
<!-- /.content -->
@endsection

@section('js-end')

<!-- Expand & Collapse Card || Custom Summernote || Form Validate -->
<script type="text/javascript">

  // toogle button for expand and collapse change icon
  // $('.btn-tool').click(function() {
  //     $(this).find('i').toggleClass('fas fa-plus fas fa-minus');
  // });


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


  // validasi input form
  $(document).ready(function() {
    const bobot = document.getElementById("bobot");
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
      
      // if at least one checkbox in selected checkboxes is checked then disable target checkboxes
      if($("#cb-a").is(':checked')){
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
      
      // if (!$('#modal_subjektif_penjodohan .pembahasan').val()) {
      //   toastr.error('Isi kolom pembahasan.')
      //   return false;
      // }
    })
      
  });

  // custom summernote & img datatables
  $(document).ready(function () {
    $("#media_tabel img").addClass("img-responsive");
    $("#media_tabel iframe").addClass("embed-responsive-item");
    $("#media_tabel img").css("max-width", "90%");
    $("#media_tabel iframe").css("max-width", "90%");
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
      "buttons": [
        { extend: 'excel', className: 'btn btn-success' },
        { extend: 'pdf', className: 'btn-success' },
        { extend: 'print', className: 'btn-success' },
        { extend: 'colvis', className: 'btn-info', text: 'Pilih Kolom' },
      ],
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  
    $("#example2").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "buttons": [
        { extend: 'excel', className: 'btn btn-success' },
        { extend: 'pdf', className: 'btn-success' },
        { extend: 'print', className: 'btn-success' },
        { extend: 'colvis', className: 'btn-info', text: 'Pilih Kolom' },
      ],
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  
    $("#example3").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "buttons": [
        { extend: 'excel', className: 'btn btn-success' },
        { extend: 'pdf', className: 'btn-success' },
        { extend: 'print', className: 'btn-success' },
        { extend: 'colvis', className: 'btn-info', text: 'Pilih Kolom' },
      ],
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
  
    $("#example4").DataTable({
      "paging": true,
      "responsive": true, 
      "autoWidth": false,
      "buttons": [
        { extend: 'excel', className: 'btn btn-success' },
        { extend: 'pdf', className: 'btn-success' },
        { extend: 'print', className: 'btn-success' },
        { extend: 'colvis', className: 'btn-info', text: 'Pilih Kolom' },
      ],
      "pageLength": 5,
      "scrollCollapse": true
    }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
  });

</script>

<!-- Validate Checkbox Jawaban Pilihan Ganda -->
<script type="text/javascript">
  $(document).ready(function() {   //same as: $(function() { 
      // if at least one checkbox in selected checkboxes is checked then disable target checkboxes
    if($("#cb-a").is(':checked')){
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
  
  // if at least one checkbox in selected checkboxes is checked then disable target checkboxes
  function cbFunction(){
    // var oldvalue = id.getAttribute("prevvalue");

    if($("#cb-a").is(':checked')){
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