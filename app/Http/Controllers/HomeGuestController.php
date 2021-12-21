<?php

namespace App\Http\Controllers;

use App\Models\BankSoal;
use App\Models\InstansiPendidikan;
use App\Models\KelasProgram;
use App\Models\MasterKelas;
use App\Models\MasterMapel;
use App\Models\User;
use App\Models\UserGuru;
use App\Models\UserSiswa;
use Illuminate\Http\Request;
use Auth;

class HomeGuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    
    {
        $jumlah_mapel=MasterMapel::select('*')->count();

        $jumlah_guru=UserGuru::select('*')->distinct('user_id')->count();

        $jumlah_siswa=UserSiswa::select('*')->count();
        
        $jumlah_soal=BankSoal::select('*')->count();
        
        $jumlah_sekolah_sd=InstansiPendidikan::select('*')->where('tipe','sekolah')->where('jenjang','sd')->count();
        $jumlah_sekolah_smp=InstansiPendidikan::select('*')->where('tipe','sekolah')->where('jenjang','smp')->count();
        $jumlah_sekolah_sma=InstansiPendidikan::select('*')->where('tipe','sekolah')->where('jenjang','sma')->count();
        
        $jumlah_kursus_sd=InstansiPendidikan::select('*')->where('tipe','lembaga_kursus')->where('jenjang','sd')->count();
        $jumlah_kursus_smp=InstansiPendidikan::select('*')->where('tipe','lembaga_kursus')->where('jenjang','smp')->count();
        $jumlah_kursus_sma=InstansiPendidikan::select('*')->where('tipe','lembaga_kursus')->where('jenjang','sma')->count();
        
        $list_gurus=UserGuru::select('users.*','user_gurus.*')
            ->join('users', 'user_gurus.user_id', '=', 'users.id')
            ->groupBy('user_gurus.user_id')
            ->orderBy('user_gurus.id')
            ->get();

        $list_spesialisasis=UserGuru::select('master_mapels.*','user_gurus.*')
            ->join('spesialisasis', 'user_gurus.id', '=', 'spesialisasis.user_guru_id')
            ->join('master_mapels', 'spesialisasis.master_mapel_id', '=', 'master_mapels.id')
            ->orderBy('user_gurus.id')
            ->get();

        $list_mapels=MasterMapel::select('*')->groupBy('nama')->orderBy('id')->get();
        $jumlah_materis = MasterMapel::groupBy('nama')
            ->orderBy('id')
            ->selectRaw('count(*) as total, master_mapels.*')
            ->get();
        // return$list_gurus;

        return view('AdminLTE/home-guest',compact('jumlah_mapel','jumlah_guru','jumlah_siswa','jumlah_soal','jumlah_sekolah_sd','jumlah_sekolah_smp','jumlah_sekolah_sma','jumlah_kursus_sd','jumlah_kursus_smp','jumlah_kursus_sma','list_gurus','list_spesialisasis','list_mapels','jumlah_materis'));

    }

    public function home_instansi(Request $request){
        $id = '0';

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('instansi_pendidikans.tipe')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $instansis=InstansiPendidikan::select('instansi_pendidikans.*','indonesia_villages.name as desa','indonesia_districts.name as kecamatan','indonesia_cities.name as kota','indonesia_provinces.name as provinsi')
            ->join('indonesia_villages', 'instansi_pendidikans.desa_id', '=', 'indonesia_villages.id')
            ->join('indonesia_districts', 'indonesia_villages.district_id', '=', 'indonesia_districts.id')
            ->join('indonesia_cities', 'indonesia_districts.city_id', '=', 'indonesia_cities.id')
            ->join('indonesia_provinces', 'indonesia_cities.province_id', '=', 'indonesia_provinces.id')
            ->get();
        // return$instansis;
        return view('AdminLTE/home-guest-data',compact('id','foto_profil','user_admin_instansis','instansis'));
    }

    public function home_kelas_program(Request $request){
        $id = '0';

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('instansi_pendidikans.tipe')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $kelas_programs=KelasProgram::select('kelas_programs.id as id_kelas_program','kelas_programs.*','master_kelas.*','master_mapels.nama as mapel','master_mapels.materi','user_gurus.*','users.*','instansi_pendidikans.*')
            ->join('master_mapels', 'kelas_programs.master_mapel_id', '=', 'master_mapels.id')
            ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
            ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->join('user_gurus', 'kelas_programs.user_guru_id', '=', 'user_gurus.id')
            ->join('users', 'user_gurus.user_id', '=', 'users.id')
            ->get();
        // return$kelas_programs;
        return view('AdminLTE/home-guest-data',compact('id','foto_profil','user_admin_instansis','kelas_programs'));
        
    }

    public function home_mapel(Request $request){
        $id = '0';

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('instansi_pendidikans.tipe')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();
            
        $mapels=MasterMapel::get();

        // return$kelas_programs;
        return view('AdminLTE/home-guest-data',compact('id','foto_profil','user_admin_instansis','mapels'));
    }
}
