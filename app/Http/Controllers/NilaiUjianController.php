<?php

namespace App\Http\Controllers;

use App\Models\DetailUjian;
use App\Models\MasterPaketSoal;
use App\Models\MasterTahunAjaran;
use App\Models\NilaiUjian;
use App\Models\User;
use App\Models\UserAdminInstansi;
use App\Models\UserSiswa;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail; //jangan lupa import ini

class NilaiUjianController extends Controller
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

        $last_update_nilai = NilaiUjian::select('updated_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $jumlah_nilai = NilaiUjian::select('*')->count();

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $nama_instansis = UserAdminInstansi::select('instansi_pendidikans.nama')
            ->join('users', 'user_admin_instansis.user_id', '=', 'users.id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();
        
        $tahun_ajarans = MasterTahunAjaran::get();

        // return$tahun_ajarans;

        return view('AdminLTE/nilai-ujian',compact('user_admin_instansis','foto_profil','nama_instansis','last_update_nilai','jumlah_nilai','tahun_ajarans'));
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
        //tak pake fungsi search tahun ajaran
        return redirect('detail-nilai-ujian/'.$request->tahun_ajaran);   
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
        $id_user = Auth::user()->id;

        $foto_profil = User::select('foto')
            ->where('id', '=', $id_user)
            ->get();

        $nama_instansis = UserAdminInstansi::select('instansi_pendidikans.*')
            ->join('users', 'user_admin_instansis.user_id', '=', 'users.id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id_user)
            ->get();

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id_user)
            ->get();

        $data_siswas = NilaiUjian::select('nilai_ujians.id as id_nilai_ujian','nilai_ujians.*','user_siswas.id as id_user_siswa','user_siswas.*','users.id as id_user','users.*','master_ruang_ujians.id as id_master_ruang_ujian','master_ruang_ujians.*','kelas_programs.deskripsi as nama_kelas_program')
            ->join('master_ruang_ujians', 'nilai_ujians.master_ruang_ujian_id', '=', 'master_ruang_ujians.id')
            ->join('kelas_programs', 'master_ruang_ujians.kelas_program_id', '=', 'kelas_programs.id')
            ->join('users', 'nilai_ujians.user_siswa_id', '=', 'users.id')
            ->join('user_siswas', 'users.id', '=', 'user_siswas.user_id')
            // ->groupBy('master_ruang_ujian_id')
            // ->orderBy('total_nilai','desc')
            ->where('user_siswa_id',$id)
            ->whereRaw('total_nilai in (select max(total_nilai) from nilai_ujians group by (master_ruang_ujian_id))')
            ->get();

        // return$data_siswas;
        return view('AdminLTE/nilai-ujian-detail',compact('user_admin_instansis','foto_profil','nama_instansis','data_siswas'));
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

    public function email(Request $request){

        // return $request->id_tahun_ajaran;

        $nama_instansis = UserAdminInstansi::select('instansi_pendidikans.*')
            ->join('users', 'user_admin_instansis.user_id', '=', 'users.id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id',Auth::user()->id)
            ->get();

        $data_siswas = NilaiUjian::select('nilai_ujians.id as id_nilai_ujian','nilai_ujians.*','user_siswas.id as id_user_siswa','user_siswas.*','users.id as id_user','users.*','master_ruang_ujians.id as id_master_ruang_ujian','master_ruang_ujians.*','kelas_programs.deskripsi as nama_kelas_program','master_tahun_ajarans.id as id_tahun_ajaran')
            ->join('master_ruang_ujians', 'nilai_ujians.master_ruang_ujian_id', '=', 'master_ruang_ujians.id')
            ->join('kelas_programs', 'master_ruang_ujians.kelas_program_id', '=', 'kelas_programs.id')
            ->join('master_tahun_ajarans', 'master_ruang_ujians.master_tahun_ajaran_id', '=', 'master_tahun_ajarans.id')
            ->join('users', 'nilai_ujians.user_siswa_id', '=', 'users.id')
            ->join('user_siswas', 'users.id', '=', 'user_siswas.user_id')
            ->where('user_siswa_id',$request->id_user)
            ->get();

        foreach($data_siswas as $data_siswa){
            $nama_wali=$data_siswa->nama_wali;
            $email_wali=$data_siswa->email_wali;
            $id_tahun_ajaran=$data_siswa->id_tahun_ajaran;
        }

        //isi Mail::to(...) dengan email tujuan yang kalian inginkan
        // Mail::to($tujuan)->send(new LatihanEmail());
        $data = array('nama_instansis'=>$nama_instansis,'data_siswas'=>$data_siswas);
        // dd($data);

        Mail::send('AdminLTE/nilai-ujian-email', $data, function($message) use ($nama_wali,$email_wali)
        {
            $message->to($email_wali, $nama_wali)->subject
                ('Hasil Ujian');
            $message->from('skripsi@unud.com','Laravel');
        });
        // echo "HTML Email Sent. Check your inbox.";

        $request->session()->flash('success','Nilai berhasil dikirim! Silahkan cek e-mail '.$email_wali);

        return redirect('detail-nilai-ujian/'.$id_tahun_ajaran);   

    }

    public function detail_nilai_ujian($id_tahun_ajaran)
    {
        // return $id_tahun_ajaran;
        $id = Auth::user()->id;

        $last_update_nilai = NilaiUjian::select('updated_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $jumlah_nilai = NilaiUjian::select('*')->count();

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $nama_instansis = UserAdminInstansi::select('instansi_pendidikans.*')
            ->join('users', 'user_admin_instansis.user_id', '=', 'users.id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $data_siswas = NilaiUjian::select('nilai_ujians.id as id_nilai_ujian','nilai_ujians.*','user_siswas.id as id_user_siswa','user_siswas.*','users.id as id_user','users.*','master_ruang_ujians.id as id_master_ruang_ujian','master_ruang_ujians.*','master_kelas.*','master_tahun_ajarans.id as id_tahun_ajaran')
            ->join('master_ruang_ujians', 'nilai_ujians.master_ruang_ujian_id', '=', 'master_ruang_ujians.id')
            ->join('kelas_programs', 'master_ruang_ujians.kelas_program_id', '=', 'kelas_programs.id')
            ->join('master_tahun_ajarans', 'master_ruang_ujians.master_tahun_ajaran_id', '=', 'master_tahun_ajarans.id')
            ->join('master_kelas', 'kelas_programs.master_kelas_id', '=', 'master_kelas.id')
            ->join('users', 'nilai_ujians.user_siswa_id', '=', 'users.id')
            ->join('user_siswas', 'users.id', '=', 'user_siswas.user_id')
            ->groupBy('nilai_ujians.user_siswa_id')
            ->where('master_ruang_ujians.master_tahun_ajaran_id',$id_tahun_ajaran)
            ->get();

        $tahun_ajarans = MasterTahunAjaran::get();
        
        return view('AdminLTE/nilai-ujian',compact('user_admin_instansis','foto_profil','nama_instansis','last_update_nilai','jumlah_nilai','data_siswas','tahun_ajarans'));
    }
}
