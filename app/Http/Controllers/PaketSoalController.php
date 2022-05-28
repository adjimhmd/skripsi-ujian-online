<?php

namespace App\Http\Controllers;

use App\Models\BankSoal;
use App\Models\GuruInstansi;
use App\Models\GuruPaketSoal;
use App\Models\InstansiPendidikan;
use App\Models\KelasProgram;
use App\Models\MasterKelas;
use App\Models\MasterMapel;
use App\Models\MasterPaketSoal;
use App\Models\PaketSoal;
use App\Models\Spesialisasi;
use App\Models\User;
use App\Models\UserAdminInstansi;
use App\Models\UserGuru;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class PaketSoalController extends Controller
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

        $last_update_paket = MasterPaketSoal::select('master_paket_soals.updated_at')
            ->orderBy('master_paket_soals.updated_at', 'desc')
            ->get();

        $jumlah_paket = MasterPaketSoal::select('*')->count();

        $paket_soals = MasterPaketSoal::select('*')->orderBy('deskripsi')->get();
        
        // return $last_update_paket;

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

        $program_mapels = MasterMapel::select('master_mapels.*')
            ->get();

        $list_kelas = MasterKelas::get();
        
        $instansis = UserAdminInstansi::select('instansi_pendidikans.*')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('user_admin_instansis.user_id', '=', $id)
            ->first();

        $kelass = MasterKelas::select('*')
            ->where('tingkat', '=', $instansis->jenjang)
            ->orderBy('kelas')
            ->get();
        
        $paket_soals=MasterPaketSoal::select('master_paket_soals.id as id_paket_soal','master_paket_soals.*',
            'master_kelas.id as id_master_kelas','master_kelas.*',
            'master_mapels.id as id_master_mapel','master_mapels.*',
            'guru_paket_soals.id as id_guru_paket_soal','guru_paket_soals.*',
            'user_admin_instansis.instansi_pendidikan_id as id_instansi',
            'user_gurus.id as id_user_guru','user_gurus.*',
            'users.id as id_user','users.*')
            ->join('user_admin_instansis', 'master_paket_soals.user_admin_instansi_id', '=', 'user_admin_instansis.id')
            ->join('master_kelas', 'master_paket_soals.master_kelas_id', '=', 'master_kelas.id')
            ->join('master_mapels', 'master_paket_soals.master_mapel_id', '=', 'master_mapels.id')
            ->leftJoin('guru_paket_soals', 'master_paket_soals.id', '=', 'guru_paket_soals.master_paket_soal_id')
            ->leftJoin('user_gurus', 'guru_paket_soals.user_guru_id', '=', 'user_gurus.id')
            ->leftJoin('users', 'user_gurus.user_id', '=', 'users.id')
            ->where('user_admin_instansis.instansi_pendidikan_id', '=', $instansis->id)
            ->orderBy('master_kelas.kelas')
            ->orderBy('master_paket_soals.deskripsi')
            ->get();
            // return$paket_soals;

        $jml_soals = PaketSoal::select('master_paket_soal_id', DB::raw('count(*) as total'))->groupBy('master_paket_soal_id')->get();
        // return$jml_soals;

        return view('AdminLTE/master-paket-soal', compact('nama_instansis','foto_profil','user_admin_instansis','last_update_paket', 'jumlah_paket', 'paket_soals','list_kelas','program_mapels','kelass','paket_soals','jml_soals'));
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
            'deskripsi' => ['max:100'],
        ]);

        MasterPaketSoal::create([
            'master_kelas_id' => $request->input('kelas'),
            'master_mapel_id' => $request->input('mapel'),
            'user_admin_instansi_id' => $request->input('id_adm_instansi'),
            'deskripsi' => $request->input('deskripsi'),
        ]); 

        $request->session()->flash('success', 'Paket soal '.$request->input('deskripsi').' berhasil disimpan!');

        return redirect()->route('paket_soal.index');
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
        // return $id;
        $id_user = Auth::user()->id;

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

        $master_paket_soal=MasterPaketSoal::where('id',$id)->first();
        
        $id_guru_paket_soal=GuruPaketSoal::where('master_paket_soal_id',$id)->pluck('user_guru_id')->toArray();

        $id_guru=UserGuru::whereIn('id',$id_guru_paket_soal)->pluck('user_id')->toArray();

        // $id_user_guru=UserGuru::where('id',$master_paket_soal->user_guru_id)->first();

        if(!$id_guru_paket_soal){
            return redirect()->route('paket_soal.index')->with('danger', 'Paket soal yang dipilih belum memiliki guru!');
        }
        $kelas_program = MasterPaketSoal::join('master_kelas', 'master_paket_soals.master_kelas_id', '=', 'master_kelas.id')
            ->join('master_mapels', 'master_paket_soals.master_mapel_id', '=', 'master_mapels.id')
            ->join('guru_paket_soals', 'master_paket_soals.id', '=', 'guru_paket_soals.master_paket_soal_id')
            ->join('user_gurus', 'guru_paket_soals.user_guru_id', '=', 'user_gurus.id')
            ->join('users', 'user_gurus.user_id', '=', 'users.id')
            ->where('master_paket_soals.id',$id)
            ->first();

        $soal_objektif_terpilih = PaketSoal::select('paket_soals.id as id_paket_soal', 'bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*','users.name','users.foto')
            ->join('bank_soals', 'paket_soals.bank_soal_id', '=', 'bank_soals.id')
            ->join('users', 'bank_soals.user_id', '=', 'users.id')
            ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
            ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
            ->orderBy('bank_soals.updated_at', 'desc')
            ->where('master_paket_soal_id',$id)
            ->whereIn('bank_soals.user_id',$id_guru)
            ->where('bank_soals.master_kelas_id', '=', $master_paket_soal->master_kelas_id)
            ->where('bank_soals.master_mapel_id', '=', $master_paket_soal->master_mapel_id)
            ->where('bank_soals.tipe_soal', '=', 'objektif')
            ->get();

        $soal_subjektif_terpilih = PaketSoal::select('paket_soals.id as id_paket_soal', 'bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*','users.name','users.foto')
            ->join('bank_soals', 'paket_soals.bank_soal_id', '=', 'bank_soals.id')
            ->join('users', 'bank_soals.user_id', '=', 'users.id')
            ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
            ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
            ->orderBy('bank_soals.updated_at', 'desc')
            ->where('master_paket_soal_id',$id)
            ->whereIn('bank_soals.user_id',$id_guru)
            ->where('bank_soals.master_kelas_id', '=', $master_paket_soal->master_kelas_id)
            ->where('bank_soals.master_mapel_id', '=', $master_paket_soal->master_mapel_id)
            ->where('bank_soals.tipe_soal', '=', 'subjektif')
            ->get();
        
        $soal_penjodohan_terpilih = PaketSoal::select('paket_soals.id as id_paket_soal', 'bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*','users.name','users.foto')
            ->join('bank_soals', 'paket_soals.bank_soal_id', '=', 'bank_soals.id')
            ->join('users', 'bank_soals.user_id', '=', 'users.id')
            ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
            ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
            ->orderBy('bank_soals.updated_at', 'desc')
            ->where('master_paket_soal_id',$id)
            ->whereIn('bank_soals.user_id',$id_guru)
            ->where('bank_soals.master_kelas_id', '=', $master_paket_soal->master_kelas_id)
            ->where('bank_soals.master_mapel_id', '=', $master_paket_soal->master_mapel_id)
            ->where('bank_soals.tipe_soal', '=', 'penjodohan')
            ->get();
        
        $soal_truefalse_terpilih = PaketSoal::select('paket_soals.id as id_paket_soal', 'bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*','users.name','users.foto')
            ->join('bank_soals', 'paket_soals.bank_soal_id', '=', 'bank_soals.id')
            ->join('users', 'bank_soals.user_id', '=', 'users.id')
            ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
            ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
            ->orderBy('bank_soals.updated_at', 'desc')
            ->where('master_paket_soal_id',$id)
            ->whereIn('bank_soals.user_id',$id_guru)
            ->where('bank_soals.master_kelas_id', '=', $master_paket_soal->master_kelas_id)
            ->where('bank_soals.master_mapel_id', '=', $master_paket_soal->master_mapel_id)
            ->where('bank_soals.tipe_soal', '=', 'true-false')
            ->get();
            
        $id_soal_objektif=$soal_objektif_terpilih->pluck('id_bank_soal');
        $id_soal_subjektif=$soal_subjektif_terpilih->pluck('id_bank_soal');
        $id_soal_penjodohan=$soal_penjodohan_terpilih->pluck('id_bank_soal');
        $id_soal_truefalse=$soal_truefalse_terpilih->pluck('id_bank_soal');
        

        $list_soal_objektif = BankSoal::select('bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*','users.name','users.foto')
            ->join('users', 'bank_soals.user_id', '=', 'users.id')
            ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
            ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
            ->orderBy('bank_soals.updated_at', 'desc')
            ->whereIn('bank_soals.user_id',$id_guru)
            ->where('bank_soals.master_kelas_id', '=', $master_paket_soal->master_kelas_id)
            ->where('bank_soals.master_mapel_id', '=', $master_paket_soal->master_mapel_id)
            ->where('bank_soals.tipe_soal', '=', 'objektif')
            ->whereNotIn('bank_soals.id', $id_soal_objektif)
            ->get();
        
        // return $id_guru;

        $list_jawaban_objektif = BankSoal::select('jawabans.*')
            ->join('jawabans', 'bank_soals.id', '=', 'jawabans.banksoal_id')
            ->whereIn('bank_soals.user_id',$id_guru)
            ->where('bank_soals.master_kelas_id', '=', $master_paket_soal->master_kelas_id)
            ->where('bank_soals.master_mapel_id', '=', $master_paket_soal->master_mapel_id)
            ->where('bank_soals.tipe_soal', '=', 'objektif')
            ->get();

        $list_soal_subjektif = BankSoal::select('bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*','users.name','users.foto')
            ->join('users', 'bank_soals.user_id', '=', 'users.id')
            ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
            ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
            ->orderBy('bank_soals.updated_at', 'desc')
            ->whereIn('bank_soals.user_id',$id_guru)
            ->where('bank_soals.master_kelas_id', '=', $master_paket_soal->master_kelas_id)
            ->where('bank_soals.master_mapel_id', '=', $master_paket_soal->master_mapel_id)
            ->where('bank_soals.tipe_soal', '=', 'subjektif')
            ->whereNotIn('bank_soals.id', $id_soal_subjektif)
            ->get();
        
        $list_soal_penjodohan = BankSoal::select('bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*','users.name','users.foto')
            ->join('users', 'bank_soals.user_id', '=', 'users.id')
            ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
            ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
            ->orderBy('bank_soals.updated_at', 'desc')
            ->whereIn('bank_soals.user_id',$id_guru)
            ->where('bank_soals.master_kelas_id', '=', $master_paket_soal->master_kelas_id)
            ->where('bank_soals.master_mapel_id', '=', $master_paket_soal->master_mapel_id)
            ->where('bank_soals.tipe_soal', '=', 'penjodohan')
            ->whereNotIn('bank_soals.id', $id_soal_penjodohan)
            ->get();
        
        $list_soal_truefalse = BankSoal::select('bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*','users.name','users.foto')
            ->join('users', 'bank_soals.user_id', '=', 'users.id')
            ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
            ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
            ->orderBy('bank_soals.updated_at', 'desc')
            ->whereIn('bank_soals.user_id',$id_guru)
            ->where('bank_soals.master_kelas_id', '=', $master_paket_soal->master_kelas_id)
            ->where('bank_soals.master_mapel_id', '=', $master_paket_soal->master_mapel_id)
            ->where('bank_soals.tipe_soal', '=', 'true-false')
            ->whereNotIn('bank_soals.id', $id_soal_truefalse)
            ->get();

        $jumlah_soals = DB::table('paket_soals')
            ->join('bank_soals', 'paket_soals.bank_soal_id', '=', 'bank_soals.id')
            ->selectRaw('tipe_soal, count(bank_soal_id) as jumlah')
            ->groupBy('tipe_soal')
            ->where('master_paket_soal_id',$id)
            ->get();

        return view('AdminLTE/paket-soal',compact('nama_instansis','foto_profil','user_admin_instansis','list_soal_objektif','list_jawaban_objektif','list_soal_subjektif','list_soal_penjodohan','list_soal_truefalse','kelas_program','master_paket_soal','soal_objektif_terpilih','soal_subjektif_terpilih','soal_penjodohan_terpilih','soal_truefalse_terpilih','jumlah_soals'));
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
        $program_mapel = MasterPaketSoal::find($id);

	    return response()->json([
	      'data' => $program_mapel
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
        $paket_soals = MasterPaketSoal::find($id);
        // dd($request);

        $paket_soals->update([
            'deskripsi' => $request->input('deskripsi'),
        ]); 

        $request->session()->flash('success', 'Master paket soal '.ucwords($request->input('deskripsi')).' berhasil diperbarui!');
        
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

    public function show_guru_paket(Request $request)
    {
        
        if($request->keterangan=='pilih_guru'){
            $userData = GuruInstansi::select('user_gurus.id as id_user_guru','user_gurus.*','users.id as id_user','users.*')
            ->join('user_gurus', 'guru_instansis.user_guru_id', '=', 'user_gurus.id')
            ->join('spesialisasis', 'user_gurus.id', '=', 'spesialisasis.user_guru_id')
            ->join('users', 'user_gurus.user_id', '=', 'users.id')
            ->where('guru_instansis.status', '=', '1')
            ->where('guru_instansis.instansi_pendidikan_id', '=', $request->id_instansi)
            ->where('spesialisasis.master_mapel_id', '=', $request->id_master_mapel)
            ->get();
        }
        else if($request->keterangan=='tambah_guru'){
            $id_guru_paket_soals=GuruPaketSoal::where('master_paket_soal_id',$request->id_paket_soal)->pluck('user_guru_id')->toArray();

            $userData = GuruInstansi::select('user_gurus.id as id_user_guru','user_gurus.*','users.id as id_user','users.*')
            ->join('user_gurus', 'guru_instansis.user_guru_id', '=', 'user_gurus.id')
            ->join('spesialisasis', 'user_gurus.id', '=', 'spesialisasis.user_guru_id')
            ->join('users', 'user_gurus.user_id', '=', 'users.id')
            ->where('guru_instansis.status', '=', '1')
            ->where('guru_instansis.instansi_pendidikan_id', '=', $request->id_instansi)
            ->whereNotIn('guru_instansis.user_guru_id',$id_guru_paket_soals)
            ->where('spesialisasis.master_mapel_id', '=', $request->id_master_mapel)
            ->get();
        }

        // dd($userData);
        return json_encode(array('data'=>$userData));
    }

    public function update_guru_paket(Request $request)
    {
        // dd($request);
        // $id = Auth::user()->id;

        // $paket_soal = MasterPaketSoal::find($request->id_paket_soal);
        // $paket_soal->update(['user_guru_id' => $request->input('id_user_guru')]); 

        $paket_soal=GuruPaketSoal::create([
            'master_paket_soal_id' => $request->id_paket_soal,
            'user_guru_id' => $request->id_user_guru,
        ]); 

        $request->session()->flash('success', 'Master paket soal berhasil diperbarui!');
        return json_encode(array('data'=>$paket_soal));
    }
    
    public function pilih_soal(Request $request)
    {
        // return $request;
        $total='';
        if($request->pilih_objektif){
            $total=$total.count($request->pilih_objektif).' soal pilihan ganda, ';
            for($count = 0; $count < count($request->pilih_objektif); $count++){
                PaketSoal::create([
                    'bank_soal_id' => $request->pilih_objektif[$count],
                    'master_paket_soal_id' => $request->master_paket_soal_id,
                ]); 
            }
        }
        
        if($request->pilih_subjektif){
            $total=$total.count($request->pilih_subjektif).' soal essay, ';
            for($count = 0; $count < count($request->pilih_subjektif); $count++){
                PaketSoal::create([
                    'bank_soal_id' => $request->pilih_subjektif[$count],
                    'master_paket_soal_id' => $request->master_paket_soal_id,
                ]); 
            }
        }
        
        if($request->pilih_penjodohan){
            $total=$total.count($request->pilih_penjodohan).' soal penjodohan, ';
            for($count = 0; $count < count($request->pilih_penjodohan); $count++){
                PaketSoal::create([
                    'bank_soal_id' => $request->pilih_penjodohan[$count],
                    'master_paket_soal_id' => $request->master_paket_soal_id,
                ]); 
            }
        }
        
        if($request->pilih_truefalse){
            $total=$total.count($request->pilih_truefalse).' soal true-false, ';
            for($count = 0; $count < count($request->pilih_truefalse); $count++){
                PaketSoal::create([
                    'bank_soal_id' => $request->pilih_truefalse[$count],
                    'master_paket_soal_id' => $request->master_paket_soal_id,
                ]); 
            }
        }
            

        $request->session()->flash('success', $total.'berhasil dipilih!');

        return redirect()->back();
    }
    
    public function hapus_soal(Request $request)
    {
        $request->hapus_soal = array_unique($request->hapus_soal);
        $request->hapus_soal = array_values($request->hapus_soal);
        // return$request->hapus_soal;

        if($request->hapus_soal){
            PaketSoal::whereIn('id', $request->hapus_soal)->delete();
            $request->session()->flash('success', 'Soal terpilih berhasil dihapus!');
        }
        else{
            PaketSoal::where('master_paket_soal_id', $request->master_paket_soal_id)->delete();
            $request->session()->flash('success', 'Semua soal berhasil dihapus!');
        }
        return redirect()->back();
    }
}
