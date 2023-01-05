<?php

namespace App\Http\Controllers;

use App\Models\BankSoal;
use App\Models\DetailUjian;
use App\Models\InstansiPendidikan;
use App\Models\Jawaban;
use App\Models\KelasProgram;
use App\Models\KomentarUjian;
use App\Models\MapelKelasProgram;
use App\Models\MasterKelas;
use App\Models\MasterPaketSoal;
use App\Models\MasterRuangUjian;
use App\Models\MasterTahunAjaran;
use App\Models\NilaiUjian;
use App\Models\PaketSoal;
use App\Models\Rating;
use App\Models\RombonganBelajar;
use App\Models\User;
use App\Models\UserAdminInstansi;
use App\Models\UserGuru;
use App\Models\UserSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class RuangUjianController extends Controller
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

        $last_update_ruang = MasterRuangUjian::select('master_ruang_ujians.updated_at')
            ->orderBy('master_ruang_ujians.updated_at', 'desc')
            ->get();

        $jumlah_ruang = MasterRuangUjian::select('*')->count();

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $nama_instansis = UserAdminInstansi::select('instansi_pendidikans.nama')
            ->join('users', 'user_admin_instansis.user_id', '=', 'users.id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $role=DB::table('model_has_roles')->where('model_id',$id)->first();
        
        // if guru
        if($role->role_id==2){
            $user_admin_instansis = User::select('users.*','user_gurus.id as id_guru','user_gurus.*','guru_instansis.id as id_guru_instansi','guru_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
                ->join('user_gurus', 'users.id', '=', 'user_gurus.user_id')
                ->join('guru_instansis', 'user_gurus.id', '=', 'guru_instansis.user_guru_id')
                ->join('instansi_pendidikans', 'guru_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
                ->where('users.id', '=', $id)
                ->get();
        }
        else{
            $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
                ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
                ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
                ->where('users.id', '=', $id)
                ->get();
        }

        $id_siswa=UserSiswa::where('user_id',$id)->first();
        $id_guru=UserGuru::where('user_id',$id)->first();

        // check if role siswa
        if ($role->role_id=='1'){
            
            $ruang_ujians=MasterRuangUjian::select('master_ruang_ujians.id as id_master_ruang_ujian','master_ruang_ujians.deskripsi as ruang_ujian','master_ruang_ujians.*','master_paket_soals.deskripsi as paket_soal','master_paket_soals.id as id_master_paket_soal','master_paket_soals.*','kelas_programs.id as id_kelas_program','kelas_programs.*','master_kelas.*','instansi_pendidikans.id as id_instansi_pendidikan','instansi_pendidikans.*','master_tahun_ajarans.tahun_awal','master_tahun_ajarans.tahun_akhir','master_tahun_ajarans.semester')
                ->join('master_paket_soals', 'master_ruang_ujians.master_paket_soal_id', '=', 'master_paket_soals.id')
                ->join('kelas_programs', 'master_ruang_ujians.kelas_program_id', '=', 'kelas_programs.id')
                ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
                ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
                ->join('rombongan_belajars', 'kelas_programs.id', '=', 'rombongan_belajars.kelas_program_id')
                ->join('master_tahun_ajarans', 'master_ruang_ujians.master_tahun_ajaran_id', '=', 'master_tahun_ajarans.id')
                ->where('rombongan_belajars.user_siswa_id',$id_siswa->id)
                ->where('rombongan_belajars.status','1')
                ->get();

            $mapel_kelas_programs=MapelKelasProgram::select('mapel_kelas_programs.*','master_mapels.nama')
            ->join('master_mapels', 'mapel_kelas_programs.master_mapel_id', '=', 'master_mapels.id')
            ->get();

            return view('AdminLTE/master-ruang-ujian', compact('nama_instansis','foto_profil','user_admin_instansis','last_update_ruang','jumlah_ruang','ruang_ujians','mapel_kelas_programs'));
        }
        // check if guru
        else if ($role->role_id=='2'){
            
            $ruang_ujians=MasterRuangUjian::select('master_ruang_ujians.id as id_master_ruang_ujian','master_ruang_ujians.deskripsi as ruang_ujian','master_ruang_ujians.*','master_paket_soals.deskripsi as paket_soal','master_paket_soals.id as id_master_paket_soal','master_paket_soals.*','kelas_programs.id as id_kelas_program','kelas_programs.*','master_kelas.*','instansi_pendidikans.id as id_instansi_pendidikan','instansi_pendidikans.*','master_tahun_ajarans.tahun_awal','master_tahun_ajarans.tahun_akhir','master_tahun_ajarans.semester')
                ->join('master_paket_soals', 'master_ruang_ujians.master_paket_soal_id', '=', 'master_paket_soals.id')
                ->join('guru_paket_soals', 'master_paket_soals.id', '=', 'guru_paket_soals.master_paket_soal_id')
                ->join('kelas_programs', 'master_ruang_ujians.kelas_program_id', '=', 'kelas_programs.id')
                ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
                ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
                ->join('master_tahun_ajarans', 'master_ruang_ujians.master_tahun_ajaran_id', '=', 'master_tahun_ajarans.id')
                ->where('guru_paket_soals.user_guru_id',$id_guru->id)
                ->get();

            $mapel_kelas_programs=MapelKelasProgram::select('mapel_kelas_programs.*','master_mapels.nama')
            ->join('master_mapels', 'mapel_kelas_programs.master_mapel_id', '=', 'master_mapels.id')
            ->get();

            return view('AdminLTE/master-ruang-ujian', compact('nama_instansis','foto_profil','user_admin_instansis','last_update_ruang','jumlah_ruang','ruang_ujians','mapel_kelas_programs'));
        }
        
        foreach($user_admin_instansis as $user_admin_instansi){
            $kelas_programs=KelasProgram::select('kelas_programs.id as id_kelas_program','kelas_programs.*','master_kelas.*')
            ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
            ->where('instansi_pendidikan_id',$user_admin_instansi->instansi_pendidikan_id)
            ->orderBy('kelas_programs.deskripsi')
            ->orderBy('master_kelas.kelas')
            ->get();

            $mapel_kelas_programs=MapelKelasProgram::select('mapel_kelas_programs.*','master_mapels.nama')
            ->join('master_mapels', 'mapel_kelas_programs.master_mapel_id', '=', 'master_mapels.id')
            ->get();

            $ruang_ujians=MasterRuangUjian::select('master_ruang_ujians.id as id_master_ruang_ujian','master_ruang_ujians.deskripsi as ruang_ujian','master_ruang_ujians.*','master_paket_soals.deskripsi as paket_soal','master_paket_soals.id as id_master_paket_soal','master_paket_soals.*','kelas_programs.id as id_kelas_program','kelas_programs.*','master_kelas.*','instansi_pendidikans.nama as nama','master_tahun_ajarans.tahun_awal','master_tahun_ajarans.tahun_akhir','master_tahun_ajarans.semester')
            ->join('master_paket_soals', 'master_ruang_ujians.master_paket_soal_id', '=', 'master_paket_soals.id')
            ->join('kelas_programs', 'master_ruang_ujians.kelas_program_id', '=', 'kelas_programs.id')
            ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
            ->join('master_tahun_ajarans', 'master_ruang_ujians.master_tahun_ajaran_id', '=', 'master_tahun_ajarans.id')
            ->where('kelas_programs.instansi_pendidikan_id',$user_admin_instansi->instansi_pendidikan_id)
            ->get();
        }

        $tahun_ajarans = MasterTahunAjaran::where('tahun_akhir','>=',Carbon::now()->year)->get();

        return view('AdminLTE/master-ruang-ujian', compact('nama_instansis','foto_profil','user_admin_instansis','last_update_ruang','jumlah_ruang','kelas_programs','ruang_ujians','tahun_ajarans','mapel_kelas_programs'));

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
        // return $request;
        $request->validate([
            'deskripsi' => ['string','max:100'],
        ]);

        MasterRuangUjian::create([
            'deskripsi' => $request->input('deskripsi'),
            'master_paket_soal_id' => $request->input('paket_soal'),
            'master_tahun_ajaran_id' => $request->input('tahun_ajaran'),
            'kelas_program_id' => $request->input('kelas_program'),
            'batas' => $request->input('batas'),
            'durasi' => $request->input('durasi'),
            'waktu_mulai' => $request->input('waktu_mulai'),
            'waktu_selesai' => Carbon::parse($request->input('waktu_mulai'))->addMinutes($request->input('durasi')),
        ]); 

        $request->session()->flash('success', 'Paket soal '.$request->input('deskripsi').' berhasil disimpan!');

        return redirect()->route('ruang-ujian.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return $id;
        $id_user = Auth::user()->id;


        $id_user_siswa='';
        $rating_ruang_ujian='';
        if (Auth::user()->hasRole('siswa')){
            $id_user_siswa = UserSiswa::select('id')->where('user_id',$id_user)->first();

            $rating_ruang_ujian = Rating::where('master_ruang_ujian_id',$id)
                ->where('user_siswa_id',$id_user_siswa->id)
                ->get();
        }
        
        $last_update_ruang = MasterRuangUjian::select('master_ruang_ujians.updated_at')
            ->orderBy('master_ruang_ujians.updated_at', 'desc')
            ->get();

        $jumlah_ruang = MasterRuangUjian::select('*')->count();

        $foto_profil = User::select('foto')
            ->where('id', '=', $id_user)
            ->get();

        $nama_instansis = UserAdminInstansi::select('instansi_pendidikans.nama')
            ->join('users', 'user_admin_instansis.user_id', '=', 'users.id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id_user)
            ->get();

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id_user)
            ->get();

        $master_ruang_ujian=MasterRuangUjian::select('master_ruang_ujians.id as id_master_ruang_ujian','master_ruang_ujians.*','master_paket_soals.id as id_master_paket_soal','master_paket_soals.master_mapel_id as id_master_mapel','master_paket_soals.deskripsi as master_paket_soal','master_kelas.*','kelas_programs.deskripsi as kelas_program','kelas_programs.id as id_kelas_program','instansi_pendidikans.tipe','instansi_pendidikans.id as id_instansi_pendidikan','instansi_pendidikans.nama as instansi_pendidikan','master_tahun_ajarans.tahun_awal','master_tahun_ajarans.tahun_akhir','master_tahun_ajarans.semester')
            ->join('kelas_programs', 'master_ruang_ujians.kelas_program_id', '=', 'kelas_programs.id')
            ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
            ->join('master_paket_soals', 'master_ruang_ujians.master_paket_soal_id', '=', 'master_paket_soals.id')
            ->join('master_tahun_ajarans', 'master_ruang_ujians.master_tahun_ajaran_id', '=', 'master_tahun_ajarans.id')
            ->where('master_ruang_ujians.id',$id)
            ->first();
        
        $mapel_kelas_programs=MapelKelasProgram::select('master_mapels.*')
            ->join('master_mapels', 'mapel_kelas_programs.master_mapel_id', '=', 'master_mapels.id')
            ->where('kelas_program_id',$master_ruang_ujian->id_kelas_program)
            ->where('master_mapel_id',$master_ruang_ujian->id_master_mapel)
            ->first();
            
        $rombongans=RombonganBelajar::select('users.id', 'rombongan_belajars.user_siswa_id')
            ->join('user_siswas', 'rombongan_belajars.user_siswa_id', '=', 'user_siswas.id')
            ->join('users', 'user_siswas.user_id', '=', 'users.id')
            ->where('rombongan_belajars.kelas_program_id',$master_ruang_ujian->kelas_program_id)
            ->get();

        
        // $rombongan_belajars=RombonganBelajar::select('user_siswas.id as id user_siswa','user_siswas.*','users.id as id_user','users.*')
        //     ->join('user_siswas', 'rombongan_belajars.user_siswa_id', '=', 'user_siswas.id')
        //     ->join('users', 'user_siswas.user_id', '=', 'users.id')
        //     ->where('rombongan_belajars.kelas_program_id',$master_ruang_ujian->kelas_program_id)
        //     ->get();


        if(!$rombongans->isEmpty()){
            foreach($rombongans as $rombongan){
                $id_siswa_rombongan[]=$rombongan->id;
            }
        }
        else{
            $id_siswa_rombongan[]=0;
        }

        $rombongan_belajars=DetailUjian::select('user_siswas.id as id_user_siswa','user_siswas.*','users.id as id_user','users.*')
            ->join('users', 'detail_ujians.user_siswa_id', '=', 'users.id')
            ->join('user_siswas', 'users.id', '=', 'user_siswas.user_id')
            ->where('detail_ujians.master_ruang_ujian_id',$master_ruang_ujian->id_master_ruang_ujian)
            ->whereIn('detail_ujians.user_siswa_id',$id_siswa_rombongan)
            ->groupBy('detail_ujians.user_siswa_id')
            ->get();

        // $nilai=DetailUjian::select('detail_ujians.nilai','detail_ujians.user_siswa_id','bank_soals.tipe_soal')
        //     ->join('bank_soals', 'detail_ujians.bank_soal_id', '=', 'bank_soals.id')
        //     ->where('detail_ujians.master_ruang_ujian_id',$master_ruang_ujian->id_master_ruang_ujian)
        //     ->whereIn('detail_ujians.user_siswa_id',$id_siswa_rombongan)
        //     ->get();

        $nilai=NilaiUjian::where('nilai_ujians.master_ruang_ujian_id',$master_ruang_ujian->id_master_ruang_ujian)
            ->whereIn('nilai_ujians.user_siswa_id',$id_siswa_rombongan)
            ->get();
        // return $nilai;

        $id_bank_soal=PaketSoal::where('master_paket_soal_id',$master_ruang_ujian->master_paket_soal_id)->pluck('bank_soal_id')->toArray();

        $detail_ujians=DetailUjian::where('master_ruang_ujian_id',$master_ruang_ujian->id_master_ruang_ujian)->where('user_siswa_id',$id_user)->get();

        $ujian_ke = NilaiUjian::where('master_ruang_ujian_id',$master_ruang_ujian->id_master_ruang_ujian)->where('user_siswa_id',$id_user)->max('ujian_ke');

        $bank_soals=BankSoal::select('bank_soals.*','users.foto','users.name')
            ->join('users', 'bank_soals.user_id', '=', 'users.id')
            ->whereIn('bank_soals.id',$id_bank_soal)
            ->get();
        // return$bank_soals;

        $id_guru=BankSoal::whereIn('id',$id_bank_soal)
            ->groupBy('user_id')
            ->pluck('user_id')
            ->toArray();

        $data_guru_banksoal=User::select('id','name','foto')->whereIn('id',$id_guru)->get();

        $bank_soal_penjodohans=BankSoal::whereIn('id',$id_bank_soal)->where('tipe_soal','penjodohan')->get();

        $jawabans=Jawaban::whereIn('banksoal_id',$id_bank_soal)->get();
        
        return view('AdminLTE/ruang-ujian-detail', compact('nama_instansis','foto_profil','user_admin_instansis','last_update_ruang','jumlah_ruang','master_ruang_ujian','rombongan_belajars','bank_soals','jawabans','bank_soal_penjodohans','detail_ujians','nilai','mapel_kelas_programs','ujian_ke','data_guru_banksoal','rating_ruang_ujian'));

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
        
        $ruang_ujian = MasterRuangUjian::select('master_ruang_ujians.id as id_master_ruang_ujian','master_ruang_ujians.*','kelas_programs.id as id_kelas_program','kelas_programs.deskripsi as kelas_program','kelas_programs.*','master_paket_soals.id as id_master_paket_soal','master_paket_soals.deskripsi as master_paket_soal','master_paket_soals.*')
            ->join('kelas_programs', 'master_ruang_ujians.kelas_program_id', '=', 'kelas_programs.id')
            ->join('master_paket_soals', 'master_ruang_ujians.master_paket_soal_id', '=', 'master_paket_soals.id')
            ->where('master_ruang_ujians.id',$id)
            ->first();

	    return response()->json([
	      'data' => $ruang_ujian
	    ]);
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
        // dd($request);
        $rules = array(
            'deskripsi' => 'string|max:100',
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            $request->session()->flash('danger', 'Aduh ada yang salah, coba cek lagi ya form editnya');
        }
        else{
            $ruang_ujian = MasterRuangUjian::find($id);

            $ruang_ujian->update([
                'deskripsi' => $request->input('deskripsi'),
                'master_paket_soal_id' => $request->input('id_master_paket_soal'),
                'kelas_program_id' => $request->input('id_kelas_program'),
                'durasi' => $request->input('durasi'),
                'waktu_mulai' => $request->input('waktu_mulai'),
                'waktu_selesai' => Carbon::parse($request->input('waktu_mulai'))->addMinutes($request->input('durasi')),
            ]);  
        
            $request->session()->flash('success', 'Ruang ujian '.ucwords($request->input('deskripsi')).' berhasil diperbarui!');
        }

        return response()->json([ 'success' => true ]);
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
    
    public function show_paket(Request $request)
    {
        $admin_instansi=UserAdminInstansi::where('user_id',Auth::user()->id)->first();
        $kelas_program=KelasProgram::where('id',$request->id)->first();
        $mapel_kelas_programs=MapelKelasProgram::where('kelas_program_id',$request->id)->get();

        foreach($mapel_kelas_programs as $mkp){
            $mapel_kelas_program[]=$mkp->master_mapel_id;
        }
        // $paket_soals=PaketSoal::select('master_paket_soals.*')
        //     ->join('master_paket_soals', 'paket_soals.master_paket_soal_id', '=', 'master_paket_soals.id')
        //     ->groupByRaw('master_paket_soals.id')
        //     ->where('master_paket_soals.user_admin_instansi_id',$admin_instansi->id)
        //     ->where('master_paket_soals.master_kelas_id',$kelas_program->master_kelas_id)
        //     ->where('master_paket_soals.master_mapel_id',$mapel_kelas_program->master_mapel_id)
        //     ->get();
        
        $paket_soals=PaketSoal::select('master_paket_soals.*')
            ->join('master_paket_soals', 'paket_soals.master_paket_soal_id', '=', 'master_paket_soals.id')
            ->groupByRaw('master_paket_soals.id')
            ->where('master_paket_soals.user_admin_instansi_id',$admin_instansi->id)
            ->where('master_paket_soals.master_kelas_id',$kelas_program->master_kelas_id)
            ->whereIn('master_paket_soals.master_mapel_id',$mapel_kelas_program)
            ->get();

        // dd($paket_soals);

        return json_encode(array('data'=>$paket_soals));
    }
    
    public function ujian_siswa (Request $request)
    {
        //
        $ujian_ke = NilaiUjian::where('master_ruang_ujian_id',$request->id_master_ruang_ujian)
        ->where('user_siswa_id',Auth::user()->id)
        ->max('ujian_ke');

        if($ujian_ke){
            $nilai_ujian=NilaiUjian::create([
                'master_ruang_ujian_id' => $request->input('id_master_ruang_ujian'),
                'user_siswa_id' => Auth::user()->id,
                'total_nilai' => 0,
                'ujian_ke' => $ujian_ke+1,
            ]);    
        }
        else{
            $nilai_ujian=NilaiUjian::create([
                'master_ruang_ujian_id' => $request->input('id_master_ruang_ujian'),
                'user_siswa_id' => Auth::user()->id,
                'total_nilai' => 0,
                'ujian_ke' => 1,
            ]); 
        }

        $total_nilai=0;

        // SOAL OBJEKTIF
        if($request->id_soal_objektif){
            
            for($count = 0; $count < count($request->id_soal_objektif); $count++){
                
                $kunci_jawaban=Jawaban::where('banksoal_id',$request->input('id_soal_objektif')[$count])->where('status','1')->first();
                $nilai=0;

                // bandingin kunci jawaban dengan input jawaban
                if($kunci_jawaban->id==$request->input('jawaban_objektif_'.$request->input('id_soal_objektif')[$count])){
                    $nilai=1;
                }

                DetailUjian::create([
                    'master_ruang_ujian_id' => $request->input('id_master_ruang_ujian'),
                    'user_siswa_id' => Auth::user()->id,
                    'bank_soal_id' => $request->input('id_soal_objektif')[$count],
                    'jawaban' => $request->input('jawaban_objektif_'.$request->input('id_soal_objektif')[$count]),
                    'nilai' => $nilai,
                ]); 

                $total_nilai=$total_nilai+$nilai;
            }
        }

        // SOAL SUBJEKTIF
        if($request->id_soal_subjektif){
            for($count = 0; $count < count($request->id_soal_subjektif); $count++){
                $nilai=0;

                DetailUjian::create([
                    'master_ruang_ujian_id' => $request->input('id_master_ruang_ujian'),
                    'user_siswa_id' => Auth::user()->id,
                    'bank_soal_id' => $request->input('id_soal_subjektif')[$count],
                    'jawaban' => $request->input('jawaban_subjektif_'.$request->input('id_soal_subjektif')[$count]),
                ]); 
            }
        }

        // SOAL PENJODOHAN
        if($request->id_soal_penjodohan){

            for($count = 0; $count < count($request->id_soal_penjodohan); $count++){
                
                $kunci_jawaban=BankSoal::where('id',$request->input('id_soal_penjodohan')[$count])->first();
                $nilai=0;

                // echo $kunci_jawaban->id.'==='.$request->input('jawaban_penjodohan_'.$request->input('id_soal_penjodohan')[$count]).'<br>';
            
                // bandingin kunci jawaban dengan input jawaban
                if($kunci_jawaban->id==$request->input('jawaban_penjodohan_'.$request->input('id_soal_penjodohan')[$count])){
                    $nilai=1;
                }

                DetailUjian::create([
                    'master_ruang_ujian_id' => $request->input('id_master_ruang_ujian'),
                    'user_siswa_id' => Auth::user()->id,
                    'bank_soal_id' => $request->input('id_soal_penjodohan')[$count],
                    'jawaban' => $request->input('jawaban_penjodohan_'.$request->input('id_soal_penjodohan')[$count]),
                    'nilai' => $nilai,
                ]); 

                $total_nilai=$total_nilai+$nilai;
            }
        }
        // return false;

        // SOAL TRUE-FALSE
        if($request->id_soal_truefalse){

            for($count = 0; $count < count($request->id_soal_truefalse); $count++){
                
                $kunci_jawaban=BankSoal::where('id',$request->input('id_soal_truefalse')[$count])->first();
                $nilai=0;

                // bandingin kunci jawaban dengan input jawaban
                if($kunci_jawaban->jawaban==$request->input('jawaban_truefalse_'.$request->input('id_soal_truefalse')[$count])){
                    $nilai=1;
                }

                DetailUjian::create([
                    'master_ruang_ujian_id' => $request->input('id_master_ruang_ujian'),
                    'user_siswa_id' => Auth::user()->id,
                    'bank_soal_id' => $request->input('id_soal_truefalse')[$count],
                    'jawaban' => $request->input('jawaban_truefalse_'.$request->input('id_soal_truefalse')[$count]),
                    'nilai' => $nilai,
                ]); 

                $total_nilai=$total_nilai+$nilai;
            }
        }
        $total_nilai=$total_nilai/$request->jumlah_soal*100;

        $nilai_ujian->update([
            'total_nilai' => $total_nilai,
        ]); 

        $request->session()->flash('success', 'Kamu telah selesai mengerjakan ujian');

        return redirect()->back();
    }
    
    public function hasil_ujian($id)
    {
        // return $id;
        $request=(explode("-",$id));
        $master_ruang_ujian_id=$request[0];
        $user_siswa_id=$request[1];
        $id_created_at_nilai=$request[2];
        
        $id_user = Auth::user()->id;

        $created_at_nilai=NilaiUjian::where('id',$id_created_at_nilai)->first();

        $last_update_ruang = MasterRuangUjian::select('master_ruang_ujians.updated_at')
            ->orderBy('master_ruang_ujians.updated_at', 'desc')
            ->get();

        $jumlah_ruang = MasterRuangUjian::select('*')->count();

        $foto_profil = User::select('foto')
            ->where('id', '=', $id_user)
            ->get();

        $nama_instansis = UserAdminInstansi::select('instansi_pendidikans.nama')
            ->join('users', 'user_admin_instansis.user_id', '=', 'users.id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id_user)
            ->get();

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id_user)
            ->get();

        $bank_soals=DetailUjian::select('bank_soals.*','users.name','users.foto','users.id as id_user')
            ->join('bank_soals','detail_ujians.bank_soal_id','=','bank_soals.id')
            ->join('users','bank_soals.user_id','=','users.id')
            ->where('master_ruang_ujian_id',$master_ruang_ujian_id)
            ->where('detail_ujians.created_at',$created_at_nilai->created_at)
            ->where('user_siswa_id',$user_siswa_id)
            ->get();
    
        $jawabans=DetailUjian::select('jawabans.*',)
            ->join('bank_soals','detail_ujians.bank_soal_id','=','bank_soals.id')
            ->join('jawabans','bank_soals.id','=','jawabans.banksoal_id')
            ->where('master_ruang_ujian_id',$master_ruang_ujian_id)
            ->where('detail_ujians.created_at',$created_at_nilai->created_at)
            ->where('user_siswa_id',$user_siswa_id)
            ->get();
        
        $detail_ujians=DetailUjian::select('detail_ujians.*','bank_soals.tipe_soal','bank_soals.jawaban as jawaban_siswa')
            ->where('master_ruang_ujian_id',$master_ruang_ujian_id)
            ->where('detail_ujians.created_at',$created_at_nilai->created_at)
            ->where('user_siswa_id',$user_siswa_id)
            ->join('bank_soals','detail_ujians.bank_soal_id','=','bank_soals.id')
            ->get();

        $nama_siswa=UserSiswa::join('users','user_siswas.user_id','=','users.id')->where('users.id',$user_siswa_id)->first();

        $id_user_guru='';
        $komentar_ujian='';

        if (Auth::user()->hasRole('guru')){
            $id_user_guru = UserGuru::select('id')->where('user_id',$id_user)->first();
            $id_user_siswa = UserSiswa::select('id')->where('user_id',$user_siswa_id)->first();

            $komentar_ujian = KomentarUjian::where('master_ruang_ujian_id',$master_ruang_ujian_id)
                ->where('user_guru_id',$id_user_guru->id)
                ->where('user_siswa_id',$id_user_siswa->id)
                ->first();
        }

        
        return view('AdminLTE/ruang-ujian-detail', compact('nama_instansis','foto_profil','user_admin_instansis','bank_soals','jawabans','detail_ujians','nama_siswa','master_ruang_ujian_id','komentar_ujian','id_user'));

    }

    public function update_nilai(Request $request)
    {
        // id_detail_ujian, nilai_subjektif
        $detail_ujian = DetailUjian::where('id',$request->id_detail_ujian)->first();

        $subjektif_lama=$detail_ujian->nilai;

        $detail_ujian->update([
            'nilai' => $request->input('nilai_subjektif'),
        ]); 

        $subjektif_baru=$detail_ujian->nilai;

        $nilai_ujian = NilaiUjian::where('master_ruang_ujian_id',$detail_ujian->master_ruang_ujian_id)
            ->where('user_siswa_id',$detail_ujian->user_siswa_id)
            ->where('created_at',$detail_ujian->created_at)
            ->first();
        
        // dd($nilai_ujian);

        $konversi_subjektif_lama=$subjektif_lama/$request->jumlah_soal*100;

        $total_nilai_lama=$nilai_ujian->total_nilai-$konversi_subjektif_lama;

        $konversi_subjektif_baru=$subjektif_baru/$request->jumlah_soal*100;

        $total_nilai_baru=$total_nilai_lama+$konversi_subjektif_baru;
        
        $nilai_ujian->update([
            'total_nilai' => $total_nilai_baru,
        ]); 

        // dd($request->nilai_subjektif);


        $nilai = DetailUjian::where('id',$request->id_detail_ujian)->first();

        return json_encode(array('data'=>$nilai));

    }
    
    public function update_komentar(Request $request){
        $id_siswa   =UserSiswa::where('user_id',$request->id_user_siswa)->first();
        $id_guru    =UserGuru::where('user_id',Auth::user()->id)->first();

        KomentarUjian::create([
            'master_ruang_ujian_id' => $request->input('id_master_ruang_ujian'),
            'user_guru_id' => $id_guru->id,
            'user_siswa_id' => $id_siswa->id,
            'komentar' => $request->input('komentar'),
        ]); 

        $request->session()->flash('success', 'Komentar berhasil disimpan!');
        return redirect()->back();
    }

    public function rating(Request $request){
        // return $request;
        
        $id_user_siswa  = UserSiswa::select('id')->where('user_id',Auth::user()->id)->first();
        $jml_guru       = count($request->guru);
        $pesan          = null;
        
        $rating_lembaga = null;
        $komentar_lembaga = null;
        $rating_guru = null;
        $komentar_guru = null;
        $id_user_guru = null;
        $id_instansi = null;

        if($request->lembaga!=null){
            $rating_lembaga = explode("-", $request->lembaga);
            $id_instansi    = $rating_lembaga[0];
            $rating_lembaga = $rating_lembaga[1];
            // $pesan = 'instansi pendidikan';
        }

        if($request->komentar_lembaga!=null){
            $komentar_lembaga = explode("-", $request->komentar_lembaga);
            $id_instansi      = $komentar_lembaga[0];
            $komentar_lembaga = $komentar_lembaga[1];
            // $pesan = 'instansi pendidikan';
        }


        if($request->lembaga!=null || $request->komentar_lembaga!=null){
            Rating::create([
                'master_ruang_ujian_id' => $request->input('id_master_ruang_ujian'),
                'user_siswa_id' => $id_user_siswa->id,
                'instansi_pendidikan_id' => $id_instansi,
                'angka' => $rating_lembaga,
                'komentar' => $komentar_lembaga,
            ]); 
        }

        for($i=0; $i<$jml_guru; $i++){
            if($request->guru[$i]!=null){
                $rating_guru = explode("-", $request->guru[$i]);
                $id_user_guru  = UserGuru::select('id')->where('user_id',$rating_guru[0])->first();
                $id_user_guru  = $id_user_guru->id;
                $rating_guru = $rating_guru[1];
            }
            if($request->komentar_guru[$i]!=null){
                $komentar_guru = explode("-", $request->komentar_guru[$i]);
                $id_user_guru  = UserGuru::select('id')->where('user_id',$komentar_guru[0])->first();
                $id_user_guru  = $id_user_guru->id;
                $komentar_guru = $komentar_guru[1];
            }

            if($id_user_guru!=null){
                Rating::create([
                    'master_ruang_ujian_id' => $request->input('id_master_ruang_ujian'),
                    'user_siswa_id' => $id_user_siswa->id,
                    'user_guru_id' => $id_user_guru,
                    'angka' => $rating_guru,
                    'komentar' => $komentar_guru,
                ]);
            }

                // if($pesan==null){
                //     $pesan = 'guru';
                // }
                // else if($pesan=='instansi pendidikan'){
                //     $pesan = $pesan.' dan guru';
                // }
                
            $rating_guru = null;
            $komentar_guru = null;
            $id_user_guru = null;
        }

        // if($pesan!=null){
            $request->session()->flash('success', 'Rating berhasil disimpan!');
        // }

        return redirect()->back();

    }

}
