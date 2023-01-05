<aside class="main-sidebar sidebar-dark-purple elevation-2">
  
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{asset('AdminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-2" style="opacity: .8">
        <span class="brand-text font-weight-light"><strong>Adji | </strong> 1705551004</span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @foreach($foto_profil as $fp)
            @if($fp->foto!=NULL)
                <img src="{{ '/'.$fp->foto }}" class="img-circle elevation-2" alt="User Image">
            @else
              <img src="{{asset('AdminLTE/dist/img/default-150x150.png')}}" class="img-circle elevation-2" alt="User Image">
            @endif
          @endforeach
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name ?? 'Guest' }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        @if (Route::current()->getName()=='home.instansi'||Route::current()->getName()=='home.kelas.program'||Route::current()->getName()=='home.mapel')
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="{{ route('guest') }}" class="nav-link {{ Route::currentRouteNamed('guest') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('home.instansi') }}" class="nav-link {{ Route::currentRouteNamed('home.instansi') ? 'active' : '' }}">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Instansi Pendidikan
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('home.kelas.program') }}" class="nav-link {{ Route::currentRouteNamed('home.kelas.program') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Kelas/Program Kursus
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('home.mapel') }}" class="nav-link {{ Route::currentRouteNamed('home.mapel') ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Mata Pelajaran
              </p>
            </a>
          </li>

        </ul>
        
        @elseif (Auth::user()->hasRole('siswa'))
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li> -->
          
          <li class="nav-item">
            <a href="{{ route('guest') }}" class="nav-link {{ Route::currentRouteNamed('guest') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('list-instansi.index') }}" class="nav-link {{ Route::currentRouteNamed('list-instansi.index') || Route::currentRouteNamed('show.kelas_program') ? 'active' : '' }}">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Instansi Pendidikan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('list.kelas.program') }}" class="nav-link {{ Route::currentRouteNamed('list.kelas.program') || Route::currentRouteNamed('kelas-program.show') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Kelas & Program Kursus
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('ruang-ujian.index') }}" class="nav-link {{ Route::currentRouteNamed('ruang-ujian.index') || Route::currentRouteNamed('ruang-ujian.show') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Ruang Ujian
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Raport
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Pengumuman
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="{{ route('profile.index') }}" class="nav-link {{ Route::currentRouteNamed('profile.index') ? 'active' : '' }}">
              <i class="nav-icon nav-icon fas fa-user-cog"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
        </ul>

        @elseif (Auth::user()->hasRole('guru'))
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{ route('guest') }}" class="nav-link {{ Route::currentRouteNamed('guest') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="{{ route('list.kelas.program.guru') }}" class="nav-link {{ Route::currentRouteNamed('list.kelas.program.guru') || Route::currentRouteNamed('kelas-program.show') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>
                Kelas & Program Kursus
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li> -->

          <!-- <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Lembaga Pendidikan
              </p>
            </a>
          </li> -->
          
          
          <li class="nav-item">
            <a href="{{ route('list-instansi.index') }}" class="nav-link {{ Route::currentRouteNamed('list-instansi.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Lembaga Pendidikan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('bank_soals.index') }}" class="nav-link {{ Route::currentRouteNamed('bank_soals.index') || Route::currentRouteNamed('bank_soals.edit') ? 'active' : '' }}">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>Bank Soal</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('materi-pembelajaran.index') }}" class="nav-link {{ Route::currentRouteNamed('materi-pembelajaran.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-swatchbook"></i>
              <p>Materi Pembelajaran</p>
            </a>
          </li>

          <!-- <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Rombongan Belajar
              </p>
            </a>
          </li> -->

          <!-- <li class="nav-item">
            <a href="pages/gallery.html" class="nav-link">
              <i class="nav-icon fas fa-envelope-open-text"></i>
              <p>
                Riwayat Ujian
              </p>
            </a>
          </li> -->

          <li class="nav-item">
            <a href="{{ route('ruang-ujian.index') }}" class="nav-link {{ Route::currentRouteNamed('ruang-ujian.index') || Route::currentRouteNamed('ruang-ujian.show') || Route::currentRouteNamed('hasil.ujian') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tasks"></i>
              <p>Ruang Ujian</p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('profile.index') }}" class="nav-link {{ Route::currentRouteNamed('profile.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
        </ul>

        @elseif (Auth::user()->hasRole('adm_instansi'))
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!-- <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li> -->
          
          @foreach($user_admin_instansis as $user_admin_instansi)
            @if($user_admin_instansi->tipe=='sekolah')
              @php($tipe='Sekolah')
              @php($text='Kelas')
            @elseif($user_admin_instansi->tipe=='lembaga_kursus')
              @php($tipe='Lembaga Kursus')
              @php($text='Program Kursus')
            @endif
          @endforeach
          
          <li class="nav-item">
            <a href="{{ route('guest') }}" class="nav-link {{ Route::currentRouteNamed('guest') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('list-guru.index') }}" class="nav-link {{ Route::currentRouteNamed('list-guru.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>Data Guru</p>
            </a>
          </li>
            
          <li class="nav-item">
            <a href="{{ route('kelas-program.index') }}" class="nav-link {{ Route::currentRouteNamed('kelas-program.index') || Route::currentRouteNamed('kelas-program.show') ? 'active' : '' }}">
              <i class="nav-icon fas fa-chalkboard-teacher"></i>
              <p>Data {{$text}}</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('paket_soal.index') }}" class="nav-link {{ Route::currentRouteNamed('paket_soal.index') || Route::currentRouteNamed('paket_soal.show') ? 'active' : '' }}">
              <i class="nav-icon fas fa-folder-open"></i>
              <p>Paket Soal</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('ruang-ujian.index') }}" class="nav-link {{ Route::currentRouteNamed('ruang-ujian.index') || Route::currentRouteNamed('ruang-ujian.show') || Route::currentRouteNamed('hasil.ujian') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tasks"></i>
              <p>Ruang Ujian</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('nilai-ujian.index') }}" class="nav-link {{ Route::currentRouteNamed('nilai-ujian.index') || Route::currentRouteNamed('nilai-ujian.show') || Route::currentRouteNamed('nilai-ujian.store') ? 'active' : '' }}">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>Nilai Ujian</p>
            </a>
          </li>

          <!-- class menu-open untuk menunya kebuka isinya -->
          <li class="nav-item {{ Route::currentRouteNamed('profile.index') || Route::currentRouteNamed('instansi-pendidikan.index') ? 'menu-open' : ''  }}">
            <!-- class active untuk warna biru biar keliatan aktif -->
            <a href="#" class="nav-link {{ Route::currentRouteNamed('profile.index') || Route::currentRouteNamed('instansi-pendidikan.index') ? 'active' : '' }}">
              <i class="nav-icon nav-icon fas fa-user-cog"></i>
              <p>
                Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('profile.index') }}" class="nav-link {{ Route::currentRouteNamed('profile.index') ? 'active' : '' }}">
                  <i class=" far fa-circle nav-icon text-purple"></i>
                  <p>Data Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('instansi-pendidikan.index') }}" class="nav-link {{ Route::currentRouteNamed('instansi-pendidikan.index') ? 'active' : '' }}">
                  <i class=" far fa-circle nav-icon text-purple"></i>
                  <p>Data {{$tipe}}</p>
                </a>
              </li>
            </ul>
          </li>

          
        </ul>

        @elseif (Auth::user()->hasRole('adm_sistem'))
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{ route('guest') }}" class="nav-link {{ Route::currentRouteNamed('guest') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link {{ Route::currentRouteNamed('home') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li> -->

          <!-- <li class="nav-item">
            <a href="{{ route('verifikasi.index') }}" class="nav-link {{ Route::currentRouteNamed('verifikasi.index') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-clock"></i>
              <p>
                Verifikasi User
              </p>
            </a>
          </li> -->

          <li class="nav-item">
            <a href="{{ route('master-tahun-ajaran.index') }}" class="nav-link {{ Route::currentRouteNamed('master-tahun-ajaran.index') || Route::currentRouteNamed('master-tahun-ajaran.edit') ? 'active' : '' }}">
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                Master Tahun Ajaran
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('master-mapel.index') }}" class="nav-link {{ Route::currentRouteNamed('master-mapel.index') || Route::currentRouteNamed('master-mapel.edit') ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Master Mata Pelajaran
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('master-kelas.index') }}" class="nav-link {{ Route::currentRouteNamed('master-kelas.index') || Route::currentRouteNamed('master-kelas.edit') ? 'active' : '' }}">
              <i class="nav-icon fas fa-graduation-cap"></i>
              <p>
                Master Kelas
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('list-instansi.index') }}" class="nav-link {{ Route::currentRouteNamed('list-instansi.index') || Route::currentRouteNamed('show.kelas_program') ? 'active' : '' }}">
              <i class="nav-icon fas fa-university"></i>
              <p>
                Instansi Pendidikan
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('profile.index') }}" class="nav-link {{ Route::currentRouteNamed('profile.index') ? 'active' : '' }}">
              <i class="nav-icon nav-icon fas fa-user-cog"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
        </ul>

        @endif
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>