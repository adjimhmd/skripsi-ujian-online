<?php

namespace App\Http\Controllers;

use App\Models\MasterMapel;
use App\Models\MasterMateri;
use App\Models\Spesialisasi;
use App\Models\User;
use App\Models\UserGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use phpDocumentor\Reflection\Types\Null_;

class MateriPembelajaranController extends Controller
{
    protected $folder_id;

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

        $last_update_master_materi = MasterMateri::select('master_materis.updated_at')
            ->orderBy('master_materis.updated_at', 'desc')
            ->get();

        $jumlah_master_materi = MasterMateri::select('*')->count();

        $master_materis = MasterMateri::select('*')->orderBy('master_mapel_id')->get();

        $id_user_guru = UserGuru::select('*')->where('user_id',$id)->first();

        $master_mapels = Spesialisasi::select('spesialisasis.*','master_mapels.nama')
            ->join('master_mapels', 'spesialisasis.master_mapel_id', '=', 'master_mapels.id')
            ->where('user_guru_id', '=', $id_user_guru->id)
            ->get();
        
        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $master_materis = MasterMateri::select('master_materis.*','users.name','users.foto','master_mapels.nama')
            ->join('master_mapels', 'master_materis.master_mapel_id', '=', 'master_mapels.id')
            ->join('user_gurus', 'master_materis.user_guru_id', '=', 'user_gurus.id')
            ->join('users', 'user_gurus.user_id', '=', 'users.id')
            ->where('master_materis.user_guru_id',$id_user_guru->id)
            ->get();


        // return $master_mapels;

        return view('AdminLTE/master-materi', compact('foto_profil','user_admin_instansis','last_update_master_materi', 'jumlah_master_materi', 'master_materis','master_mapels'));
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
            'file_materi' => ['max:5000'],
            // 'file_materi' => ['mimes:xls,xlsx,csv|max:10'],
		]);
        
        // menyimpan data file yang diupload ke local
		$file = $request->file('file_materi');
        $file_name = time().rand(100,999).'_'.$file->getClientOriginalName();
        $file->move('media',$file_name);

        // save to google drive
        Storage::disk('google')->put($file_name, file_get_contents(public_path('media\\'.$file_name)));
        File::delete(public_path('media\\'.$file_name));

        $id_user_guru=UserGuru::where('user_id',Auth::user()->id)->first();
        
        MasterMateri::create([
            'user_guru_id' => $id_user_guru->id,
            'master_mapel_id' => $request->input('mapel'),
            'deskripsi' => $request->input('deskripsi'),
            'link_gdrive' => Storage::disk('google')->url($file_name),
        ]); 

        $request->session()->flash('success', 'Materi pembelajaran '.ucwords($request->input('deskripsi')).' berhasil disimpan!');

        return redirect()->route('materi-pembelajaran.index');
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
        $master_materis = MasterMateri::find($id);

	    return response()->json([
	      'data' => $master_materis
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
        $id_user_guru=UserGuru::where('user_id',Auth::user()->id)->first();

        // Setup the validator
        $validator = Validator::make($request->all(), [
            'file_materi' => ['max:5000'],
        ]);

        // Validate the input and return correct response
        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()]);
        }
        else{
            $master_materis = MasterMateri::find($id);
            preg_match('~id=(.*?)&export~', $master_materis->link_gdrive, $output);

            if($request->file('file_materi')!=null){
            
                // menyimpan data file yang diupload ke local
                $file = $request->file('file_materi');
                $file_name = time().rand(100,999).'_'.$file->getClientOriginalName();
                $file->move('media',$file_name);

                // save to google drive
                Storage::disk('google')->put($file_name, file_get_contents(public_path('media\\'.$file_name)));
                File::delete(public_path('media\\'.$file_name));

                $master_materis->update([
                    'user_guru_id' => $id_user_guru->id,
                    'master_mapel_id' => $request->input('mapel'),
                    'deskripsi' => $request->input('deskripsi'),
                    'link_gdrive' => Storage::disk('google')->url($file_name),
                ]); 

            }
            else{
                $master_materis->update([
                    'user_guru_id' => $id_user_guru->id,
                    'master_mapel_id' => $request->input('mapel'),
                    'deskripsi' => $request->input('deskripsi'),
                ]); 
            }

            $request->session()->flash('success', 'Materi pembelajaran '.ucwords($request->input('deskripsi')).' berhasil disimpan!');

            return response()->json(['success'=>'Added new records.']);
        }
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
        $master_materis = MasterMateri::find($id);
        $master_materis->delete();
        preg_match('~id=(.*?)&export~', $master_materis->link_gdrive, $output);
        Storage::disk('google')->delete($output[1]);

        $request->session()->flash('danger', 'Materi. '.$master_materis->deskripsi.' telah dihapus!');

        return response()->json([ 'success' => true ]);
    }
}
