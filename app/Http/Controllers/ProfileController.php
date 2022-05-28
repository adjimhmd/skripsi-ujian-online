<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserSiswa;
use App\Models\UserGuru;
use App\Models\MasterKelas;
use App\Models\MasterMapel;
use App\Models\Rating;
use App\Models\UserAdminInstansi;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller
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
        
        $list_kelas = MasterKelas::select('*')
            ->get();

        $user_siswas = User::select('users.*','user_siswas.id as id_siswa','user_siswas.*')
            ->join('user_siswas', 'users.id', '=', 'user_siswas.user_id')
            ->where('users.id', '=', $id)
            ->get();
            
        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $user_guru = User::select('users.*','user_gurus.id as id_guru','user_gurus.*')
            ->join('user_gurus', 'users.id', '=', 'user_gurus.user_id')
            ->where('users.id', '=', $id)
            ->first();

        $spesialisasi = User::join('user_gurus', 'users.id', '=', 'user_gurus.user_id')
            ->join('spesialisasis', 'user_gurus.id', '=', 'spesialisasis.user_guru_id')
            ->where('users.id', '=', $id)
            ->get();

        $selectedSpesialisasi = $spesialisasi->pluck('master_mapel_id')->toArray();

        $user_admins = User::select('*')->where('users.id', '=', $id)->get();

        $list_spesialisasi = MasterMapel::orderBy('nama', 'asc')->get();

        $ratings = Rating::select('ratings.*','users.name','users.foto')
            ->where('user_guru_id',$user_guru->id_guru)
            ->join('user_siswas','ratings.user_siswa_id','user_siswas.id')
            ->join('users','user_siswas.user_id','users.id')
            ->get();

        $poin=0;
        foreach($ratings as $r){
            $poin=$poin+$r->angka;
        }

        $poin=$poin/$ratings->count();
        // return$poin;
        return view('AdminLTE/profile',compact('foto_profil','list_kelas','user_siswas','user_admin_instansis','user_guru','user_admins','id','list_spesialisasi','selectedSpesialisasi','poin','ratings'));
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

        if (Auth::user()->hasRole('adm_instansi')){

            $nik_db=UserAdminInstansi::select('nik')->where('user_id',$id)->first();

            if(empty($nik_db->nik)||$nik_db->nik!=$request->nik){
                $request->validate([
                    'nik' => ['digits:16','unique:user_admin_instansis', 'regex:/^[0-9]+$/'],    
                    'img_profile.*' => ['mimes:jpeg,jpg,png,gif'],                  
                    'img_profile' => ['max:512'],                  
                    'name' => ['string', 'max:100','regex:/^[a-zA-Z ]+$/'],
                ]);
            }  
        }
        else if (Auth::user()->hasRole('guru')){

            $nuptk_db=UserGuru::select('nuptk')->where('user_id',$id)->first();

            if(empty($nuptk_db->nuptk)||$nuptk_db->nuptk!=$request->nuptk){
                $request->validate([
                    'nuptk' => ['digits:16','unique:user_gurus', 'regex:/^[0-9]+$/'],    
                    'img_profile.*' => ['mimes:jpeg,jpg,png,gif'],                  
                    'img_profile' => ['max:512'],                  
                    'name' => ['string', 'max:100','regex:/^[a-zA-Z ]+$/'],
                    'no_telp' => ['min:10','max:13','regex:/^[0-9]+$/'], 
                ]);
            }
        }
        else if (Auth::user()->hasRole('siswa')){

            $nisn_db=UserSiswa::select('nisn')->where('user_id',$id)->first();
            
            if(empty($nisn_db->nisn)||$nisn_db->nisn!=$request->nisn){
                $request->validate([
                    'nisn' => ['digits:10','unique:user_siswas', 'regex:/^[0-9]+$/'],    
                    'img_profile.*' => ['mimes:jpeg,jpg,png,gif'],                  
                    'img_profile' => ['max:512'],                  
                    'name' => ['string', 'max:100','regex:/^[a-zA-Z ]+$/'],
                    'no_telp' => ['min:10','max:13','regex:/^[0-9]+$/'], 
                    'nama_wali' => ['string', 'max:100','regex:/^[a-zA-Z ]+$/'],
                    'telp_wali' => ['min:10','max:13','regex:/^[0-9]+$/'],  
                ]);
            }  
        }

        $request->validate([
            'img_profile.*' => ['mimes:jpeg,jpg,png,gif'],                  
            'img_profile' => ['max:512'],                  
            'name' => ['string', 'max:100','regex:/^[a-zA-Z ]+$/'],
            'no_telp' => ['min:10','max:13','regex:/^[0-9]+$/'], 
            'nama_wali' => ['string', 'max:100','regex:/^[a-zA-Z ]+$/'],
            'telp_wali' => ['min:10','max:13','regex:/^[0-9]+$/'],   
        ]);
        

        $user = User::find($id);
        $user_admin_instansi = UserAdminInstansi::where('user_id',$id);
        $user_siswa = UserSiswa::where('user_id',$id);
        // $user_guru = UserGuru::where('user_id',$id)->pluck('id')->toArray();
        $user_guru = UserGuru::where('user_id',$id);
        
        // menyimpan data file yang diupload ke variabel $file
        if(!empty($request->file('img_profile'))) {
            $file = $request->file('img_profile');
            $nama_file = time()."_".$file->getClientOriginalName();
            
            //  isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'img/foto_profil';

            $path = public_path($tujuan_upload.'\\'.$nama_file);
            Image::make($file->getRealPath())->resize(160, 160)->save($path);

            $user->update([
                'foto' => $tujuan_upload."/".$nama_file,
            ]); 
        }

        $user->update([
            'name' => $request->input('name'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
        ]); 
       
        if (Auth::user()->hasRole('adm_instansi')){
            $user_admin_instansi->update([
                'nik' => $request->input('nik'),
            ]); 
        }
        else if (Auth::user()->hasRole('guru')){

            $user_guru->update([
                'nuptk' => $request->input('nuptk'),
                'no_telp' => $request->input('no_telp'),
            ]); 

            
            // UserGuru::whereId($user_guru[$count])->update([
            //     'master_mapel_id' => $spesialisasi[$count],
            //     'nuptk' => $request->input('nuptk'),
            //     'no_telp' => $request->input('no_telp'),
            // ]); 

        }
        else if (Auth::user()->hasRole('siswa')){
            $user_siswa->update([
                'no_telp' => $request->input('no_telp'),
                'master_kelas_id' => $request->input('kelas'),
                'nisn' => $request->input('nisn'),
                'nama_wali' => $request->input('nama_wali'),
                'telp_wali' => $request->input('telp_wali'),
            ]); 
        }
        
        return redirect()->route('profile.index')
            ->with('success', 'Profile '.ucwords($request->input('name')).' berhasil diperbarui!');
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
}
