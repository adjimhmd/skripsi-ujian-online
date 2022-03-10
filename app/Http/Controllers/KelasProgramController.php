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
use App\Models\Spesialisasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserAdminInstansi;
use App\Models\UserGuru;
use App\Models\UserSiswa;
use DB;
use Illuminate\Support\Facades\Validator;

class KelasProgramController extends Controller
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

        $last_updates = KelasProgram::select('updated_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $jumlahs = KelasProgram::select('*')->count();

        $nama_instansis = UserAdminInstansi::select('instansi_pendidikans.nama')
            ->join('users', 'user_admin_instansis.user_id', '=', 'users.id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('user_admin_instansis.id as id_adm_instansi','instansi_pendidikans.id as id_instansi','instansi_pendidikans.tipe')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $jenjang_instansis = UserAdminInstansi::select('instansi_pendidikans.jenjang')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('user_admin_instansis.user_id', '=', $id)
            ->first();

        $kelass = MasterKelas::select('*')
            ->where('tingkat', '=', $jenjang_instansis->jenjang)
            ->orderBy('kelas')
            ->get();

        $mapels = MasterMapel::select('*')->orderBy('nama')->orderBy('materi')->get();
        
        $tahun_ajarans = MasterTahunAjaran::select('*')->orderBy('tahun_awal')->orderBy('semester')->get();
        
        foreach($user_admin_instansis as $user_admin_instansi){
            $kelas_programs = KelasProgram::select('kelas_programs.id as id_kelas_program','kelas_programs.*','master_kelas.tingkat','master_kelas.kelas')
                ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
                ->where('instansi_pendidikan_id', '=', $user_admin_instansi->id_instansi)
                ->orderBy('master_kelas.kelas')
                ->orderBy('kelas_programs.deskripsi')
                ->get();
        }
        // return$kelas_programs;

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

        $nama_gurus = GuruInstansi::select('guru_instansis.id as id_guru_instansi','guru_instansis.*','users.*')
            ->join('user_gurus', 'guru_instansis.user_guru_id', '=', 'user_gurus.id')
            ->join('users', 'user_gurus.user_id', '=', 'users.id')
            ->get();

        // $siswa_totals = DB::table('rombongan_belajars')
        //     ->selectRaw('*, count(*) as total')
        //     ->groupBy('kelas_program_id')
        //     ->get();

        $siswa_totals = RombonganBelajar::select('*')->get();

        return view('AdminLTE/kelas_program',compact('nama_instansis','foto_profil','id','user_admin_instansis','last_updates','jumlahs','kelass','mapels','tahun_ajarans','kelas_programs','siswa_totals','mapel_kelas_programs','harga_kelas_programs'));
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
        $rules = array(
            'deskripsi' => 'string|max:100',
            'variasi_harga' => 'numeric|gt:0',
            // 'harga' => 'numeric|gte:0',
            // 'jurusan' => 'string|max:50|nullable',
            // 'file_impor' => 'mimes:xls,xlsx,csv|max:1024',
        );

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            $request->session()->flash('danger', 'Aduh ada yang salah, coba cek lagi ya form inputnya');
            return redirect()->back()->withInput()->withErrors($validator->errors());
        }

        $save_kelas_program=KelasProgram::create([
            'deskripsi' => $request->input('deskripsi'),
            'master_kelas_id' => $request->input('kelas'),
            'instansi_pendidikan_id' =>  $request->input('id_instansi'),
        ]); 

        for($count = 0; $count < $request->input('variasi_harga'); $count++){
            HargaKelasProgram::create([
                'kelas_program_id' => $save_kelas_program->id,
            ]); 
        }

        for($count = 0; $count < count($request->input('mapel')); $count++){
            MapelKelasProgram::create([
                'kelas_program_id' => $save_kelas_program->id,
                'master_mapel_id' =>  $request->input('mapel')[$count],
            ]); 
        }

        // if(empty($request->input('file_impor'))){
        //     for($count = 0; $count < count($request->input('mapel')); $count++){

        //         KelasProgram::create([
        //             'deskripsi' => $request->input('deskripsi'),
        //             'master_kelas_id' => $request->input('kelas'),
        //             'instansi_pendidikan_id' =>  $request->input('id_instansi'),
        //             'jurusan' => $request->input('jurusan'),
        //             'harga' => $request->input('harga'),
        //         ]); 
        //     };
        // };

        $request->session()->flash('success', 'Data berhasil disimpan!');

        return redirect()->route('kelas-program.index');

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

        $roles=Auth::user()->roles;
        $roles=$roles[0]->name;

        $foto_profil = User::select('foto')
            ->where('id', '=', $id_user)
            ->get();

        $nama_instansis = UserAdminInstansi::select('instansi_pendidikans.nama')
            ->join('users', 'user_admin_instansis.user_id', '=', 'users.id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id_user)
            ->get();

        $user_admin_instansis = User::select('user_admin_instansis.id as id_adm_instansi','instansi_pendidikans.id as id_instansi','instansi_pendidikans.tipe')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id_user)
            ->get();

        $tipe_siswa = RombonganBelajar::select('instansi_pendidikans.tipe')
            ->join('kelas_programs', 'rombongan_belajars.kelas_program_id', '=', 'kelas_programs.id')
            ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->join('user_siswas', 'rombongan_belajars.user_siswa_id', '=', 'user_siswas.id')
            ->where('user_id', '=', $id_user)
            ->first();

        if ($roles=='guru'){
            $tipe_guru = KelasProgram::select('instansi_pendidikans.tipe')
                ->join('guru_instansis', 'instansi_pendidikans.id', '=', 'guru_instansis.instansi_pendidikan_id')
                ->join('user_gurus', 'guru_instansis.user_guru_id', '=', 'user_gurus.id')
                ->where('user_gurus.user_id', '=', $id_user)
                ->first();
    
            $data_guru = KelasProgram::select(
                'user_gurus.id as id_user_guru','user_gurus.*',
                'users.id as id_user','users.*')
                ->join('user_gurus', 'guru_instansis.user_guru_id', '=', 'user_gurus.id')
                ->join('users', 'user_gurus.user_id', '=', 'users.id')
                ->where('guru_instansis.id', '=', $id)
                ->first();
        }
        else{
            $tipe_guru='';
            $data_guru='';
        };

        $data_kelas = KelasProgram::select(
            'kelas_programs.id as id_kelas_program','kelas_programs.*',
            'harga_kelas_programs.harga',
            'master_kelas.id as id_master_kelas','master_kelas.*',
            'master_mapels.id as id_master_mapel','master_mapels.nama as nama_mapel','master_mapels.*',
            'instansi_pendidikans.id as id_instansi_pendidikan','instansi_pendidikans.nama as nama_sekolah','instansi_pendidikans.*')
            ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
            ->join('harga_kelas_programs', 'kelas_programs.id', '=', 'harga_kelas_programs.kelas_program_id')
            ->join('mapel_kelas_programs', 'kelas_programs.id', '=', 'mapel_kelas_programs.kelas_program_id')
            ->join('master_mapels', 'mapel_kelas_programs.master_mapel_id', '=', 'master_mapels.id')
            ->join('instansi_pendidikans', 'kelas_programs.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('kelas_programs.id', '=', $id)
            ->first();
        
        $siswa_kelass = RombonganBelajar::select(
            'user_siswas.id as id_siswa','user_siswas.*',
            'users.id as id_user','users.*',
            'rombongan_belajars.id as id_rombongan_belajar','rombongan_belajars.*',
            'master_kelas.*')
            ->join('user_siswas', 'rombongan_belajars.user_siswa_id', '=', 'user_siswas.id')
            ->join('master_kelas', 'user_siswas.master_kelas_id', '=', 'master_kelas.id')
            ->join('users', 'user_siswas.user_id', '=', 'users.id')
            ->join('kelas_programs', 'rombongan_belajars.kelas_program_id', '=', 'kelas_programs.id')
            ->where('kelas_programs.id', '=', $id)
            ->where('rombongan_belajars.status', '=', '1')
            ->get();

        $siswa_permintaans = RombonganBelajar::select(
            'user_siswas.id as id_siswa','user_siswas.*',
            'users.id as id_user','users.*',
            'rombongan_belajars.id as id_rombongan_belajar','rombongan_belajars.*',
            'master_kelas.*')
            ->join('user_siswas', 'rombongan_belajars.user_siswa_id', '=', 'user_siswas.id')
            ->join('master_kelas', 'user_siswas.master_kelas_id', '=', 'master_kelas.id')
            ->join('users', 'user_siswas.user_id', '=', 'users.id')
            ->join('kelas_programs', 'rombongan_belajars.kelas_program_id', '=', 'kelas_programs.id')
            ->where('kelas_programs.id', '=', $id)
            ->where('rombongan_belajars.status', '=', '0')
            ->get();

        return view('AdminLTE/kelas_program_detail',compact('nama_instansis','foto_profil','id','user_admin_instansis','data_kelas','siswa_kelass','siswa_permintaans','tipe_siswa'));

            
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
        $kelas_program = HargaKelasProgram::select('harga_kelas_programs.*','harga_kelas_programs.id as id_harga','kelas_programs.*')
            ->join('kelas_programs','harga_kelas_programs.kelas_program_id','=','kelas_programs.id')
            ->where('harga_kelas_programs.id',$id)
            ->first();

	    return response()->json([
	      'data' => $kelas_program
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
        // dd ($id);
        if($request->keterangan=='update_master'){
            $rules = array(
                'deskripsi' => 'string|max:100',
                'harga' => 'numeric|gte:0',
                'jumlah_bulan' => 'numeric|gt:0',
            );

            $validator = Validator::make($request->all(), $rules);

            if($validator->fails()) {
                $request->session()->flash('danger', 'Aduh ada yang salah, coba cek lagi ya form editnya');
                return response()->json(['error'=>$validator->errors()]);
            }
            else{
                $harga_kelas_program = HargaKelasProgram::find($id);
                $harga_kelas_program->update([
                    'harga' => $request->input('harga'),
                    'jumlah_bulan' => $request->input('jumlah_bulan'),
                ]); 

                $kelas_program = KelasProgram::find($harga_kelas_program->kelas_program_id);
                $kelas_program->update([
                    'deskripsi' => $request->input('deskripsi'),
                ]); 
        
                $request->session()->flash('success', 'Data '.$request->input('deskripsi').' berhasil diperbarui!');
                return response()->json([ 'success' => true ]);
            }
            
        }
        elseif($request->keterangan=='terima_user'){
            $rombongan = RombonganBelajar::find($request->id);
        
            $rombongan->update([
                'status' => '1',
            ]); 
    
            return back();
        }
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

    public function show_guru(Request $request){
        $userData = Spesialisasi::select('user_gurus.id as id_user_guru','user_gurus.*','users.id as id_user','users.*','spesialisasis.id as id_spesialisasi','spesialisasis.*')
            ->join('user_gurus', 'spesialisasis.user_guru_id', '=', 'user_gurus.id')
            ->join('users', 'user_gurus.user_id', '=', 'users.id')
            ->where('spesialisasis.master_mapel_id', '=', $request->id)
            ->get();
        // dd($userData);
        return json_encode(array('data'=>$userData));
    }

    public function update_guru(Request $request){
        $kelas_program = KelasProgram::find($request->id_kelas_program);
        
        $kelas_program->update(['user_guru_id' => $request->input('id_user_guru')]); 

        return json_encode(array('data'=>$kelas_program));
    }

    public function edit_harga(Request $request){
        $kelasData = KelasProgram::select('kelas_programs.*')
            ->where('kelas_programs.id', '=', $request->id)
            ->get();

        // dd($kelasData);
        return json_encode(array('data'=>$kelasData));
    }

    public function update_harga(Request $request){
        // dd($request);
        $request->validate([
            'harga' => ['numeric','gte:0'],
        ]);

        $kelas_program = KelasProgram::find($request->id_kelas_program);
        
        $kelas_program->update([
            'harga' => $request->input('harga'),
        ]); 

        $request->session()->flash('success', 'Harga berhasil diperbarui!');

        return json_encode(array('data'=>$kelas_program));
    }
}
