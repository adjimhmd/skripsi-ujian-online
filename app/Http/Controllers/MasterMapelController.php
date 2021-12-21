<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InstansiPendidikan;
use App\Models\MasterMapel;
use App\Models\User;
use App\Models\UserAdminInstansi;
use Auth;
use Illuminate\Http\Request;

class MasterMapelController extends Controller
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

        $last_update_mapel = MasterMapel::select('master_mapels.updated_at')
            ->orderBy('master_mapels.updated_at', 'desc')
            ->get();

        $jumlah_mapel = MasterMapel::select('*')->count();

        $mapels = MasterMapel::select('*')->orderBy('nama')->orderBy('materi')->get();
        
        // return $jumlah_mapel;

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        return view('AdminLTE/master-mapel', compact('foto_profil','user_admin_instansis','last_update_mapel', 'jumlah_mapel', 'mapels'));
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
        // return $request;
        $request->validate([
            'name' => ['string','max:50'],
            'materi' => ['max:100'],
            'file_impor' => ['mimes:xls,xlsx,csv|max:1024'],
        ]);

        if(empty($request->input('file_impor'))){
            MasterMapel::create([
                'nama' => strtolower($request->input('name')),
                'materi' => strtolower($request->input('materi')),
            ]); 
        }

        $request->session()->flash('success', 'Mata pelajaran '.ucwords($request->input('name')).' - Materi '.ucwords($request->input('materi')).' berhasil disimpan!');

        return redirect()->route('master-mapel.index');
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
        $program_mapel = MasterMapel::find($id);

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
        // dd($request);
        $mapel = MasterMapel::find($id);

        $mapel->update([
            'nama' => strtolower($request->input('nama')),
            'materi' => strtolower($request->input('materi')),
        ]); 

        $request->session()->flash('success', 'Mata pelajaran '.ucwords($mapel->nama).' - Materi '.ucwords($mapel->materi).' berhasil diperbarui!');
        
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
        
        $mapel = MasterMapel::find($id);
        $mapel->delete();

        $request->session()->flash('danger', 'Mata pelajaran '.ucwords($mapel->nama).' - Materi '.ucwords($mapel->materi).' telah dihapus!');
    
        return response()->json([ 'success' => true ]);
    }
}
