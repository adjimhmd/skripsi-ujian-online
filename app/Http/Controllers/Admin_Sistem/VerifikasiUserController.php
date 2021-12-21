<?php

namespace App\Http\Controllers\Admin_Sistem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankSoal;
use App\Models\User;
use App\Models\Jawaban;
use Auth;

class VerifikasiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(['auth']);
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

        $last_update = User::select(
            'users.updated_at',
            'roles.name AS nama_role')
            ->orderBy('users.updated_at', 'desc')
            ->where('roles.name', '!=', 'adm_sistem')
            ->where('pembayaran', '=', '0')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->get();

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();
        
        $list_user = User::select(
            'users.id AS id_user',
            'users.*',
            'roles.name AS nama_role',
            'user_gurus.id AS id_guru',
            'user_gurus.*',
            'user_siswas.id AS id_siswa',
            'user_siswas.*',
            'user_admin_instansis.id AS id_admin_instansi',
            'user_admin_instansis.*')
            ->where('bukti', '!=', '0')
            ->where('pembayaran', '=', '0')
            ->leftJoin('user_gurus', 'users.id', '=', 'user_gurus.user_id')
            ->leftJoin('user_siswas', 'users.id', '=', 'user_siswas.user_id')
            ->leftJoin('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->get();
            // return$list_user;
        return view('AdminLTE/verifikasi-user', compact('last_update', 'foto_profil', 'list_user'));
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
        // return $request;
        
        //get data Blog by ID
        $updateUser = User::find($request->id);

        if ($request->submitbutton == '1') {
            $updateUser->update([
                'pembayaran' =>  '1',
            ]);
        } else if ($request->submitbutton == '0'){
            $updateUser->update([
                'pembayaran' =>  '0',
            ]);
        } 

        return redirect()->route('verifikasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $request->id;
    }
}
