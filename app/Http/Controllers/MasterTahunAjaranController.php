<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\InstansiPendidikan;
use App\Models\MasterTahunAjaran;
use App\Models\User;
use App\Models\UserAdminInstansi;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;

class MasterTahunAjaranController extends Controller
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

        $last_update_tahun_ajaran = MasterTahunAjaran::select('master_tahun_ajarans.updated_at')
            ->orderBy('master_tahun_ajarans.updated_at', 'desc')
            ->get();

        $jumlah_tahun_ajaran = MasterTahunAjaran::select('*')->count();

        $tahun_ajarans = MasterTahunAjaran::select('*')->orderBy('tahun_awal')->orderBy('semester')->get();
        
        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        // return $jumlah_mapel;

        return view('AdminLTE/master-tahun-ajaran', compact('foto_profil','user_admin_instansis','last_update_tahun_ajaran', 'jumlah_tahun_ajaran', 'tahun_ajarans'));
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
        // return $request->semester;
        
        $tahun_ajarans = MasterTahunAjaran::select('*')->get();

        $hasil="beda";
        foreach($tahun_ajarans as $ta){
            if($ta->tahun_awal==$request->tanggal_awal && $ta->tahun_akhir==$request->tanggal_akhir && $ta->semester==$request->semester){
                $hasil=$ta->semester;
            }
        }

        // return$request->semester.'=='.$hasil;
        $tgl_awal=$request->tanggal_awal+1;
        $request->validate([
            'tanggal_akhir' => ['in:'.$tgl_awal],
            'semester' => ['notIn:'.$hasil],
            'file_impor' => ['mimes:xls,xlsx,csv|max:1024'],
        ]);
        
        if(empty($request->input('file_impor'))){
            MasterTahunAjaran::create([
                'tahun_awal' => $request->input('tanggal_awal'),
                'tahun_akhir' => $request->input('tanggal_akhir'),
                'semester' => $request->input('semester'),
            ]); 
        }

        $request->session()->flash('success', 'TA. '.$request->input('tanggal_awal').'/'.$request->input('tanggal_akhir').' Semester '.$request->input('semester').' berhasil disimpan!');

        return redirect()->route('master-tahun-ajaran.index');
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
        $tahun_ajarans = MasterTahunAjaran::find($id);

	    return response()->json([
	      'data' => $tahun_ajarans
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
        $tgl_awal=$request->input('tahun_awal')+1;
        
        $tahun_ajarans = MasterTahunAjaran::select('*')->get();

        $hasil="beda";

        foreach($tahun_ajarans as $ta){
            if($ta->tahun_awal==$request->tahun_awal && $ta->tahun_akhir==$request->tahun_akhir && $ta->semester==$request->semester){
                $hasil=$ta->semester;
            }
        // dump($request->tahun_awal.'=='.$ta->tahun_awal);
        }


        // Setup the validator
        $validator = Validator::make($request->all(), [
            'tahun_akhir' => 'in:'.$tgl_awal,
            'semester' => 'notIn:'.$hasil,
            'file_impor' => 'mimes:xls,xlsx,csv|max:1024'
        ]);

        // Validate the input and return correct response
        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()]);
        }
        else{
            $tahun_ajarans = MasterTahunAjaran::find($id);

            $tahun_ajarans->update([
                'tahun_awal' => $request->input('tahun_awal'),
                'tahun_akhir' => $request->input('tahun_akhir'),
                'semester' => $request->input('semester'),
            ]); 

            $request->session()->flash('success', 'TA. '.$request->input('tahun_awal').'/'.$request->input('tahun_akhir').' Semester '.ucwords($request->input('semester')).' berhasil disimpan!');

            return response()->json(['success'=>'Added new records.']);
        }
       
        
        // return response()->json([ 'success' => true ]);
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
        
        $mapel = MasterTahunAjaran::find($id);
        // dd($mapel->tahun_awal);
        $mapel->delete();

        $request->session()->flash('danger', 'TA. '.$mapel->tahun_awal.'/'.$mapel->tahun_akhir.' Semester '.ucwords($mapel->semester).' telah dihapus!');
    
        return response()->json([ 'success' => true ]);
    }
}
