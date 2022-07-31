@extends('AdminLTE.app')

@section('js-start')

@endsection

@section('content')
<!-- Main content -->
<section class="content">

  <div class="container-fluid">

    <!-- Info update mapel -->
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

    <div class="row">
      @if (Auth::user()->hasRole('guru'))
      <div class="col-7">
      @else
      <div class="col-12">
      @endif
        <form class="form-horizontal" method="POST" action="{{ route('profile.update',$id) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')

          <div class="card">

            <div class="card-header">
              <h3 class="card-title"><b>{{'Data Diri'}}</b></h3>

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

            <div class="card-body box-profile">
              @if (Auth::user()->hasRole('siswa'))
                @foreach($user_siswas as $user_siswa)
                  <input type="hidden" id="fp" value="{{$user_siswa->foto}}">

                  <!-- Profile Image -->
                  <div class="text-center">
                    @if($user_siswa->foto!=NULL)
                      <img id="output" style="width:150px;" src="{{ '/'.$user_siswa->foto }}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                    @else
                      <img id="output" style="width:150px;" src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                    @endif
                  </div>
                    
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="form-group row mt-4 mb-5">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="img_profile" name="img_profile" accept="image/*" required>
                            <label class="custom-file-label" for="img_profile">Pilih foto</label>
                          </div>
                        </div>
                        
                        @error('img_profile')
                            <span class="text-danger" role="alert">
                                <small><strong>{{ $message }}<strong></small>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-4"></div>
                  </div>
                    
                  <div class="form-group row mb-0">
                    
                    <!-- nama -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Siswa</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user_siswa->name)}}" required autocomplete="name" autofocus placeholder="Siapa nama kamu?">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>

                    <!-- NISN -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>NISN <small>(Nomor Induk Siswa Nasional</small></label>
                        <input id="nisn" type="number" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value="{{ old('nisn', $user_siswa->nisn) }}" required autocomplete="nisn" autofocus placeholder="Berapa NISN mu?">

                        @error('nisn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <!-- /.form-group -->
                    </div>
                    
                    <!-- jenis kelamin -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select id="jenis_kelamin" class="form-control select2 @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required autofocus>
                          @php ($list_jk = ['laki-laki','perempuan'])
                          <option value="" selected disabled>Gender kamu apa?</option>
                          @foreach($list_jk as $select_jk)
                              <option {{old('jenis_kelamin', $user_siswa->jenis_kelamin) =="$select_jk" ? "selected" : ""}} value="{{$select_jk}}">{{ucwords($select_jk)}}</option>
                          @endforeach

                          @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </select>
                      </div>
                      <!-- /.form-group -->
                    </div>
                    
                    <!-- Tgl Lahir -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input id="tanggal_lahir" name="tanggal_lahir" type="text" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ old('tanggal_lahir', $user_siswa->tanggal_lahir) }}" required placeholder="Lahirnya tanggal berapa?" data-target="#reservationdate" data-toggle="datetimepicker" autocomplete="off"/>
                        </div>

                        @error('tanggal_lahir')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                      <!-- /.form-group -->

                    </div>

                    <!-- Nomor Telpon -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nomor Telpon</label>
                        <input id="no_telp" type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp', $user_siswa->no_telp) }}" required autocomplete="no_telp" autofocus placeholder="Berapa nomor whatsapp mu?">

                        @error('no_telp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>

                    <!-- Kelas -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Kelas</label>
                        <select id="kelas" class="form-control select2 @error('kelas') is-invalid @enderror" name="kelas" required autofocus>
                          <option value="" selected disabled>Kamu kelas berapa ya?</option>
                          @foreach($list_kelas as $select_kelas)
                              <option {{old('kelas', $user_siswa->master_kelas_id) =="$select_kelas->id" ? "selected" : ""}} value="{{$select_kelas->id}}">
                                @if($select_kelas->jurusan==NULL)
                                    {{$select_kelas->kelas.' '.$select_kelas->tingkat}}
                                @else
                                    {{$select_kelas->kelas.' '.$select_kelas->tingkat.' - '.$select_kelas->jurusan}}
                                @endif
                              </option>
                          @endforeach

                          @error('kelas')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </select>
                      </div>
                      <!-- /.form-group -->

                    </div>

                    <!-- Nama Wali -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Nama Wali Siswa</label>
                        <input id="nama_wali" type="text" class="form-control @error('nama_wali') is-invalid @enderror" name="nama_wali" value="{{ old('nama_wali', $user_siswa->nama_wali) }}" required autocomplete="nama_wali" autofocus placeholder="Siapa nama wali kamu?">

                        @error('nama_wali')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    </div>

                    <!-- No telp Wali -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Telpon Wali Siswa <small>(yang terdaftar Whatsapp)</small></label>
                        <input id="telp_wali" type="number" class="form-control @error('telp_wali') is-invalid @enderror" name="telp_wali" value="{{ old('telp_wali', $user_siswa->telp_wali) }}" required autocomplete="telp_wali" autofocus placeholder="Nomor telponnya berapa?">

                        @error('telp_wali')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <!-- /.form-group -->
                    </div>
                    
                  </div>
                  
                  <div class="form-group row mt-4">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-block bg-purple">Simpan Data</button>
                    </div>
                  </div>

                @endforeach
              
              @elseif (Auth::user()->hasRole('guru'))

                <!-- user guru ga pake foreach biar ga tampil ulang2 card profilnya, sesuai tabel user_gurus -->
                <input type="hidden" id="fp" value="{{$user_guru->foto}}">

                <!-- Profile Image -->
                <div class="text-center">
                  @if($user_guru->foto!=NULL)
                    <img id="output" style="width:150px;" src="{{ '/'.$user_guru->foto }}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                  @else
                    <img id="output" style="width:150px;" src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                  @endif
                </div>
                  
                <div class="row">
                  <div class="col-md-4"></div>
                  <div class="col-md-4">
                    <div class="form-group row mt-4 mb-5">
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="img_profile" name="img_profile" accept="image/*" required>
                          <label class="custom-file-label" for="img_profile">Pilih foto</label>
                        </div>
                      </div>
                      
                      @error('img_profile')
                          <span class="text-danger" role="alert">
                              <small><strong>{{ $message }}<strong></small>
                          </span>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-4"></div>
                </div>

                <div class="form-group row mb-0">
                  
                  <!-- nama -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Guru</label>
                      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user_guru->name)}}" required autocomplete="name" autofocus placeholder="Siapa nama kamu?">

                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>

                  <!-- NUPTK -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>NUPTK <small>(Nomor Unik Pendidik dan Tenaga Kependidikan)</small></label>
                      <input id="nuptk" type="number" class="form-control @error('nuptk') is-invalid @enderror" name="nuptk" value="{{ old('nuptk', $user_guru->nuptk) }}" required autocomplete="nuptk" autofocus placeholder="Berapa nuptk mu?">

                      @error('nuptk')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                  
                  <!-- jenis kelamin -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Jenis Kelamin</label>
                      <select id="jenis_kelamin" class="form-control select2 @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required autofocus>
                        @php ($list_jk = ['laki-laki','perempuan'])
                        <option value="" selected disabled>Gender kamu apa?</option>
                        @foreach($list_jk as $select_jk)
                            <option {{old('jenis_kelamin', $user_guru->jenis_kelamin) =="$select_jk" ? "selected" : ""}} value="{{$select_jk}}">{{ucwords($select_jk)}}</option>
                        @endforeach

                        @error('jenis_kelamin')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </select>
                    </div>
                  </div>
                  
                  <!-- Spesialisasi -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Spesialisasi</label>
                      <select id="spesialisasi" name="spesialisasi[]" value="{{ old('spesialisasi[]') }}" class="select2 form-control @error('spesialisasi') is-invalid @enderror" multiple required disabled>
                        @foreach($list_spesialisasi as $select_spesialisasi)
                        @if($select_spesialisasi->materi)
                        @php($spesial=ucwords($select_spesialisasi->nama).' - '.ucwords($select_spesialisasi->materi))
                        @else
                        @php($spesial=ucwords($select_spesialisasi->nama))
                        @endif
                            <option {{old('spesialisasi[]') =="$select_spesialisasi->id" || in_array($select_spesialisasi->id, $selectedSpesialisasi) ? "selected" : ""}} value="{{$select_spesialisasi->id}}">
                                {{$spesial}}
                            </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  
                  <!-- Tgl Lahir -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal Lahir</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input id="tanggal_lahir" name="tanggal_lahir" type="text" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ old('tanggal_lahir', $user_guru->tanggal_lahir) }}" required placeholder="Lahirnya tanggal berapa?" data-target="#reservationdate" data-toggle="datetimepicker" autocomplete="off"/>
                      </div>

                      @error('tanggal_lahir')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                  
                  <!-- No Telp -->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nomor Telpon</label>
                      <input id="no_telp" type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp', $user_guru->no_telp) }}" required autocomplete="no_telp" autofocus placeholder="Berapa nomor whatsapp mu?">

                      @error('no_telp')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="form-group row mt-4">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-block bg-purple">Simpan Data</button>
                  </div>
                </div>

              
              @elseif (Auth::user()->hasRole('adm_instansi'))
                @foreach($user_admin_instansis as $user_admin_instansi)
                  <input type="hidden" id="fp" value="{{$user_admin_instansi->foto}}">

                  <!-- Profile Image -->
                  <div class="text-center">
                    @if($user_admin_instansi->foto!=NULL)
                      <img id="output" style="width:150px;" src="{{ '/'.$user_admin_instansi->foto }}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                    @else
                      <img id="output" style="width:150px;" src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                    @endif
                  </div>
                    
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                      <div class="form-group row mt-4 mb-5">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="img_profile" name="img_profile" accept="image/*" required>
                            <label class="custom-file-label" for="img_profile">Pilih foto</label>
                          </div>
                        </div>
                        
                        @error('img_profile')
                            <span class="text-danger" role="alert">
                                <small><strong>{{ $message }}<strong></small></strong>
                            </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-4"></div>
                  </div>

                  @if($user_admin_instansi->tipe=='sekolah')
                    @php($tipe='Sekolah')
                    @php($nomor_induk='npsn')
                  @elseif($user_admin_instansi->tipe=='lembaga_kursus')
                    @php($tipe='Lembaga Kursus')
                    @php($nomor_induk='nilek')
                  @endif

                  <div class="form-group row mb-0">
                    
                    <div class="col-md-6">

                      <!-- nama -->
                      <div class="form-group">
                        <label>Nama Admin {{$tipe}}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user_admin_instansi->name)}}" required autocomplete="name" autofocus placeholder="Siapa nama kamu?">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <!-- Tgl Lahir -->
                      <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input id="tanggal_lahir" name="tanggal_lahir" type="text" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ old('tanggal_lahir', $user_admin_instansi->tanggal_lahir) }}" required placeholder="Lahirnya tanggal berapa?" data-target="#reservationdate" data-toggle="datetimepicker" autocomplete="off"/>
                        </div>

                        @error('tanggal_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    
                    </div>
                    
                    <div class="col-md-6">

                      <!-- jenis kelamin -->
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select id="jenis_kelamin" class="form-control select2 @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required autofocus>
                          @php ($list_jk = ['laki-laki','perempuan'])
                          <option value="" selected disabled>Gender kamu apa?</option>
                          @foreach($list_jk as $select_jk)
                              <option {{old('jenis_kelamin', $user_admin_instansi->jenis_kelamin) =="$select_jk" ? "selected" : ""}} value="{{$select_jk}}">{{ucwords($select_jk)}}</option>
                          @endforeach

                          @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </select>
                      </div>

                      <!-- NIK -->
                      <div class="form-group">
                        <label>NIK <small>(Nomor Induk Kependudukan)</small></label>
                        <input id="nik" type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik', $user_admin_instansi->nik) }}" required autocomplete="nik" autofocus placeholder="Berapa nik mu?">

                        @error('nik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    
                    </div>

                  </div>
                  
                  <div class="form-group row mt-4">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-block bg-purple">Simpan Data</button>
                    </div>
                  </div>

                @endforeach

              @elseif (Auth::user()->hasRole('adm_sistem'))
                @foreach($user_admins as $user_admin)
                  <input type="hidden" id="fp" value="{{$user_admin->foto}}">

                  <div class="form-group row mb-0">
                    <div class="col-md-4">

                      <!-- Profile Image -->
                      <div class="text-center">
                        @if($user_admin->foto!=NULL)
                          <img id="output" style="width:150px;" src="{{ '/'.$user_admin->foto }}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                        @else
                          <img id="output" style="width:150px;" src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class="profile-user-img img-fluid img-circle" alt="User profile picture">
                        @endif
                      </div>
                    
                      <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                          <div class="form-group row mt-4 mb-5">
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="img_profile" name="img_profile" accept="image/*" required>
                                <label class="custom-file-label" for="img_profile">Pilih foto</label>
                              </div>
                            </div>
                        
                            @error('img_profile')
                                <span class="text-danger" role="alert">
                                    <small><strong>{{ $message }}<strong></small>
                                </span>
                            @enderror
                          </div>
                        </div>
                        <div class="col-md-4"></div>
                      </div>

                    </div>

                    <div class="col-md-8">

                      <!-- nama -->
                      <div class="form-group">
                        <label>Nama Admin</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user_admin->name)}}" required autocomplete="name" autofocus placeholder="Siapa nama kamu?">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>

                      <!-- Tgl Lahir -->
                      <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                          <input id="tanggal_lahir" name="tanggal_lahir" type="text" class="form-control datetimepicker-input" data-target="#reservationdate" value="{{ old('tanggal_lahir', $user_admin->tanggal_lahir) }}" required placeholder="Lahirnya tanggal berapa?" data-target="#reservationdate" data-toggle="datetimepicker" autocomplete="off"/>
                        </div>

                        @error('tanggal_lahir')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>

                      <!-- jenis kelamin -->
                      <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select id="jenis_kelamin" class="form-control select2 @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" required autofocus>
                          @php ($list_jk = ['laki-laki','perempuan'])
                          <option value="" selected disabled>Gender kamu apa?</option>
                          @foreach($list_jk as $select_jk)
                              <option {{old('jenis_kelamin', $user_admin->jenis_kelamin) =="$select_jk" ? "selected" : ""}} value="{{$select_jk}}">{{ucwords($select_jk)}}</option>
                          @endforeach

                          @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </select>
                      </div>

                    </div>

                  </div>
                  
                  <div class="form-group row mt-4">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-block bg-purple">Simpan Data</button>
                    </div>
                  </div>

                @endforeach
              
              @endif
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </form>
          
      </div>
      <!-- /.col -->

      @if (Auth::user()->hasRole('guru'))
      <div class="col-5">
        
        
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><b>{{'Penilaian'}}</b></h3>

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
            <div class="text-center">
              <img style="width:40px;" src="{{asset('img/star-select.png')}}">
              <h5 class="mt-2"><b>Poin {{$poin}}/5</b></h5>
            </div>

            <table id="example1" class="table table-hover table-valign-middle" style="table-layout: fixed">
              <thead style="display: none;">
                <tr>
                  <th>Foto</th>
                </tr>
              </thead>
              <tbody>
                @foreach($ratings as $rating)
                <tr>
                  <td>
                    <div class="row">
                      <div class="col-1 mr-3"> 
                        @if($rating->foto==null)
                          <img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class="img-circle" alt="User Image" style="max-width:40px"> 
                        @else
                          <img src="{{'/'.$rating->foto}}" class="img-circle" alt="User Image" style="max-width:40px"> 
                        @endif
                      </div> 
                      <div class="col-10"> 
                        <p style="line-height:15px;margin-bottom:2px;"><b>{{$rating->name}}</b>
                        @if($rating->angka==null)
                          <small>(Tidak ada penilaian.)</small>
                        @else
                          @for($i=0; $i<$rating->angka; $i++)
                            @if($i==0)<img class="ml-2" style="width:10px;" src="{{asset('img/star-select.png')}}">@endif
                            <img style="width:10px;" src="{{asset('img/star-select.png')}}">
                          @endfor
                        @endif<br></p>

                        @if($rating->komentar==null)
                          <small>(Tidak ada komentar.)</small>
                        @else
                          {{$rating->komentar}}
                        @endif
                      </div> 
                    </div>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->

        </div>
      </div>
      @endif

    </div>
    <!-- /.row -->

  </div>


</section>
<!-- /.content -->
@endsection

@section('js-end')

<script type="text/javascript">

  // Preview Foto
  function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#output').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
  }

  $("#img_profile").change(function(){
      readURL(this);
  });
  

  $(document).ready(function() {
    var bla = $('#fp').val();
    if( bla.length > 0 ) {
      $('#img_profile').prop('required',false);
    }

    $('.select2').select2({
      theme: 'bootstrap4',
    })

    
    $('#spesialisasi').select2({
      placeholder: 'Pilih Spesialisasi',
    })

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L',
        maxDate: new Date()
    });
    

  $("#example").DataTable({
    "dom": 'lrtip',
    "bLengthChange" : false,
    "bInfo":false, 
    "pagingType": 'simple',
    "paging": true,
    "responsive": true, 
    "autoWidth": false,
    "pageLength": 5,
    "scrollCollapse": true
  }).buttons().container().appendTo('#example_wrapper .col-md-6:eq(0)');
  });

  $("form").submit(function() {
      $("#spesialisasi").prop("disabled", false);
  });

  $("#example1").DataTable({
    "dom": 'lrtip',
    "bLengthChange" : false,
    "bInfo":false, 
    "pagingType": 'simple',
    "paging": true,
    "responsive": true, 
    "autoWidth": false,
    "pageLength": 5,
    "scrollCollapse": true
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>

@endsection