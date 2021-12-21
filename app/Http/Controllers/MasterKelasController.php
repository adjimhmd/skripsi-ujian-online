<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InstansiPendidikan;
use App\Models\MasterKelas;
use App\Models\User;
use App\Models\UserAdminInstansi;
use Auth;

class MasterKelasController extends Controller
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

        $last_update_kelas = MasterKelas::select('master_kelas.updated_at')
            ->orderBy('master_kelas.updated_at', 'desc')
            ->get();

        $jumlah_kelas = MasterKelas::select('*')->count();

        $kelas = MasterKelas::select('*')->orderBy('kelas')->get();
        
        // return $jumlah_Kelas;

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        return view('AdminLTE/master-kelas', compact('foto_profil','user_admin_instansis','last_update_kelas', 'jumlah_kelas', 'kelas'));
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
            'file_impor' => ['mimes:xls,xlsx,csv|max:1024'],
        ]);

        if(empty($request->input('file_impor'))){
            MasterKelas::create([
                'kelas' => $request->input('kelas'),
                'tingkat' => $request->input('tingkat'),
            ]); 
        }
        $request->session()->flash('success', 'Kelas '.$request->input('kelas').' '.$request->input('tingkat').' berhasil disimpan!');

        return redirect()->route('master-kelas.index');
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
        $kelas = MasterKelas::find($id);

	    return response()->json([
	      'data' => $kelas
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
        $kelas = MasterKelas::find($id);

        $kelas->update([
            'tingkat' => $request->input('tingkat'),
            'kelas' => $request->input('kelas'),
        ]); 
        $request->session()->flash('success', 'Kelas '.$request->input('kelas').' '.$request->input('tingkat').' berhasil diperbarui!');

        return response()->json([ 'success' => true ]);
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
        $kelas = MasterKelas::find($id);
        $kelas->delete();

        $request->session()->flash('danger', 'Kelas '.$kelas->kelas.' '.$kelas->tingkat.' telah dihapus!');
    
        return response()->json([ 'success' => true ]);
    }
}
