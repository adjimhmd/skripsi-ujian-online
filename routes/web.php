<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return redirect('/home');
// });
Route::get('/', [App\Http\Controllers\HomeGuestController::class, 'index'])->name('guest');
Route::get('home-instansi', [App\Http\Controllers\HomeGuestController::class, 'home_instansi'])->name('home.instansi');
Route::get('home-kelas-program', [App\Http\Controllers\HomeGuestController::class, 'home_kelas_program'])->name('home.kelas.program');
Route::get('home-mapel', [App\Http\Controllers\HomeGuestController::class, 'home_mapel'])->name('home.mapel');

Route::group(['middleware' => 'revalidate'], function()
{
  Auth::routes(['verify' => true]);
});
Route::namespace('Auth')->group(function () {
    Route::get('guru/register', [App\Http\Controllers\Auth\RegisterController::class, 'show_guru_form'])->name('guru.register');
    Route::post('guru/register', [App\Http\Controllers\Auth\RegisterController::class, 'process_guru'])->name('guru.proses');

    Route::get('siswa/register', [App\Http\Controllers\Auth\RegisterController::class, 'show_siswa_form'])->name('siswa.register');
    Route::post('siswa/register', [App\Http\Controllers\Auth\RegisterController::class, 'process_siswa'])->name('siswa.proses');

    Route::get('instansi/register', [App\Http\Controllers\Auth\RegisterController::class, 'show_instansi_form'])->name('instansi.register');
    Route::post('instansi/register', [App\Http\Controllers\Auth\RegisterController::class, 'process_instansi'])->name('instansi.proses');
  });

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('role:siswa|guru|adm_sistem|adm_instansi')->name('home');
Route::patch('upload-verifikasi/{id}', [App\Http\Controllers\HomeController::class, 'upload'])->middleware('role:guru|siswa|adm_lembaga|adm_instansi')->name('upload.verifikasi');

Route::resource('instansi-pendidikan', App\Http\Controllers\InstansiPendidikanController::class)->middleware('role:adm_instansi');

Route::resource('list-instansi', App\Http\Controllers\InstansiSiswaController::class)->middleware('role:siswa|guru');
Route::post('show_kelas_program', [App\Http\Controllers\InstansiSiswaController::class, 'show_kelas_program'])->name('show.kelas_program')->middleware('role:siswa');
Route::post('select_rombongan', [App\Http\Controllers\InstansiSiswaController::class, 'select_rombongan'])->name('select.rombongan')->middleware('role:siswa');
Route::post('daftar_siswa', [App\Http\Controllers\InstansiSiswaController::class, 'daftar_siswa'])->name('daftar.siswa')->middleware('role:siswa');
Route::get('siswa/list-kelas-program', [App\Http\Controllers\InstansiSiswaController::class, 'index_kelas_program'])->middleware('role:siswa')->name('list.kelas.program');
Route::get('guru/list-kelas-program', [App\Http\Controllers\InstansiSiswaController::class, 'index_kelas_program_guru'])->middleware('role:guru')->name('list.kelas.program.guru');
Route::post('bayar-dulu', [App\Http\Controllers\InstansiSiswaController::class, 'bayar_dulu'])->name('bayar.dulu')->middleware('role:siswa');
Route::post('upload_bayar', [App\Http\Controllers\InstansiSiswaController::class, 'upload_bayar'])->name('upload.bayar')->middleware('role:siswa');
Route::get('terima_lembaga', [App\Http\Controllers\InstansiSiswaController::class, 'terima_lembaga'])->name('terima.lembaga')->middleware('role:guru');

Route::resource('verifikasi', App\Http\Controllers\Admin_Sistem\VerifikasiUserController::class)->middleware('role:adm_sistem');

Route::resource('master-mapel', App\Http\Controllers\MasterMapelController::class)->middleware('role:adm_sistem');

Route::resource('master-kelas', App\Http\Controllers\MasterKelasController::class)->middleware('role:adm_sistem');

Route::resource('master-tahun-ajaran', App\Http\Controllers\MasterTahunAjaranController::class)->middleware('role:adm_sistem');

Route::resource('ruang-ujian', App\Http\Controllers\RuangUjianController::class)->middleware('role:adm_instansi|siswa|guru');
Route::post('rating', [App\Http\Controllers\RuangUjianController::class, 'rating'])->name('rating')->middleware('role:siswa');

Route::resource('nilai-ujian', App\Http\Controllers\NilaiUjianController::class)->middleware('role:adm_instansi');
Route::post('email-nilai', [App\Http\Controllers\NilaiUjianController::class, 'email'])->name('email.nilai')->middleware('role:adm_instansi');
Route::get('detail-nilai-ujian/{nilai}', [App\Http\Controllers\NilaiUjianController::class, 'detail_nilai_ujian'])->name('detail.nilai.ujian')->middleware('role:adm_instansi');

Route::post('show_paket', [App\Http\Controllers\RuangUjianController::class, 'show_paket'])->name('show.paket')->middleware('role:adm_instansi');
Route::post('ujian-siswa', [App\Http\Controllers\RuangUjianController::class, 'ujian_siswa'])->name('ujian.siswa')->middleware('role:siswa');
Route::get('hasil-ujian/{hasil_ujian}', [App\Http\Controllers\RuangUjianController::class, 'hasil_ujian'])->name('hasil.ujian')->middleware('role:adm_instansi|guru');
Route::post('update-nilai', [App\Http\Controllers\RuangUjianController::class, 'update_nilai'])->name('update.nilai')->middleware('role:adm_instansi|guru');

Route::resource('bank_soals', App\Http\Controllers\BankSoalController::class)->middleware('role:guru');
Route::resource('materi-pembelajaran', App\Http\Controllers\MateriPembelajaranController::class)->middleware('role:guru');

Route::resource('paket_soal', App\Http\Controllers\PaketSoalController::class)->middleware('role:guru|adm_instansi');
Route::post('show_guru_paket', [App\Http\Controllers\PaketSoalController::class, 'show_guru_paket'])->name('show.guru.paket')->middleware('role:guru|adm_instansi');
Route::post('update_guru_paket', [App\Http\Controllers\PaketSoalController::class, 'update_guru_paket'])->name('update.guru.paket')->middleware('role:guru|adm_instansi');
Route::post('pilih_soal', [App\Http\Controllers\PaketSoalController::class, 'pilih_soal'])->name('pilih.soal')->middleware('role:guru|adm_instansi');
Route::post('hapus_soal', [App\Http\Controllers\PaketSoalController::class, 'hapus_soal'])->name('hapus.soal')->middleware('role:guru|adm_instansi');

Route::resource('profile', App\Http\Controllers\ProfileController::class)->middleware('role:siswa|guru|adm_instansi|adm_sistem');
Route::get('rating-guru/{rating_guru}', [App\Http\Controllers\ProfileController::class, 'show'])->name('rating.guru')->middleware('role:siswa|guru');
Route::get('rating-instansi/{rating_instansi}', [App\Http\Controllers\ProfileController::class, 'show'])->name('rating.instansi')->middleware('role:siswa|guru');

Route::post('show_kota', [App\Http\Controllers\InstansiPendidikanController::class, 'show_kota'])->name('show.kota')->middleware('role:adm_instansi');
Route::post('show_kecamatan', [App\Http\Controllers\InstansiPendidikanController::class, 'show_kecamatan'])->name('show.kecamatan')->middleware('role:adm_instansi');
Route::post('show_desa', [App\Http\Controllers\InstansiPendidikanController::class, 'show_desa'])->name('show.desa')->middleware('role:adm_instansi');

Route::resource('kelas-program', App\Http\Controllers\KelasProgramController::class)->middleware('role:adm_instansi|siswa');
Route::post('show_guru', [App\Http\Controllers\KelasProgramController::class, 'show_guru'])->name('show.guru')->middleware('role:adm_instansi');
Route::post('update_guru', [App\Http\Controllers\KelasProgramController::class, 'update_guru'])->name('update.guru')->middleware('role:adm_instansi');
Route::post('edit_harga', [App\Http\Controllers\KelasProgramController::class, 'edit_harga'])->name('edit.harga')->middleware('role:adm_instansi');
Route::post('update_harga', [App\Http\Controllers\KelasProgramController::class, 'update_harga'])->name('update.harga')->middleware('role:adm_instansi');
Route::post('pilih_materi', [App\Http\Controllers\KelasProgramController::class, 'pilih_materi'])->name('pilih.materi')->middleware('role:adm_instansi');
Route::post('hapus_materi', [App\Http\Controllers\KelasProgramController::class, 'hapus_materi'])->name('hapus.materi')->middleware('role:adm_instansi');
Route::post('update_private', [App\Http\Controllers\KelasProgramController::class, 'update_private'])->name('update.private')->middleware('role:adm_instansi');

Route::resource('list-guru', App\Http\Controllers\ListGuruController::class)->middleware('role:adm_instansi');
Route::get('daftar_guru', [App\Http\Controllers\ListGuruController::class, 'daftar_guru'])->name('daftar.guru')->middleware('role:adm_instansi');
Route::get('terima_guru', [App\Http\Controllers\ListGuruController::class, 'terima_guru'])->name('terima.guru')->middleware('role:adm_instansi');
Route::post('simpan_guru', [App\Http\Controllers\ListGuruController::class, 'simpan_guru'])->name('simpan.guru')->middleware('role:adm_instansi|guru');
Route::post('valid_guru', [App\Http\Controllers\ListGuruController::class, 'valid_guru'])->name('valid.guru')->middleware('role:adm_instansi|guru');

Route::get('/sendmail', 'App\Http\Controllers\EmailController@index');

Route::resource('orders', App\Http\Controllers\OrderController::class);

Route::get('gdrive', function() {
  Storage::disk('google')->put('test.txt', 'Hello World');
  $url = Storage::disk('google')->url('test.txt');
  return $url;
});