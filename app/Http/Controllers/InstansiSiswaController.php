<?php

namespace App\Http\Controllers;

use App\Models\GuruInstansi;
use App\Models\HargaKelasProgram;
use App\Models\InstansiPendidikan;
use App\Models\KelasProgram;
use App\Models\MapelKelasProgram;
use App\Models\MasterKelas;
use App\Models\MasterMapel;
use App\Models\MasterTahunAjaran;
use App\Models\RombonganBelajar;
use App\Models\User;
use App\Models\UserGuru;
use App\Models\UserSiswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class InstansiSiswaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id = Auth::user()->id;

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();


        $jenjangs = UserSiswa::select('tingkat')
            ->join('master_kelas', 'user_siswas.master_kelas_id', '=', 'master_kelas.id')
            ->where('user_id', '=', $id)
            ->first();

        $role = DB::table('model_has_roles')
            ->select('role_id')
            ->where('model_id', '=', $id)
            ->first();
        
        // if siswa
        if($role->role_id==1){
            $list_sekolah = InstansiPendidikan::select('instansi_pendidikans.id','instansi_pendidikans.nama as instansi','alamat','jenjang','tipe','nomor_induk','indonesia_provinces.name as provinsi','indonesia_cities.name as kota','indonesia_districts.name as kecamatan','indonesia_villages.name as desa')
                ->join('indonesia_villages', 'instansi_pendidikans.desa_id', '=', 'indonesia_villages.id')
                ->join('indonesia_districts', 'indonesia_villages.district_id', '=', 'indonesia_districts.id')
                ->join('indonesia_cities', 'indonesia_districts.city_id', '=', 'indonesia_cities.id')
                ->join('indonesia_provinces', 'indonesia_cities.province_id', '=', 'indonesia_provinces.id')
                ->where('instansi_pendidikans.tipe', '=', 'sekolah')
                ->where('instansi_pendidikans.jenjang', '=', $jenjangs->tingkat ?? '')
                ->get();

            $list_lembaga_kursus = InstansiPendidikan::select('instansi_pendidikans.id','instansi_pendidikans.nama as instansi','alamat','jenjang','tipe','nomor_induk','indonesia_provinces.name as provinsi','indonesia_cities.name as kota','indonesia_districts.name as kecamatan','indonesia_villages.name as desa')
                ->join('indonesia_villages', 'instansi_pendidikans.desa_id', '=', 'indonesia_villages.id')
                ->join('indonesia_districts', 'indonesia_villages.district_id', '=', 'indonesia_districts.id')
                ->join('indonesia_cities', 'indonesia_districts.city_id', '=', 'indonesia_cities.id')
                ->join('indonesia_provinces', 'indonesia_cities.province_id', '=', 'indonesia_provinces.id')
                ->where('instansi_pendidikans.tipe', '=', 'lembaga_kursus')
                ->where('instansi_pendidikans.jenjang', '=', $jenjangs->tingkat ?? '')
                ->get();
        }
        // if guru
        elseif($role->role_id==2){
            $id_guru=UserGuru::where('user_id',$id)->first();
            $list_sekolah = GuruInstansi::select('instansi_pendidikans.id','instansi_pendidikans.nama as instansi','alamat','jenjang','tipe','nomor_induk','indonesia_provinces.name as provinsi','indonesia_cities.name as kota','indonesia_districts.name as kecamatan','indonesia_villages.name as desa')
                ->join('instansi_pendidikans', 'guru_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
                ->join('indonesia_villages', 'instansi_pendidikans.desa_id', '=', 'indonesia_villages.id')
                ->join('indonesia_districts', 'indonesia_villages.district_id', '=', 'indonesia_districts.id')
                ->join('indonesia_cities', 'indonesia_districts.city_id', '=', 'indonesia_cities.id')
                ->join('indonesia_provinces', 'indonesia_cities.province_id', '=', 'indonesia_provinces.id')
                ->where('instansi_pendidikans.tipe', '=', 'sekolah')
                ->where('guru_instansis.user_guru_id', '=', $id_guru->id)
                ->get();

            $list_lembaga_kursus = GuruInstansi::select('instansi_pendidikans.id','instansi_pendidikans.nama as instansi','alamat','jenjang','tipe','nomor_induk','indonesia_provinces.name as provinsi','indonesia_cities.name as kota','indonesia_districts.name as kecamatan','indonesia_villages.name as desa')
                ->join('instansi_pendidikans', 'guru_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
                ->join('indonesia_villages', 'instansi_pendidikans.desa_id', '=', 'indonesia_villages.id')
                ->join('indonesia_districts', 'indonesia_villages.district_id', '=', 'indonesia_districts.id')
                ->join('indonesia_cities', 'indonesia_districts.city_id', '=', 'indonesia_cities.id')
                ->join('indonesia_provinces', 'indonesia_cities.province_id', '=', 'indonesia_provinces.id')
                ->where('instansi_pendidikans.tipe', '=', 'lembaga_kursus')
                ->where('guru_instansis.user_guru_id', '=', $id_guru->id)
                ->get();

            }


        $siswa = UserSiswa::select('user_siswas.*','master_kelas.tingkat','master_kelas.kelas')
            ->join('master_kelas', 'user_siswas.master_kelas_id', '=', 'master_kelas.id')
            ->where('user_id',$id)
            ->first();

        $last_update = InstansiPendidikan::select('updated_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $jumlah_lembaga_kursus = InstansiPendidikan::select('*')
            ->where('instansi_pendidikans.tipe', '=', 'lembaga_kursus')
            ->count();

        $jumlah_sekolah = InstansiPendidikan::select('*')
            ->where('instansi_pendidikans.tipe', '=', 'sekolah')
            ->count();

        // return$jumlah_lembaga_kursus;
            
        return view('AdminLTE/list_instansi', compact('foto_profil','id','list_sekolah','list_lembaga_kursus','last_update','jumlah_sekolah','jumlah_lembaga_kursus','user_admin_instansis','siswa'));
    }

    public function index_kelas_program()
    {
        //
        $id = Auth::user()->id;

        $id_siswa = UserSiswa::where('user_id',$id)->first();

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $list_kelass = RombonganBelajar::select(
            'instansi_pendidikans.id as id_instansi_pendidikan','instansi_pendidikans.nama as nama_instansi','instansi_pendidikans.*',
            'harga_kelas_programs.id as id_harga','harga_kelas_programs.*',
            'master_kelas.id as id_master_kelas','master_kelas.*',
            'user_siswas.id as id_user_siswa','user_siswas.*',
            'users.id as id_user','users.*',
            'kelas_programs.id as id_kelas_program','kelas_programs.*','kelas_programs.deskripsi as kls_program',
            'rombongan_belajars.id as id_rombongan_belajar','rombongan_belajars.*')
            ->join('kelas_programs', 'rombongan_belajars.kelas_program_id', '=', 'kelas_programs.id')
            ->join('harga_kelas_programs', 'rombongan_belajars.harga_kelas_program_id', '=', 'harga_kelas_programs.id')
            ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
            ->join('user_siswas', 'rombongan_belajars.user_siswa_id', '=', 'user_siswas.id')
            ->join('users', 'user_siswas.user_id', '=', 'users.id')
            ->where('user_siswa_id',$id_siswa->id)
            ->get();
            
        $mapel_rombels = RombonganBelajar::select('rombongan_belajars.id as id_rombongan_belajar','master_mapels.*')
            ->join('kelas_programs', 'rombongan_belajars.kelas_program_id', '=', 'kelas_programs.id')
            ->join('mapel_kelas_programs', 'kelas_programs.id', '=', 'mapel_kelas_programs.kelas_program_id')
            ->join('master_mapels', 'mapel_kelas_programs.master_mapel_id', '=', 'master_mapels.id')
            ->where('user_siswa_id',$id_siswa->id)
            ->get();

        $total_ujians=DB::table('master_ruang_ujians')
            ->select(DB::raw('kelas_program_id,count(*) as jumlah'))           
            ->groupBy('kelas_program_id')
            ->where('waktu_selesai','>',Carbon::now())
            ->get();
        
        // return$total_ujians;

        $last_update = InstansiPendidikan::select('updated_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $id_siswa = UserSiswa::select('id')->where('user_id',$id)->first();

        $jumlah_terdaftar = RombonganBelajar::select('*')
            ->where('status', '1')
            ->where('user_siswa_id', $id_siswa->id)
            ->count();

        $jumlah_menunggu = RombonganBelajar::select('*')
            ->where('status', '0')
            ->where('user_siswa_id', $id_siswa->id)
            ->count();

        // return$mapel_rombels;
        return view('AdminLTE/list_kelas', compact('foto_profil','id','list_kelass','last_update','jumlah_terdaftar','jumlah_menunggu','user_admin_instansis','total_ujians','mapel_rombels'));
    }

    public function index_kelas_program_guru()
    {
        //
        $id = Auth::user()->id;

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $list_kelass = KelasProgram::select(
            'instansi_pendidikans.id as id_instansi_pendidikan','instansi_pendidikans.nama as nama_instansi','instansi_pendidikans.*',
            'master_kelas.id as id_master_kelas','master_kelas.*',
            'master_mapels.id as id_master_mapel','master_mapels.nama as nama_mapel','master_mapels.*',
            // 'user_gurus.id as id_user_guru','user_gurus.*',
            // 'users.id as id_user','users.*',
            'kelas_programs.id as id_kelas_program','kelas_programs.*')
            ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
            ->join('master_mapels', 'kelas_programs.master_mapel_id', '=', 'master_mapels.id')
            // ->join('user_gurus', 'kelas_programs.user_guru_id', '=', 'user_gurus.id')
            // ->join('users', 'user_gurus.user_id', '=', 'users.id')
            ->get();

        // return$list_kelass;


        $last_update = InstansiPendidikan::select('updated_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $id_siswa = UserGuru::select('id')->where('user_id',$id)->first();

        $total_kelas = KelasProgram::select('*')
            ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            // ->where('user_guru_id', $id_siswa->id)
            ->where('tipe', 'sekolah')
            ->count();

        $total_program = KelasProgram::select('*')
            ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            // ->where('user_guru_id', $id_siswa->id)
            ->where('tipe', 'lembaga_kursus')
            ->count();

        return view('AdminLTE/list_kelas', compact('foto_profil','id','list_kelass','last_update','total_kelas','total_program','user_admin_instansis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function show_kelas_program(Request $request){
        $id = Auth::user()->id;

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $last_updates = KelasProgram::select('updated_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $jumlahs = KelasProgram::select('*')->count();
            
        $user_admin_instansis = User::select('user_admin_instansis.id as id_adm_instansi','instansi_pendidikans.id as id_instansi','instansi_pendidikans.tipe')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('instansi_pendidikans.id', '=', $request->id_instansi)
            ->get();

        $jenjang_instansis = InstansiPendidikan::select('instansi_pendidikans.jenjang')->where('id', '=', $request->id_instansi)->first();

        $kelass = MasterKelas::select('*')
            ->where('tingkat', '=', $jenjang_instansis->jenjang)
            ->orderBy('kelas')
            ->get();

        $siswa_totals = RombonganBelajar::select('*')->get();

        $mapels = MasterMapel::select('*')->orderBy('nama')->orderBy('materi')->get();
        
        $tahun_ajarans = MasterTahunAjaran::select('*')->orderBy('tahun_awal')->orderBy('semester')->get();

        $nama_instansis = InstansiPendidikan::select('instansi_pendidikans.nama')->where('id', '=', $request->id_instansi)->get();

        $id_siswa = UserSiswa::select('id')->where('user_id',$id)->first();
        $rombongans=RombonganBelajar::where('user_siswa_id',$id_siswa->id)->get();
        $kelas_program_id = $rombongans->pluck('kelas_program_id')->toArray();

        $kelas_programs = KelasProgram::select('kelas_programs.id as id_kelas_program','kelas_programs.*','master_kelas.tingkat','master_kelas.kelas')
            ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
            ->where('instansi_pendidikan_id', '=', $request->id_instansi)
            ->where('master_kelas_id', '=', $request->id_master_kelas)
            ->orderBy('master_kelas.kelas')
            ->orderBy('kelas_programs.deskripsi')
            ->get();

        if($rombongans){
            $kelas_programs = KelasProgram::select('kelas_programs.id as id_kelas_program','kelas_programs.*','master_kelas.tingkat','master_kelas.kelas')
                ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
                ->where('instansi_pendidikan_id', '=', $request->id_instansi)
                ->where('master_kelas_id', '=', $request->id_master_kelas)
                ->whereNotIn('kelas_programs.id',$kelas_program_id)
                ->orderBy('master_kelas.kelas')
                ->orderBy('kelas_programs.deskripsi')
                ->get();
        }

        $id_kelas_program[]='';

        if(!$kelas_programs->isEmpty()){
            foreach($kelas_programs as $kelas_program){
                $id_kelas_program[]=$kelas_program->id_kelas_program;
            }
        }

        $mapel_kelas_programs = MapelKelasProgram::select('mapel_kelas_programs.*','master_mapels.nama')
                ->join('master_mapels', 'mapel_kelas_programs.master_mapel_id', '=', 'master_mapels.id')
                ->whereIn('kelas_program_id',$id_kelas_program)
                ->get();

        $harga_kelas_programs = HargaKelasProgram::whereIn('kelas_program_id',$id_kelas_program)->get();


        return view('AdminLTE/kelas_program', compact('foto_profil','id','user_admin_instansis','last_updates','jumlahs','kelass','mapels','tahun_ajarans','siswa_totals','nama_instansis','kelas_programs','mapel_kelas_programs','harga_kelas_programs'));

        // $id_siswa = UserSiswa::select('id')->where('user_id',Auth::user()->id)->first();
        // $rombongans=RombonganBelajar::where('user_siswa_id',$id_siswa->id)->get();

        // $data_kelas = KelasProgram::select(
        //     'instansi_pendidikans.*',
        //     'kelas_programs.id as id_kelas_program','kelas_programs.*',
        //     'master_kelas.id as id_master_kelas','master_kelas.*',
        //     'master_mapels.id as id_master_mapel','master_mapels.nama as nama_mapel','master_mapels.*')
        //     ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
        //     ->join('master_mapels', 'kelas_programs.master_mapel_id', '=', 'master_mapels.id')
        //     ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
        //     ->where('kelas_programs.master_kelas_id',$request->master_kelas_id)
        //     ->where('instansi_pendidikans.id',$request->id)
        //     ->get();

        // $kelas_program_id = $rombongans->pluck('kelas_program_id')->toArray();
        // if($rombongans){
        //     $data_kelas = KelasProgram::select(
        //         'instansi_pendidikans.*',
        //         'kelas_programs.id as id_kelas_program','kelas_programs.*',
        //         'master_kelas.id as id_master_kelas','master_kelas.*',
        //         'master_mapels.id as id_master_mapel','master_mapels.nama as nama_mapel','master_mapels.*')
        //         ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
        //         ->join('master_mapels', 'kelas_programs.master_mapel_id', '=', 'master_mapels.id')
        //         ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
        //         ->whereNotIn('kelas_programs.id',$kelas_program_id)
        //         ->where('kelas_programs.master_kelas_id',$request->master_kelas_id)
        //         ->where('instansi_pendidikans.id',$request->id)
        //         ->get();

        // }

        // return json_encode(array('data'=>$data_kelas));
    }

    public function select_rombongan(Request $request){
        $id_siswa = UserSiswa::where('user_id',Auth::user()->id)->first();

        $rombongan = RombonganBelajar::where('kelas_program_id', '=', $request->id_kelas_program)
            ->where('user_siswa_id', '=', $id_siswa->id)
            ->get();

        // dd($rombongan);

        return json_encode(array('data'=>$rombongan));
    }
    
    public function daftar_siswa(Request $request){
        $id_user = Auth::user()->id;
        $id_siswa = UserSiswa::select('id')
            ->where('user_id',$id_user)
            ->first();
        $profil=User::select('foto')->where('id',$id_user)->first();

        $harga_kelas=HargaKelasProgram::select('harga')->where('kelas_program_id',$request->id_kelas_program)->first();
        // return$harga_kelas;
        
        if($profil->foto==null){
            return redirect()->route('profile.index')
            ->with('warning', 'Silahkan lengkapi profile untuk melanjutkan pendaftaran kelas/program kursus!');
        }
        else if($harga_kelas->harga=='0'){
            $rombongan=RombonganBelajar::create([
                'kelas_program_id' => $request->input('id_kelas_program'),
                'user_siswa_id' => $id_siswa->id,
                'status' => '0',
            ]); 

            return redirect()->route('list.kelas.program');
            
        }
        else{
            // return $request;
            $rombongan=RombonganBelajar::create([
                'kelas_program_id' => $request->input('id_kelas_program'),
                'user_siswa_id' => $id_siswa->id,
                'harga_kelas_program_id' => $request->id_harga,
            ]); 

            $id_rombongan_belajar=$rombongan->id;
            $data = RombonganBelajar::select(
                'instansi_pendidikans.nama as nama_instansi','instansi_pendidikans.*',
                'harga_kelas_programs.*',
                'master_kelas.*',
                'master_mapels.*',
                'kelas_programs.*',
                // 'user_gurus.user_id as id_guru',
                'user_siswas.user_id as id_siswa')
                ->join('kelas_programs', 'rombongan_belajars.kelas_program_id', '=', 'kelas_programs.id')
                ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
                ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
                ->join('harga_kelas_programs', 'kelas_programs.id', '=', 'harga_kelas_programs.kelas_program_id')
                ->join('mapel_kelas_programs', 'kelas_programs.id', '=', 'mapel_kelas_programs.kelas_program_id')
                ->join('master_mapels', 'mapel_kelas_programs.master_mapel_id', '=', 'master_mapels.id')
                // ->leftJoin('user_gurus', 'kelas_programs.user_guru_id', '=', 'user_gurus.id')
                ->join('user_siswas', 'rombongan_belajars.user_siswa_id', '=', 'user_siswas.id')
                ->where('rombongan_belajars.id',$id_rombongan_belajar)
                ->where('harga_kelas_programs.id',$request->id_harga)
                ->first();

            $nama_siswa=User::select('name')->where('id',$data->id_siswa)->first();

            if($data->id_guru){
                $nama_guru=User::select('name')->where('id',$data->id_guru)->first();
            }
            else{
                $nama_guru='Guru belum ditentukan.';
            }

            // return$data;

            return view('AdminLTE/invoice',compact('data','nama_guru','nama_siswa','id_rombongan_belajar'));
        }
        
    }

    
    public function bayar_dulu(Request $request)
    {
        //
        $id_rombongan_belajar=$request->id_rombongan_belajar;
        $data = RombonganBelajar::select(
            'instansi_pendidikans.nama as nama_instansi','instansi_pendidikans.*',
            'master_kelas.*',
            'master_mapels.*',
            'kelas_programs.*',
            // 'user_gurus.user_id as id_guru',
            'user_siswas.user_id as id_siswa')
            ->join('kelas_programs', 'rombongan_belajars.kelas_program_id', '=', 'kelas_programs.id')
            ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
            ->join('master_mapels', 'kelas_programs.master_mapel_id', '=', 'master_mapels.id')
            // ->leftJoin('user_gurus', 'kelas_programs.user_guru_id', '=', 'user_gurus.id')
            ->join('user_siswas', 'rombongan_belajars.user_siswa_id', '=', 'user_siswas.id')
            ->where('rombongan_belajars.id',$id_rombongan_belajar)
            ->first();


        $nama_siswa=User::select('id','name')->where('id',$data->id_siswa)->first();

        if($data->id_guru){
            $nama_guru=User::select('name')->where('id',$data->id_guru)->first();
        }
        else{
            $nama_guru='Guru belum ditentukan.';
        }

        $profil=User::select('foto')->where('id',$nama_siswa->id)->first();
        if($profil->foto==null){
            return redirect()->route('profile.index')
            ->with('warning', 'Silahkan lengkapi profile '.ucwords($nama_siswa->name).' untuk melanjutkan pendaftaran kelas/program kursus!');
        }
        else{
            return view('AdminLTE/invoice',compact('data','nama_guru','nama_siswa','id_rombongan_belajar'));
        }
    }
    
    public function upload_bayar(Request $request)
    {
        //
        
        $rombongan_belajar = RombonganBelajar::find($request->id_rombongan_belajar);
        
        // menyimpan data file yang diupload ke variabel $file
        if(!empty($request->file('foto_bukti'))) {
            $file = $request->file('foto_bukti');
            $nama_file = time()."_".$file->getClientOriginalName();
            
            //  isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'img/bukti_pembayaran';

            $path = public_path($tujuan_upload.'\\'.$nama_file);
            Image::make($file->getRealPath())->resize(160, 160)->save($path);

            $rombongan_belajar->update([
                'bukti_bayar' => $tujuan_upload."/".$nama_file,
                'status' => '0',
            ]); 
        }

        return redirect()->route('list.kelas.program');

    }

}
