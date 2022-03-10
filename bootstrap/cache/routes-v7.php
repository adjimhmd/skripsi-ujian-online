<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/api/user' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dYwGaohONCoFoTK5',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guest',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/home-instansi' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.instansi',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/home-kelas-program' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.kelas.program',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/home-mapel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home.mapel',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'login',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::s0oOJHHIm9vf7ZRI',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/logout' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'logout',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::kVddKXTezfU5ww1M',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/reset' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.request',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'password.update',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/email' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.email',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/password/confirm' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.confirm',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FxZazB094uzQWDLo',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/email/verify' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.notice',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/email/resend' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.resend',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/guru/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'guru.register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'guru.proses',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/siswa/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'siswa.register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'siswa.proses',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/instansi/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'instansi.register',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'instansi.proses',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/home' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'home',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/instansi-pendidikan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'instansi-pendidikan.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'instansi-pendidikan.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/instansi-pendidikan/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'instansi-pendidikan.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/list-instansi' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list-instansi.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'list-instansi.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/list-instansi/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list-instansi.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_kelas_program' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show.kelas_program',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/select_rombongan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'select.rombongan',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/daftar_siswa' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'daftar.siswa',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/siswa/list-kelas-program' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list.kelas.program',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/guru/list-kelas-program' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list.kelas.program.guru',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/bayar-dulu' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bayar.dulu',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/upload_bayar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'upload.bayar',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/terima_lembaga' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'terima.lembaga',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/verifikasi' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verifikasi.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'verifikasi.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/verifikasi/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verifikasi.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master-mapel' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-mapel.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'master-mapel.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master-mapel/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-mapel.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master-kelas' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-kelas.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'master-kelas.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master-kelas/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-kelas.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master-tahun-ajaran' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-tahun-ajaran.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'master-tahun-ajaran.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/master-tahun-ajaran/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-tahun-ajaran.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ruang-ujian' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ruang-ujian.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'ruang-ujian.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ruang-ujian/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ruang-ujian.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/nilai-ujian' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'nilai-ujian.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'nilai-ujian.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/nilai-ujian/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'nilai-ujian.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/email-nilai' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'email.nilai',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_paket' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show.paket',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/ujian-siswa' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ujian.siswa',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update-nilai' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update.nilai',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/bank_soals' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bank_soals.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'bank_soals.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/bank_soals/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bank_soals.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/materi-pembelajaran' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'materi-pembelajaran.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'materi-pembelajaran.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/materi-pembelajaran/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'materi-pembelajaran.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/paket_soal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'paket_soal.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'paket_soal.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/paket_soal/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'paket_soal.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_guru_paket' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show.guru.paket',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_guru_paket' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update.guru.paket',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/pilih_soal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'pilih.soal',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/hapus_soal' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hapus.soal',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'profile.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/profile/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_kota' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show.kota',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_kecamatan' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show.kecamatan',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_desa' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show.desa',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/kelas-program' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'kelas-program.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'kelas-program.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/kelas-program/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'kelas-program.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/show_guru' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'show.guru',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_guru' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update.guru',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/edit_harga' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'edit.harga',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/update_harga' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'update.harga',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/list-guru' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list-guru.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'list-guru.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/list-guru/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list-guru.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/daftar_guru' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'daftar.guru',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/terima_guru' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'terima.guru',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/simpan_guru' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'simpan.guru',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/valid_guru' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'valid.guru',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sendmail' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::djzm7N36FnqjKnir',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/orders' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'orders.index',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'orders.store',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/orders/create' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'orders.create',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/gdrive' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::98YTHCrm6J6mUqhz',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/p(?|a(?|ssword/reset/([^/]++)(*:37)|ket_soal/([^/]++)(?|(*:64)|/edit(*:76)|(*:83)))|rofile/([^/]++)(?|(*:110)|/edit(*:123)|(*:131)))|/email/verify/([^/]++)/([^/]++)(*:172)|/upload\\-verifikasi/([^/]++)(*:208)|/instansi\\-pendidikan/([^/]++)(?|(*:249)|/edit(*:262)|(*:270))|/list\\-(?|instansi/([^/]++)(?|(*:309)|/edit(*:322)|(*:330))|guru/([^/]++)(?|(*:355)|/edit(*:368)|(*:376)))|/verifikasi/([^/]++)(?|(*:409)|/edit(*:422)|(*:430))|/ma(?|ster\\-(?|mapel/([^/]++)(?|(*:471)|/edit(*:484)|(*:492))|kelas/([^/]++)(?|(*:518)|/edit(*:531)|(*:539))|tahun\\-ajaran/([^/]++)(?|(*:573)|/edit(*:586)|(*:594)))|teri\\-pembelajaran/([^/]++)(?|(*:634)|/edit(*:647)|(*:655)))|/ruang\\-ujian/([^/]++)(?|(*:690)|/edit(*:703)|(*:711))|/nilai\\-ujian/([^/]++)(?|(*:745)|/edit(*:758)|(*:766))|/detail\\-nilai\\-ujian/([^/]++)(*:805)|/hasil\\-ujian/([^/]++)(*:835)|/bank_soals/([^/]++)(?|(*:866)|/edit(*:879)|(*:887))|/kelas\\-program/([^/]++)(?|(*:923)|/edit(*:936)|(*:944))|/orders/([^/]++)(?|(*:972)|/edit(*:985)|(*:993)))/?$}sDu',
    ),
    3 => 
    array (
      37 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'password.reset',
          ),
          1 => 
          array (
            0 => 'token',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      64 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'paket_soal.show',
          ),
          1 => 
          array (
            0 => 'paket_soal',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      76 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'paket_soal.edit',
          ),
          1 => 
          array (
            0 => 'paket_soal',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      83 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'paket_soal.update',
          ),
          1 => 
          array (
            0 => 'paket_soal',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'paket_soal.destroy',
          ),
          1 => 
          array (
            0 => 'paket_soal',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      110 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile.show',
          ),
          1 => 
          array (
            0 => 'profile',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      123 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile.edit',
          ),
          1 => 
          array (
            0 => 'profile',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      131 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'profile.update',
          ),
          1 => 
          array (
            0 => 'profile',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'profile.destroy',
          ),
          1 => 
          array (
            0 => 'profile',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      172 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verification.verify',
          ),
          1 => 
          array (
            0 => 'id',
            1 => 'hash',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      208 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'upload.verifikasi',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PATCH' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      249 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'instansi-pendidikan.show',
          ),
          1 => 
          array (
            0 => 'instansi_pendidikan',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      262 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'instansi-pendidikan.edit',
          ),
          1 => 
          array (
            0 => 'instansi_pendidikan',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      270 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'instansi-pendidikan.update',
          ),
          1 => 
          array (
            0 => 'instansi_pendidikan',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'instansi-pendidikan.destroy',
          ),
          1 => 
          array (
            0 => 'instansi_pendidikan',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      309 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list-instansi.show',
          ),
          1 => 
          array (
            0 => 'list_instansi',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      322 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list-instansi.edit',
          ),
          1 => 
          array (
            0 => 'list_instansi',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      330 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list-instansi.update',
          ),
          1 => 
          array (
            0 => 'list_instansi',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'list-instansi.destroy',
          ),
          1 => 
          array (
            0 => 'list_instansi',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      355 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list-guru.show',
          ),
          1 => 
          array (
            0 => 'list_guru',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      368 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list-guru.edit',
          ),
          1 => 
          array (
            0 => 'list_guru',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      376 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'list-guru.update',
          ),
          1 => 
          array (
            0 => 'list_guru',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'list-guru.destroy',
          ),
          1 => 
          array (
            0 => 'list_guru',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      409 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verifikasi.show',
          ),
          1 => 
          array (
            0 => 'verifikasi',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      422 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verifikasi.edit',
          ),
          1 => 
          array (
            0 => 'verifikasi',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      430 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'verifikasi.update',
          ),
          1 => 
          array (
            0 => 'verifikasi',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'verifikasi.destroy',
          ),
          1 => 
          array (
            0 => 'verifikasi',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      471 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-mapel.show',
          ),
          1 => 
          array (
            0 => 'master_mapel',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      484 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-mapel.edit',
          ),
          1 => 
          array (
            0 => 'master_mapel',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      492 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-mapel.update',
          ),
          1 => 
          array (
            0 => 'master_mapel',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'master-mapel.destroy',
          ),
          1 => 
          array (
            0 => 'master_mapel',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      518 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-kelas.show',
          ),
          1 => 
          array (
            0 => 'master_kela',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      531 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-kelas.edit',
          ),
          1 => 
          array (
            0 => 'master_kela',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      539 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-kelas.update',
          ),
          1 => 
          array (
            0 => 'master_kela',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'master-kelas.destroy',
          ),
          1 => 
          array (
            0 => 'master_kela',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      573 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-tahun-ajaran.show',
          ),
          1 => 
          array (
            0 => 'master_tahun_ajaran',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      586 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-tahun-ajaran.edit',
          ),
          1 => 
          array (
            0 => 'master_tahun_ajaran',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      594 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'master-tahun-ajaran.update',
          ),
          1 => 
          array (
            0 => 'master_tahun_ajaran',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'master-tahun-ajaran.destroy',
          ),
          1 => 
          array (
            0 => 'master_tahun_ajaran',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      634 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'materi-pembelajaran.show',
          ),
          1 => 
          array (
            0 => 'materi_pembelajaran',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      647 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'materi-pembelajaran.edit',
          ),
          1 => 
          array (
            0 => 'materi_pembelajaran',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      655 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'materi-pembelajaran.update',
          ),
          1 => 
          array (
            0 => 'materi_pembelajaran',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'materi-pembelajaran.destroy',
          ),
          1 => 
          array (
            0 => 'materi_pembelajaran',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      690 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ruang-ujian.show',
          ),
          1 => 
          array (
            0 => 'ruang_ujian',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      703 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ruang-ujian.edit',
          ),
          1 => 
          array (
            0 => 'ruang_ujian',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      711 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ruang-ujian.update',
          ),
          1 => 
          array (
            0 => 'ruang_ujian',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'ruang-ujian.destroy',
          ),
          1 => 
          array (
            0 => 'ruang_ujian',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      745 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'nilai-ujian.show',
          ),
          1 => 
          array (
            0 => 'nilai_ujian',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      758 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'nilai-ujian.edit',
          ),
          1 => 
          array (
            0 => 'nilai_ujian',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      766 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'nilai-ujian.update',
          ),
          1 => 
          array (
            0 => 'nilai_ujian',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'nilai-ujian.destroy',
          ),
          1 => 
          array (
            0 => 'nilai_ujian',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      805 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'detail.nilai.ujian',
          ),
          1 => 
          array (
            0 => 'nilai',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      835 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'hasil.ujian',
          ),
          1 => 
          array (
            0 => 'hasil_ujian',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      866 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bank_soals.show',
          ),
          1 => 
          array (
            0 => 'bank_soal',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      879 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bank_soals.edit',
          ),
          1 => 
          array (
            0 => 'bank_soal',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      887 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'bank_soals.update',
          ),
          1 => 
          array (
            0 => 'bank_soal',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'bank_soals.destroy',
          ),
          1 => 
          array (
            0 => 'bank_soal',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      923 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'kelas-program.show',
          ),
          1 => 
          array (
            0 => 'kelas_program',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      936 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'kelas-program.edit',
          ),
          1 => 
          array (
            0 => 'kelas_program',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      944 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'kelas-program.update',
          ),
          1 => 
          array (
            0 => 'kelas_program',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'kelas-program.destroy',
          ),
          1 => 
          array (
            0 => 'kelas_program',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      972 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'orders.show',
          ),
          1 => 
          array (
            0 => 'order',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      985 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'orders.edit',
          ),
          1 => 
          array (
            0 => 'order',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      993 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'orders.update',
          ),
          1 => 
          array (
            0 => 'order',
          ),
          2 => 
          array (
            'PUT' => 0,
            'PATCH' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'orders.destroy',
          ),
          1 => 
          array (
            0 => 'order',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::dYwGaohONCoFoTK5' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/user',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth:api',
        ),
        'uses' => 'C:32:"Opis\\Closure\\SerializableClosure":289:{@MB4zzuMIZEDcLjJtlPHwIKxMUcmB1VuVHIRE7ji6sWE=.a:5:{s:3:"use";a:0:{}s:8:"function";s:77:"function (\\Illuminate\\Http\\Request $request) {
    return $request->user();
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000001e4d0872000000005677449f";}}',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::dYwGaohONCoFoTK5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'guest' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeGuestController@index',
        'controller' => 'App\\Http\\Controllers\\HomeGuestController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'guest',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'home.instansi' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'home-instansi',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeGuestController@home_instansi',
        'controller' => 'App\\Http\\Controllers\\HomeGuestController@home_instansi',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'home.instansi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'home.kelas.program' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'home-kelas-program',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeGuestController@home_kelas_program',
        'controller' => 'App\\Http\\Controllers\\HomeGuestController@home_kelas_program',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'home.kelas.program',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'home.mapel' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'home-mapel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeGuestController@home_mapel',
        'controller' => 'App\\Http\\Controllers\\HomeGuestController@home_mapel',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'home.mapel',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'login' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@showLoginForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'login',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::s0oOJHHIm9vf7ZRI' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@login',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::s0oOJHHIm9vf7ZRI',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'logout' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'logout',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'controller' => 'App\\Http\\Controllers\\Auth\\LoginController@logout',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'logout',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@showRegistrationForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::kVddKXTezfU5ww1M' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@register',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::kVddKXTezfU5ww1M',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.request' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@showLinkRequestForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.request',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.email' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/email',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'controller' => 'App\\Http\\Controllers\\Auth\\ForgotPasswordController@sendResetLinkEmail',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.email',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.reset' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/reset/{token}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@showResetForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.reset',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.update' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/reset',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'controller' => 'App\\Http\\Controllers\\Auth\\ResetPasswordController@reset',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.update',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'password.confirm' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@showConfirmForm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'password.confirm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::FxZazB094uzQWDLo' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'password/confirm',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'controller' => 'App\\Http\\Controllers\\Auth\\ConfirmPasswordController@confirm',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::FxZazB094uzQWDLo',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verification.notice' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'email/verify',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\VerificationController@show',
        'controller' => 'App\\Http\\Controllers\\Auth\\VerificationController@show',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'verification.notice',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verification.verify' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'email/verify/{id}/{hash}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\VerificationController@verify',
        'controller' => 'App\\Http\\Controllers\\Auth\\VerificationController@verify',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'verification.verify',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verification.resend' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'email/resend',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'revalidate',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\VerificationController@resend',
        'controller' => 'App\\Http\\Controllers\\Auth\\VerificationController@resend',
        'namespace' => 'App\\Http\\Controllers',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'verification.resend',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'guru.register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'guru/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@show_guru_form',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@show_guru_form',
        'namespace' => 'Auth',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'guru.register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'guru.proses' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'guru/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@process_guru',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@process_guru',
        'namespace' => 'Auth',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'guru.proses',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'siswa.register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'siswa/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@show_siswa_form',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@show_siswa_form',
        'namespace' => 'Auth',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'siswa.register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'siswa.proses' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'siswa/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@process_siswa',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@process_siswa',
        'namespace' => 'Auth',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'siswa.proses',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'instansi.register' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'instansi/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@show_instansi_form',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@show_instansi_form',
        'namespace' => 'Auth',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'instansi.register',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'instansi.proses' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'instansi/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\Auth\\RegisterController@process_instansi',
        'controller' => 'App\\Http\\Controllers\\Auth\\RegisterController@process_instansi',
        'namespace' => 'Auth',
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'instansi.proses',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'home' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'home',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru|adm_sistem|adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@index',
        'controller' => 'App\\Http\\Controllers\\HomeController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'home',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'upload.verifikasi' => 
    array (
      'methods' => 
      array (
        0 => 'PATCH',
      ),
      'uri' => 'upload-verifikasi/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|siswa|adm_lembaga|adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\HomeController@upload',
        'controller' => 'App\\Http\\Controllers\\HomeController@upload',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'upload.verifikasi',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'instansi-pendidikan.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'instansi-pendidikan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'instansi-pendidikan.index',
        'uses' => 'App\\Http\\Controllers\\InstansiPendidikanController@index',
        'controller' => 'App\\Http\\Controllers\\InstansiPendidikanController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'instansi-pendidikan.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'instansi-pendidikan/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'instansi-pendidikan.create',
        'uses' => 'App\\Http\\Controllers\\InstansiPendidikanController@create',
        'controller' => 'App\\Http\\Controllers\\InstansiPendidikanController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'instansi-pendidikan.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'instansi-pendidikan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'instansi-pendidikan.store',
        'uses' => 'App\\Http\\Controllers\\InstansiPendidikanController@store',
        'controller' => 'App\\Http\\Controllers\\InstansiPendidikanController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'instansi-pendidikan.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'instansi-pendidikan/{instansi_pendidikan}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'instansi-pendidikan.show',
        'uses' => 'App\\Http\\Controllers\\InstansiPendidikanController@show',
        'controller' => 'App\\Http\\Controllers\\InstansiPendidikanController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'instansi-pendidikan.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'instansi-pendidikan/{instansi_pendidikan}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'instansi-pendidikan.edit',
        'uses' => 'App\\Http\\Controllers\\InstansiPendidikanController@edit',
        'controller' => 'App\\Http\\Controllers\\InstansiPendidikanController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'instansi-pendidikan.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'instansi-pendidikan/{instansi_pendidikan}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'instansi-pendidikan.update',
        'uses' => 'App\\Http\\Controllers\\InstansiPendidikanController@update',
        'controller' => 'App\\Http\\Controllers\\InstansiPendidikanController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'instansi-pendidikan.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'instansi-pendidikan/{instansi_pendidikan}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'instansi-pendidikan.destroy',
        'uses' => 'App\\Http\\Controllers\\InstansiPendidikanController@destroy',
        'controller' => 'App\\Http\\Controllers\\InstansiPendidikanController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-instansi.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'list-instansi',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru',
        ),
        'as' => 'list-instansi.index',
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@index',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-instansi.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'list-instansi/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru',
        ),
        'as' => 'list-instansi.create',
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@create',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-instansi.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'list-instansi',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru',
        ),
        'as' => 'list-instansi.store',
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@store',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-instansi.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'list-instansi/{list_instansi}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru',
        ),
        'as' => 'list-instansi.show',
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@show',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-instansi.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'list-instansi/{list_instansi}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru',
        ),
        'as' => 'list-instansi.edit',
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@edit',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-instansi.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'list-instansi/{list_instansi}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru',
        ),
        'as' => 'list-instansi.update',
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@update',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-instansi.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'list-instansi/{list_instansi}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru',
        ),
        'as' => 'list-instansi.destroy',
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@destroy',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show.kelas_program' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'show_kelas_program',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa',
        ),
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@show_kelas_program',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@show_kelas_program',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show.kelas_program',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'select.rombongan' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'select_rombongan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa',
        ),
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@select_rombongan',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@select_rombongan',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'select.rombongan',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'daftar.siswa' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'daftar_siswa',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa',
        ),
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@daftar_siswa',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@daftar_siswa',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'daftar.siswa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list.kelas.program' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'siswa/list-kelas-program',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa',
        ),
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@index_kelas_program',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@index_kelas_program',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'list.kelas.program',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list.kelas.program.guru' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'guru/list-kelas-program',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@index_kelas_program_guru',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@index_kelas_program_guru',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'list.kelas.program.guru',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'bayar.dulu' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'bayar-dulu',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa',
        ),
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@bayar_dulu',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@bayar_dulu',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'bayar.dulu',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'upload.bayar' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'upload_bayar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa',
        ),
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@upload_bayar',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@upload_bayar',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'upload.bayar',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'terima.lembaga' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'terima_lembaga',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'uses' => 'App\\Http\\Controllers\\InstansiSiswaController@terima_lembaga',
        'controller' => 'App\\Http\\Controllers\\InstansiSiswaController@terima_lembaga',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'terima.lembaga',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verifikasi.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verifikasi',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'verifikasi.index',
        'uses' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@index',
        'controller' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verifikasi.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verifikasi/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'verifikasi.create',
        'uses' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@create',
        'controller' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verifikasi.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'verifikasi',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'verifikasi.store',
        'uses' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@store',
        'controller' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verifikasi.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verifikasi/{verifikasi}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'verifikasi.show',
        'uses' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@show',
        'controller' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verifikasi.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'verifikasi/{verifikasi}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'verifikasi.edit',
        'uses' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@edit',
        'controller' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verifikasi.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'verifikasi/{verifikasi}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'verifikasi.update',
        'uses' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@update',
        'controller' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'verifikasi.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'verifikasi/{verifikasi}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'verifikasi.destroy',
        'uses' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@destroy',
        'controller' => 'App\\Http\\Controllers\\Admin_Sistem\\VerifikasiUserController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-mapel.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-mapel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-mapel.index',
        'uses' => 'App\\Http\\Controllers\\MasterMapelController@index',
        'controller' => 'App\\Http\\Controllers\\MasterMapelController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-mapel.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-mapel/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-mapel.create',
        'uses' => 'App\\Http\\Controllers\\MasterMapelController@create',
        'controller' => 'App\\Http\\Controllers\\MasterMapelController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-mapel.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'master-mapel',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-mapel.store',
        'uses' => 'App\\Http\\Controllers\\MasterMapelController@store',
        'controller' => 'App\\Http\\Controllers\\MasterMapelController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-mapel.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-mapel/{master_mapel}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-mapel.show',
        'uses' => 'App\\Http\\Controllers\\MasterMapelController@show',
        'controller' => 'App\\Http\\Controllers\\MasterMapelController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-mapel.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-mapel/{master_mapel}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-mapel.edit',
        'uses' => 'App\\Http\\Controllers\\MasterMapelController@edit',
        'controller' => 'App\\Http\\Controllers\\MasterMapelController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-mapel.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'master-mapel/{master_mapel}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-mapel.update',
        'uses' => 'App\\Http\\Controllers\\MasterMapelController@update',
        'controller' => 'App\\Http\\Controllers\\MasterMapelController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-mapel.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'master-mapel/{master_mapel}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-mapel.destroy',
        'uses' => 'App\\Http\\Controllers\\MasterMapelController@destroy',
        'controller' => 'App\\Http\\Controllers\\MasterMapelController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-kelas.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-kelas',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-kelas.index',
        'uses' => 'App\\Http\\Controllers\\MasterKelasController@index',
        'controller' => 'App\\Http\\Controllers\\MasterKelasController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-kelas.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-kelas/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-kelas.create',
        'uses' => 'App\\Http\\Controllers\\MasterKelasController@create',
        'controller' => 'App\\Http\\Controllers\\MasterKelasController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-kelas.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'master-kelas',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-kelas.store',
        'uses' => 'App\\Http\\Controllers\\MasterKelasController@store',
        'controller' => 'App\\Http\\Controllers\\MasterKelasController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-kelas.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-kelas/{master_kela}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-kelas.show',
        'uses' => 'App\\Http\\Controllers\\MasterKelasController@show',
        'controller' => 'App\\Http\\Controllers\\MasterKelasController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-kelas.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-kelas/{master_kela}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-kelas.edit',
        'uses' => 'App\\Http\\Controllers\\MasterKelasController@edit',
        'controller' => 'App\\Http\\Controllers\\MasterKelasController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-kelas.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'master-kelas/{master_kela}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-kelas.update',
        'uses' => 'App\\Http\\Controllers\\MasterKelasController@update',
        'controller' => 'App\\Http\\Controllers\\MasterKelasController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-kelas.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'master-kelas/{master_kela}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-kelas.destroy',
        'uses' => 'App\\Http\\Controllers\\MasterKelasController@destroy',
        'controller' => 'App\\Http\\Controllers\\MasterKelasController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-tahun-ajaran.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-tahun-ajaran',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-tahun-ajaran.index',
        'uses' => 'App\\Http\\Controllers\\MasterTahunAjaranController@index',
        'controller' => 'App\\Http\\Controllers\\MasterTahunAjaranController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-tahun-ajaran.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-tahun-ajaran/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-tahun-ajaran.create',
        'uses' => 'App\\Http\\Controllers\\MasterTahunAjaranController@create',
        'controller' => 'App\\Http\\Controllers\\MasterTahunAjaranController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-tahun-ajaran.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'master-tahun-ajaran',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-tahun-ajaran.store',
        'uses' => 'App\\Http\\Controllers\\MasterTahunAjaranController@store',
        'controller' => 'App\\Http\\Controllers\\MasterTahunAjaranController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-tahun-ajaran.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-tahun-ajaran/{master_tahun_ajaran}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-tahun-ajaran.show',
        'uses' => 'App\\Http\\Controllers\\MasterTahunAjaranController@show',
        'controller' => 'App\\Http\\Controllers\\MasterTahunAjaranController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-tahun-ajaran.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'master-tahun-ajaran/{master_tahun_ajaran}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-tahun-ajaran.edit',
        'uses' => 'App\\Http\\Controllers\\MasterTahunAjaranController@edit',
        'controller' => 'App\\Http\\Controllers\\MasterTahunAjaranController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-tahun-ajaran.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'master-tahun-ajaran/{master_tahun_ajaran}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-tahun-ajaran.update',
        'uses' => 'App\\Http\\Controllers\\MasterTahunAjaranController@update',
        'controller' => 'App\\Http\\Controllers\\MasterTahunAjaranController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'master-tahun-ajaran.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'master-tahun-ajaran/{master_tahun_ajaran}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_sistem',
        ),
        'as' => 'master-tahun-ajaran.destroy',
        'uses' => 'App\\Http\\Controllers\\MasterTahunAjaranController@destroy',
        'controller' => 'App\\Http\\Controllers\\MasterTahunAjaranController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'ruang-ujian.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ruang-ujian',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'ruang-ujian.index',
        'uses' => 'App\\Http\\Controllers\\RuangUjianController@index',
        'controller' => 'App\\Http\\Controllers\\RuangUjianController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'ruang-ujian.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ruang-ujian/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'ruang-ujian.create',
        'uses' => 'App\\Http\\Controllers\\RuangUjianController@create',
        'controller' => 'App\\Http\\Controllers\\RuangUjianController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'ruang-ujian.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ruang-ujian',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'ruang-ujian.store',
        'uses' => 'App\\Http\\Controllers\\RuangUjianController@store',
        'controller' => 'App\\Http\\Controllers\\RuangUjianController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'ruang-ujian.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ruang-ujian/{ruang_ujian}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'ruang-ujian.show',
        'uses' => 'App\\Http\\Controllers\\RuangUjianController@show',
        'controller' => 'App\\Http\\Controllers\\RuangUjianController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'ruang-ujian.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'ruang-ujian/{ruang_ujian}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'ruang-ujian.edit',
        'uses' => 'App\\Http\\Controllers\\RuangUjianController@edit',
        'controller' => 'App\\Http\\Controllers\\RuangUjianController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'ruang-ujian.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'ruang-ujian/{ruang_ujian}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'ruang-ujian.update',
        'uses' => 'App\\Http\\Controllers\\RuangUjianController@update',
        'controller' => 'App\\Http\\Controllers\\RuangUjianController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'ruang-ujian.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'ruang-ujian/{ruang_ujian}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'ruang-ujian.destroy',
        'uses' => 'App\\Http\\Controllers\\RuangUjianController@destroy',
        'controller' => 'App\\Http\\Controllers\\RuangUjianController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'nilai-ujian.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'nilai-ujian',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'nilai-ujian.index',
        'uses' => 'App\\Http\\Controllers\\NilaiUjianController@index',
        'controller' => 'App\\Http\\Controllers\\NilaiUjianController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'nilai-ujian.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'nilai-ujian/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'nilai-ujian.create',
        'uses' => 'App\\Http\\Controllers\\NilaiUjianController@create',
        'controller' => 'App\\Http\\Controllers\\NilaiUjianController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'nilai-ujian.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'nilai-ujian',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'nilai-ujian.store',
        'uses' => 'App\\Http\\Controllers\\NilaiUjianController@store',
        'controller' => 'App\\Http\\Controllers\\NilaiUjianController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'nilai-ujian.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'nilai-ujian/{nilai_ujian}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'nilai-ujian.show',
        'uses' => 'App\\Http\\Controllers\\NilaiUjianController@show',
        'controller' => 'App\\Http\\Controllers\\NilaiUjianController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'nilai-ujian.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'nilai-ujian/{nilai_ujian}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'nilai-ujian.edit',
        'uses' => 'App\\Http\\Controllers\\NilaiUjianController@edit',
        'controller' => 'App\\Http\\Controllers\\NilaiUjianController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'nilai-ujian.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'nilai-ujian/{nilai_ujian}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'nilai-ujian.update',
        'uses' => 'App\\Http\\Controllers\\NilaiUjianController@update',
        'controller' => 'App\\Http\\Controllers\\NilaiUjianController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'nilai-ujian.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'nilai-ujian/{nilai_ujian}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'nilai-ujian.destroy',
        'uses' => 'App\\Http\\Controllers\\NilaiUjianController@destroy',
        'controller' => 'App\\Http\\Controllers\\NilaiUjianController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'email.nilai' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'email-nilai',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\NilaiUjianController@email',
        'controller' => 'App\\Http\\Controllers\\NilaiUjianController@email',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'email.nilai',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'detail.nilai.ujian' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'detail-nilai-ujian/{nilai}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\NilaiUjianController@detail_nilai_ujian',
        'controller' => 'App\\Http\\Controllers\\NilaiUjianController@detail_nilai_ujian',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'detail.nilai.ujian',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show.paket' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'show_paket',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\RuangUjianController@show_paket',
        'controller' => 'App\\Http\\Controllers\\RuangUjianController@show_paket',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show.paket',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'ujian.siswa' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'ujian-siswa',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa',
        ),
        'uses' => 'App\\Http\\Controllers\\RuangUjianController@ujian_siswa',
        'controller' => 'App\\Http\\Controllers\\RuangUjianController@ujian_siswa',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'ujian.siswa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'hasil.ujian' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'hasil-ujian/{hasil_ujian}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|guru',
        ),
        'uses' => 'App\\Http\\Controllers\\RuangUjianController@hasil_ujian',
        'controller' => 'App\\Http\\Controllers\\RuangUjianController@hasil_ujian',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'hasil.ujian',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update.nilai' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update-nilai',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|guru',
        ),
        'uses' => 'App\\Http\\Controllers\\RuangUjianController@update_nilai',
        'controller' => 'App\\Http\\Controllers\\RuangUjianController@update_nilai',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update.nilai',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'bank_soals.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bank_soals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'bank_soals.index',
        'uses' => 'App\\Http\\Controllers\\BankSoalController@index',
        'controller' => 'App\\Http\\Controllers\\BankSoalController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'bank_soals.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bank_soals/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'bank_soals.create',
        'uses' => 'App\\Http\\Controllers\\BankSoalController@create',
        'controller' => 'App\\Http\\Controllers\\BankSoalController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'bank_soals.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'bank_soals',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'bank_soals.store',
        'uses' => 'App\\Http\\Controllers\\BankSoalController@store',
        'controller' => 'App\\Http\\Controllers\\BankSoalController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'bank_soals.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bank_soals/{bank_soal}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'bank_soals.show',
        'uses' => 'App\\Http\\Controllers\\BankSoalController@show',
        'controller' => 'App\\Http\\Controllers\\BankSoalController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'bank_soals.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'bank_soals/{bank_soal}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'bank_soals.edit',
        'uses' => 'App\\Http\\Controllers\\BankSoalController@edit',
        'controller' => 'App\\Http\\Controllers\\BankSoalController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'bank_soals.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'bank_soals/{bank_soal}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'bank_soals.update',
        'uses' => 'App\\Http\\Controllers\\BankSoalController@update',
        'controller' => 'App\\Http\\Controllers\\BankSoalController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'bank_soals.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'bank_soals/{bank_soal}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'bank_soals.destroy',
        'uses' => 'App\\Http\\Controllers\\BankSoalController@destroy',
        'controller' => 'App\\Http\\Controllers\\BankSoalController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'materi-pembelajaran.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'materi-pembelajaran',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'materi-pembelajaran.index',
        'uses' => 'App\\Http\\Controllers\\MateriPembelajaranController@index',
        'controller' => 'App\\Http\\Controllers\\MateriPembelajaranController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'materi-pembelajaran.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'materi-pembelajaran/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'materi-pembelajaran.create',
        'uses' => 'App\\Http\\Controllers\\MateriPembelajaranController@create',
        'controller' => 'App\\Http\\Controllers\\MateriPembelajaranController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'materi-pembelajaran.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'materi-pembelajaran',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'materi-pembelajaran.store',
        'uses' => 'App\\Http\\Controllers\\MateriPembelajaranController@store',
        'controller' => 'App\\Http\\Controllers\\MateriPembelajaranController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'materi-pembelajaran.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'materi-pembelajaran/{materi_pembelajaran}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'materi-pembelajaran.show',
        'uses' => 'App\\Http\\Controllers\\MateriPembelajaranController@show',
        'controller' => 'App\\Http\\Controllers\\MateriPembelajaranController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'materi-pembelajaran.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'materi-pembelajaran/{materi_pembelajaran}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'materi-pembelajaran.edit',
        'uses' => 'App\\Http\\Controllers\\MateriPembelajaranController@edit',
        'controller' => 'App\\Http\\Controllers\\MateriPembelajaranController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'materi-pembelajaran.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'materi-pembelajaran/{materi_pembelajaran}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'materi-pembelajaran.update',
        'uses' => 'App\\Http\\Controllers\\MateriPembelajaranController@update',
        'controller' => 'App\\Http\\Controllers\\MateriPembelajaranController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'materi-pembelajaran.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'materi-pembelajaran/{materi_pembelajaran}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru',
        ),
        'as' => 'materi-pembelajaran.destroy',
        'uses' => 'App\\Http\\Controllers\\MateriPembelajaranController@destroy',
        'controller' => 'App\\Http\\Controllers\\MateriPembelajaranController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'paket_soal.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'paket_soal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|adm_instansi',
        ),
        'as' => 'paket_soal.index',
        'uses' => 'App\\Http\\Controllers\\PaketSoalController@index',
        'controller' => 'App\\Http\\Controllers\\PaketSoalController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'paket_soal.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'paket_soal/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|adm_instansi',
        ),
        'as' => 'paket_soal.create',
        'uses' => 'App\\Http\\Controllers\\PaketSoalController@create',
        'controller' => 'App\\Http\\Controllers\\PaketSoalController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'paket_soal.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'paket_soal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|adm_instansi',
        ),
        'as' => 'paket_soal.store',
        'uses' => 'App\\Http\\Controllers\\PaketSoalController@store',
        'controller' => 'App\\Http\\Controllers\\PaketSoalController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'paket_soal.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'paket_soal/{paket_soal}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|adm_instansi',
        ),
        'as' => 'paket_soal.show',
        'uses' => 'App\\Http\\Controllers\\PaketSoalController@show',
        'controller' => 'App\\Http\\Controllers\\PaketSoalController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'paket_soal.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'paket_soal/{paket_soal}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|adm_instansi',
        ),
        'as' => 'paket_soal.edit',
        'uses' => 'App\\Http\\Controllers\\PaketSoalController@edit',
        'controller' => 'App\\Http\\Controllers\\PaketSoalController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'paket_soal.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'paket_soal/{paket_soal}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|adm_instansi',
        ),
        'as' => 'paket_soal.update',
        'uses' => 'App\\Http\\Controllers\\PaketSoalController@update',
        'controller' => 'App\\Http\\Controllers\\PaketSoalController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'paket_soal.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'paket_soal/{paket_soal}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|adm_instansi',
        ),
        'as' => 'paket_soal.destroy',
        'uses' => 'App\\Http\\Controllers\\PaketSoalController@destroy',
        'controller' => 'App\\Http\\Controllers\\PaketSoalController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show.guru.paket' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'show_guru_paket',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\PaketSoalController@show_guru_paket',
        'controller' => 'App\\Http\\Controllers\\PaketSoalController@show_guru_paket',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show.guru.paket',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update.guru.paket' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update_guru_paket',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\PaketSoalController@update_guru_paket',
        'controller' => 'App\\Http\\Controllers\\PaketSoalController@update_guru_paket',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update.guru.paket',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'pilih.soal' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'pilih_soal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\PaketSoalController@pilih_soal',
        'controller' => 'App\\Http\\Controllers\\PaketSoalController@pilih_soal',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'pilih.soal',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'hapus.soal' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'hapus_soal',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:guru|adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\PaketSoalController@hapus_soal',
        'controller' => 'App\\Http\\Controllers\\PaketSoalController@hapus_soal',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'hapus.soal',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'profile.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru|adm_instansi|adm_sistem',
        ),
        'as' => 'profile.index',
        'uses' => 'App\\Http\\Controllers\\ProfileController@index',
        'controller' => 'App\\Http\\Controllers\\ProfileController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'profile.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru|adm_instansi|adm_sistem',
        ),
        'as' => 'profile.create',
        'uses' => 'App\\Http\\Controllers\\ProfileController@create',
        'controller' => 'App\\Http\\Controllers\\ProfileController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'profile.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'profile',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru|adm_instansi|adm_sistem',
        ),
        'as' => 'profile.store',
        'uses' => 'App\\Http\\Controllers\\ProfileController@store',
        'controller' => 'App\\Http\\Controllers\\ProfileController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'profile.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/{profile}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru|adm_instansi|adm_sistem',
        ),
        'as' => 'profile.show',
        'uses' => 'App\\Http\\Controllers\\ProfileController@show',
        'controller' => 'App\\Http\\Controllers\\ProfileController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'profile.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'profile/{profile}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru|adm_instansi|adm_sistem',
        ),
        'as' => 'profile.edit',
        'uses' => 'App\\Http\\Controllers\\ProfileController@edit',
        'controller' => 'App\\Http\\Controllers\\ProfileController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'profile.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'profile/{profile}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru|adm_instansi|adm_sistem',
        ),
        'as' => 'profile.update',
        'uses' => 'App\\Http\\Controllers\\ProfileController@update',
        'controller' => 'App\\Http\\Controllers\\ProfileController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'profile.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'profile/{profile}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:siswa|guru|adm_instansi|adm_sistem',
        ),
        'as' => 'profile.destroy',
        'uses' => 'App\\Http\\Controllers\\ProfileController@destroy',
        'controller' => 'App\\Http\\Controllers\\ProfileController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show.kota' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'show_kota',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\InstansiPendidikanController@show_kota',
        'controller' => 'App\\Http\\Controllers\\InstansiPendidikanController@show_kota',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show.kota',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show.kecamatan' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'show_kecamatan',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\InstansiPendidikanController@show_kecamatan',
        'controller' => 'App\\Http\\Controllers\\InstansiPendidikanController@show_kecamatan',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show.kecamatan',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show.desa' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'show_desa',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\InstansiPendidikanController@show_desa',
        'controller' => 'App\\Http\\Controllers\\InstansiPendidikanController@show_desa',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show.desa',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'kelas-program.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'kelas-program',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'kelas-program.index',
        'uses' => 'App\\Http\\Controllers\\KelasProgramController@index',
        'controller' => 'App\\Http\\Controllers\\KelasProgramController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'kelas-program.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'kelas-program/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'kelas-program.create',
        'uses' => 'App\\Http\\Controllers\\KelasProgramController@create',
        'controller' => 'App\\Http\\Controllers\\KelasProgramController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'kelas-program.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'kelas-program',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'kelas-program.store',
        'uses' => 'App\\Http\\Controllers\\KelasProgramController@store',
        'controller' => 'App\\Http\\Controllers\\KelasProgramController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'kelas-program.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'kelas-program/{kelas_program}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'kelas-program.show',
        'uses' => 'App\\Http\\Controllers\\KelasProgramController@show',
        'controller' => 'App\\Http\\Controllers\\KelasProgramController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'kelas-program.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'kelas-program/{kelas_program}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'kelas-program.edit',
        'uses' => 'App\\Http\\Controllers\\KelasProgramController@edit',
        'controller' => 'App\\Http\\Controllers\\KelasProgramController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'kelas-program.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'kelas-program/{kelas_program}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'kelas-program.update',
        'uses' => 'App\\Http\\Controllers\\KelasProgramController@update',
        'controller' => 'App\\Http\\Controllers\\KelasProgramController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'kelas-program.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'kelas-program/{kelas_program}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|siswa|guru',
        ),
        'as' => 'kelas-program.destroy',
        'uses' => 'App\\Http\\Controllers\\KelasProgramController@destroy',
        'controller' => 'App\\Http\\Controllers\\KelasProgramController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'show.guru' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'show_guru',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\KelasProgramController@show_guru',
        'controller' => 'App\\Http\\Controllers\\KelasProgramController@show_guru',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'show.guru',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update.guru' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update_guru',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\KelasProgramController@update_guru',
        'controller' => 'App\\Http\\Controllers\\KelasProgramController@update_guru',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update.guru',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'edit.harga' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'edit_harga',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\KelasProgramController@edit_harga',
        'controller' => 'App\\Http\\Controllers\\KelasProgramController@edit_harga',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'edit.harga',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'update.harga' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'update_harga',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\KelasProgramController@update_harga',
        'controller' => 'App\\Http\\Controllers\\KelasProgramController@update_harga',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'update.harga',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-guru.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'list-guru',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'list-guru.index',
        'uses' => 'App\\Http\\Controllers\\ListGuruController@index',
        'controller' => 'App\\Http\\Controllers\\ListGuruController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-guru.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'list-guru/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'list-guru.create',
        'uses' => 'App\\Http\\Controllers\\ListGuruController@create',
        'controller' => 'App\\Http\\Controllers\\ListGuruController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-guru.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'list-guru',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'list-guru.store',
        'uses' => 'App\\Http\\Controllers\\ListGuruController@store',
        'controller' => 'App\\Http\\Controllers\\ListGuruController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-guru.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'list-guru/{list_guru}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'list-guru.show',
        'uses' => 'App\\Http\\Controllers\\ListGuruController@show',
        'controller' => 'App\\Http\\Controllers\\ListGuruController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-guru.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'list-guru/{list_guru}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'list-guru.edit',
        'uses' => 'App\\Http\\Controllers\\ListGuruController@edit',
        'controller' => 'App\\Http\\Controllers\\ListGuruController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-guru.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'list-guru/{list_guru}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'list-guru.update',
        'uses' => 'App\\Http\\Controllers\\ListGuruController@update',
        'controller' => 'App\\Http\\Controllers\\ListGuruController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'list-guru.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'list-guru/{list_guru}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'as' => 'list-guru.destroy',
        'uses' => 'App\\Http\\Controllers\\ListGuruController@destroy',
        'controller' => 'App\\Http\\Controllers\\ListGuruController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'daftar.guru' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'daftar_guru',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\ListGuruController@daftar_guru',
        'controller' => 'App\\Http\\Controllers\\ListGuruController@daftar_guru',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'daftar.guru',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'terima.guru' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'terima_guru',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi',
        ),
        'uses' => 'App\\Http\\Controllers\\ListGuruController@terima_guru',
        'controller' => 'App\\Http\\Controllers\\ListGuruController@terima_guru',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'terima.guru',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'simpan.guru' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'simpan_guru',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|guru',
        ),
        'uses' => 'App\\Http\\Controllers\\ListGuruController@simpan_guru',
        'controller' => 'App\\Http\\Controllers\\ListGuruController@simpan_guru',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'simpan.guru',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'valid.guru' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'valid_guru',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'role:adm_instansi|guru',
        ),
        'uses' => 'App\\Http\\Controllers\\ListGuruController@valid_guru',
        'controller' => 'App\\Http\\Controllers\\ListGuruController@valid_guru',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'valid.guru',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::djzm7N36FnqjKnir' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sendmail',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'App\\Http\\Controllers\\EmailController@index',
        'controller' => 'App\\Http\\Controllers\\EmailController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::djzm7N36FnqjKnir',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'orders.index' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'orders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'orders.index',
        'uses' => 'App\\Http\\Controllers\\OrderController@index',
        'controller' => 'App\\Http\\Controllers\\OrderController@index',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'orders.create' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'orders/create',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'orders.create',
        'uses' => 'App\\Http\\Controllers\\OrderController@create',
        'controller' => 'App\\Http\\Controllers\\OrderController@create',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'orders.store' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'orders',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'orders.store',
        'uses' => 'App\\Http\\Controllers\\OrderController@store',
        'controller' => 'App\\Http\\Controllers\\OrderController@store',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'orders.show' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'orders/{order}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'orders.show',
        'uses' => 'App\\Http\\Controllers\\OrderController@show',
        'controller' => 'App\\Http\\Controllers\\OrderController@show',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'orders.edit' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'orders/{order}/edit',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'orders.edit',
        'uses' => 'App\\Http\\Controllers\\OrderController@edit',
        'controller' => 'App\\Http\\Controllers\\OrderController@edit',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'orders.update' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
        1 => 'PATCH',
      ),
      'uri' => 'orders/{order}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'orders.update',
        'uses' => 'App\\Http\\Controllers\\OrderController@update',
        'controller' => 'App\\Http\\Controllers\\OrderController@update',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'orders.destroy' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'orders/{order}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'orders.destroy',
        'uses' => 'App\\Http\\Controllers\\OrderController@destroy',
        'controller' => 'App\\Http\\Controllers\\OrderController@destroy',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
    'generated::98YTHCrm6J6mUqhz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'gdrive',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'C:32:"Opis\\Closure\\SerializableClosure":354:{@2cEal0OXRKBEIxrdQNXoKL/VGmxAOWuyvdW3vo4vGXw=.a:5:{s:3:"use";a:0:{}s:8:"function";s:141:"function() {
  \\Storage::disk(\'google\')->put(\'test.txt\', \'Hello World\');
  $url = \\Storage::disk(\'google\')->url(\'test.txt\');
  return $url;
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"000000001e4d07bd000000005677449f";}}',
        'namespace' => NULL,
        'prefix' => NULL,
        'where' => 
        array (
        ),
        'as' => 'generated::98YTHCrm6J6mUqhz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
    ),
  ),
)
);
