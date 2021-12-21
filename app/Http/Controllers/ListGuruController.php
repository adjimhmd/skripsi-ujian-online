<?php

namespace App\Http\Controllers;

use App\Models\GuruInstansi;
use App\Models\User;
use App\Models\UserAdminInstansi;
use App\Models\UserGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListGuruController extends Controller
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

        $last_update_guru = GuruInstansi::select('guru_instansis.updated_at')
            ->orderBy('guru_instansis.updated_at', 'desc')
            ->get();

        $jumlah_guru = GuruInstansi::select('*')->count();

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
        
        $list_gurus=GuruInstansi::select('guru_instansis.id as id_guru_instansi','guru_instansis.*',
            'user_gurus.id as id_user_guru','user_gurus.*',
            'users.id as id_user','users.*')
            ->selectRaw('group_concat(master_mapels.nama) as nama_mapel')
            ->join('user_gurus', 'guru_instansis.user_guru_id', '=', 'user_gurus.id')
            ->join('users', 'user_gurus.user_id', '=', 'users.id')
            ->join('spesialisasis', 'user_gurus.id', '=', 'spesialisasis.user_guru_id')
            ->join('master_mapels', 'spesialisasis.master_mapel_id', '=', 'master_mapels.id')
            ->groupBy('guru_instansis.user_guru_id')
            ->get();

        return view('AdminLTE/master-guru', compact('id','nama_instansis','foto_profil','user_admin_instansis','last_update_guru', 'jumlah_guru','list_gurus'));

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
    public function destroy(Request $request, $id)
    {
        //
        // dd($request->input('nama'));
        GuruInstansi::destroy($id);

        $request->session()->flash('danger', 'Guru '.$request->input('nama').' berhasil dihapus!');
    
        return response()->json([ 'success' => true ]);
    }
    
    public function daftar_guru()
    {
        //
        $id_instansis=UserAdminInstansi::where('user_id',Auth::user()->id)->pluck('instansi_pendidikan_id')->toArray();
        $guru_instansis=GuruInstansi::whereIn('instansi_pendidikan_id',$id_instansis)->pluck('user_guru_id')->toArray();
        // return$guru_instansis;
        $list_gurus=DB::table('user_gurus')
            ->select('users.*','user_gurus.*','user_gurus.id as id_guru')
            ->selectRaw('group_concat(master_mapels.nama) as nama_mapel')
            ->join('spesialisasis', 'user_gurus.id', '=', 'spesialisasis.user_guru_id')
            ->join('master_mapels', 'spesialisasis.master_mapel_id', '=', 'master_mapels.id')
            ->join('users', 'user_gurus.user_id', '=', 'users.id')
            ->whereNotIn('user_gurus.id',$guru_instansis)
            ->groupBy('spesialisasis.user_guru_id')
            ->get();

            
        // dd($list_gurus);
        return json_encode(array('data'=>$list_gurus));

    }
    
    public function simpan_guru(Request $request)
    {
        //
        $id_instansi=UserAdminInstansi::select('instansi_pendidikans.id as id_instansi_pendidikan')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('user_id',$request->id_user)
            ->first();
            
        GuruInstansi::create([
            'instansi_pendidikan_id' => $id_instansi->id_instansi_pendidikan,
            'user_guru_id' => $request->id_guru,
            'status' => '1',
        ]); 

        return redirect()->route('list-guru.index');
    }
}
