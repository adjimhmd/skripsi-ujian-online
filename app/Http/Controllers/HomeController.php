<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\InstansiPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
Use Exception;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        // return Auth::user();
        $id = Auth::user()->id;

        $foto_profil = DB::table('users')
            ->select('foto')
            ->where('id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('instansi_pendidikans.tipe')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();
// return $user_admin_instansis;
    
        if (Auth::user()->hasRole('siswa')){
            return redirect()->route('list-instansi.index');
        }
        else if (Auth::user()->hasRole('adm_instansi')){
            return redirect()->route('list-guru.index');
        }
        else if (Auth::user()->hasRole('guru')){
            return redirect()->route('list-instansi.index');
            // return redirect()->route('list.kelas.program.guru');
        }
        else{
            return view('AdminLTE/app', compact('foto_profil','id','user_admin_instansis'));
        }


    }

    public function upload(Request $request, $id)
    {
        // return $request;
        $request->validate([
            'foto' => ['required'],
            'foto.*' => ['required','mimes:jpeg,jpg,png|max:1024'],
        ]);
        
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('foto');
		$nama_file = time()."_".$file->getClientOriginalName();

        //  isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'img/bukti_pembayaran';

        $path = public_path($tujuan_upload.'\\'.$nama_file);
        Image::make($file->getRealPath())->save($path);

        // update tbl user
        User::where('id', $id)
            ->update(['bukti' => $tujuan_upload."/".$nama_file]);

        return redirect()->route('home');
                
    }
}
