<?php

namespace App\Http\Controllers;

use App\Models\HargaKelasProgram;
use App\Models\KelasProgram;
use App\Models\RombonganBelajar;
use App\Models\User;
use App\Models\UserSiswa;
use Illuminate\Http\Request;
use App\Services\Midtrans\CreateSnapTokenService; // => letakkan pada bagian atas class
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $order)
    {
        // return $order;

        $id_user = Auth::user()->id;
        $id_siswa = UserSiswa::select('id')->where('user_id',$id_user)->first();
        $profil=User::select('foto')->where('id',$id_user)->first();
        $harga_kelas=HargaKelasProgram::where('id',$order->id_harga)->first();


        // harus melengkapi profil
        if($profil->foto==null){
            return redirect()->route('profile.index')
            ->with('warning', 'Silahkan lengkapi profile untuk melanjutkan pendaftaran kelas/program kursus!');
        }
        
        // kalau kelas/program kursus gratis, skip pembayaran
        else if($harga_kelas->harga=='0'){
            // return "gratis";
            
            $cek_rombel=RombonganBelajar::where('kelas_program_id',$order->input('id_kelas_program'))
                ->where('user_siswa_id',$id_siswa->id)
                ->first();

            if($cek_rombel){
                $cek_rombel->update([
                    'kelas_program_id' => $order->input('id_kelas_program'),
                    'user_siswa_id' => $id_siswa->id,
                    'status' => '0',
                    'bukti_bayar' => NULL,
                ]); 
            }
            else{
                $rombongan=RombonganBelajar::create([
                    'kelas_program_id' => $order->input('id_kelas_program'),
                    'user_siswa_id' => $id_siswa->id,
                    'status' => '0',
                ]); 
            }

            return redirect()->route('list.kelas.program');            
        }

        // redirect pembayaran
        else{
            $snapToken = $order->snap_token;

            if(empty($order->id_rombongan_belajar)){

                if(empty($snapToken)) {

                    $cek_rombel=RombonganBelajar::where('kelas_program_id',$order->id_kelas_program)
                        ->where('user_siswa_id',$id_siswa->id)
                        ->first();

                    if($cek_rombel){
                        $cek_rombel->update([
                            'kelas_program_id' => $order->id_kelas_program,
                            'user_siswa_id' => $id_siswa->id,
                            'harga_kelas_program_id' => $order->id_harga,
                            'bukti_bayar' => NULL,
                        ]); 
                    }
                    else{
                        $cek_rombel=RombonganBelajar::create([
                            'kelas_program_id' => $order->id_kelas_program,
                            'user_siswa_id' => $id_siswa->id,
                            'harga_kelas_program_id' => $order->id_harga,
                        ]);
                    }

                    $new_order=RombonganBelajar::select('rombongan_belajars.*','rombongan_belajars.id as id_rombel',
                        'kelas_programs.*',
                        'harga_kelas_programs.*',
                        'user_siswas.*',
                        'users.*')
                        ->join('kelas_programs', 'rombongan_belajars.kelas_program_id', '=', 'kelas_programs.id')
                        ->join('harga_kelas_programs', 'rombongan_belajars.harga_kelas_program_id', '=', 'harga_kelas_programs.id')
                        ->join('user_siswas', 'rombongan_belajars.user_siswa_id', '=', 'user_siswas.id')
                        ->join('users', 'user_siswas.user_id', '=', 'users.id')
                        ->where('rombongan_belajars.id',$cek_rombel->id)
                        ->first();

                    // Jika snap token masih NULL, buat token snap dan simpan ke database
                    $midtrans = new CreateSnapTokenService($new_order);
                    $snapToken = $midtrans->getSnapToken();
                    
                    $update_order = RombonganBelajar::find($cek_rombel->id);
                    $update_order->update([
                        'bukti_bayar' => $snapToken,
                    ]); 
                }

                $data_siswa=UserSiswa::join('users','user_siswas.user_id','=','users.id')
                    ->where('user_siswas.id',$update_order->user_siswa_id)
                    ->first();
                $data_kelas_program=KelasProgram::select('kelas_programs.*','harga_kelas_programs.jumlah_bulan','harga_kelas_programs.harga','instansi_pendidikans.nama','instansi_pendidikans.alamat')
                    ->join('harga_kelas_programs','kelas_programs.id','=','harga_kelas_programs.kelas_program_id')
                    ->join('instansi_pendidikans','kelas_programs.instansi_pendidikan_id','=','instansi_pendidikans.id')
                    ->where('kelas_programs.id',$update_order->kelas_program_id)
                    ->first();
                    // return $data_kelas_program;
                return view('AdminLTE/invoice', compact('update_order', 'snapToken','data_siswa','data_kelas_program'));
            }
            else {
                $new_order=RombonganBelajar::select('rombongan_belajars.*','rombongan_belajars.id as id_rombel',
                    'kelas_programs.*',
                    'harga_kelas_programs.*',
                    'user_siswas.*',
                    'users.*')
                    ->join('kelas_programs', 'rombongan_belajars.kelas_program_id', '=', 'kelas_programs.id')
                    ->join('harga_kelas_programs', 'rombongan_belajars.harga_kelas_program_id', '=', 'harga_kelas_programs.id')
                    ->join('user_siswas', 'rombongan_belajars.user_siswa_id', '=', 'user_siswas.id')
                    ->join('users', 'user_siswas.user_id', '=', 'users.id')
                    ->where('rombongan_belajars.id',$order->id_rombongan_belajar)
                    ->first();

                // Jika snap token masih NULL, buat token snap dan simpan ke database
                $midtrans = new CreateSnapTokenService($new_order);
                $snapToken = $midtrans->getSnapToken();
                
                $update_order = RombonganBelajar::find($order->id_rombongan_belajar);
                $update_order->update([
                    'bukti_bayar' => $snapToken,
                ]); 

                $data_siswa=UserSiswa::join('users','user_siswas.user_id','=','users.id')
                    ->where('user_siswas.id',$update_order->user_siswa_id)
                    ->first();
                $data_kelas_program=KelasProgram::select('kelas_programs.*','harga_kelas_programs.jumlah_bulan','harga_kelas_programs.harga','instansi_pendidikans.nama','instansi_pendidikans.alamat')
                    ->join('harga_kelas_programs','kelas_programs.id','=','harga_kelas_programs.kelas_program_id')
                    ->join('instansi_pendidikans','kelas_programs.instansi_pendidikan_id','=','instansi_pendidikans.id')
                    ->where('kelas_programs.id',$update_order->kelas_program_id)
                    ->first();
                return view('AdminLTE/invoice', compact('update_order', 'snapToken','data_siswa','data_kelas_program'));
            }
        }

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
        $update_order = RombonganBelajar::find($id);
        
        $update_order->update([
            'status' => $request->status,
        ]); 
       
        return json_encode(array('statusCode'=>200));
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
