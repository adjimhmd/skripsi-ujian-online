<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BankSoal;
use App\Models\User;
use App\Models\ProgramMapel;
use App\Models\Kelas;
use App\Models\Jawaban;
use App\Models\InstansiPendidikan;
use App\Models\MasterKelas;
use App\Models\MasterMapel;
use App\Models\Spesialisasi;
use App\Models\UserGuru;
use Auth;
use Image;

class BankSoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth']);
        // $this->middleware('auth');
    }
    
    public function index()
    {
        $id = Auth::user()->id;

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $list_soal_objektif = BankSoal::select('bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*')
        ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
        ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
        ->orderBy('bank_soals.updated_at', 'desc')
        ->where('bank_soals.user_id', '=', $id)
        ->where('bank_soals.tipe_soal', '=', 'objektif')
        ->get();

        $list_jawaban_objektif = BankSoal::select('jawabans.*')
        ->join('jawabans', 'bank_soals.id', '=', 'jawabans.banksoal_id')
        ->where('bank_soals.user_id', '=', $id)
        ->where('bank_soals.tipe_soal', '=', 'objektif')
        ->get();

        $list_soal_subjektif = BankSoal::select('bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*')
        ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
        ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
        ->orderBy('bank_soals.updated_at', 'desc')
        ->where('bank_soals.user_id', '=', $id)
        ->where('bank_soals.tipe_soal', '=', 'subjektif')
        ->get();
        
        $list_soal_penjodohan = BankSoal::select('bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*')
        ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
        ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
        ->orderBy('bank_soals.updated_at', 'desc')
        ->where('bank_soals.user_id', '=', $id)
        ->where('bank_soals.tipe_soal', '=', 'penjodohan')
        ->get();
        // return $list_soal_penjodohan;
        
        $list_soal_truefalse = BankSoal::select('bank_soals.id as id_bank_soal','bank_soals.*','master_mapels.*','master_kelas.*')
        ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
        ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
        ->orderBy('bank_soals.updated_at', 'desc')
        ->where('bank_soals.user_id', '=', $id)
        ->where('bank_soals.tipe_soal', '=', 'true-false')
        ->get();

        $jumlah_objektif = BankSoal::select('*')
        ->where('bank_soals.user_id', '=', $id)
        ->where('bank_soals.tipe_soal', '=', 'objektif')
        ->count();

        $jumlah_subjektif = BankSoal::select('*')
        ->where('bank_soals.user_id', '=', $id)
        ->where('bank_soals.tipe_soal', '=', 'subjektif')
        ->count();

        $jumlah_penjodohan = BankSoal::select('*')
        ->where('bank_soals.user_id', '=', $id)
        ->where('bank_soals.tipe_soal', '=', 'penjodohan')
        ->count();

        $jumlah_truefalse = BankSoal::select('*')
        ->where('bank_soals.user_id', '=', $id)
        ->where('bank_soals.tipe_soal', '=', 'true-false')
        ->count();

        $last_update = BankSoal::select('updated_at')
        ->orderBy('updated_at', 'desc')
        ->where('bank_soals.user_id', '=', $id)
        ->get();

        // $pembayaran = User::select('pembayaran','bukti')
        // ->where('id', '=', $id)
        // ->get();

        $id_guru=UserGuru::where('user_id',$id)->first();

        $program_mapels = Spesialisasi::select('master_mapels.*')
            ->join('master_mapels', 'spesialisasis.master_mapel_id', '=', 'master_mapels.id')
            ->where('user_guru_id',$id_guru->id)
            ->get();

        $list_kelas = MasterKelas::orderBy('kelas','asc')->get();

            // return $list_soal_subjektif;
        // foreach($pembayaran as $bayar){
        //     if($bayar->pembayaran == '1' and !empty($bayar->bukti)){
                return view('AdminLTE/bank-soal', compact('last_update','foto_profil','user_admin_instansis','program_mapels', 'list_kelas', 'list_soal_objektif', 'list_jawaban_objektif', 'list_soal_subjektif', 'list_soal_penjodohan', 'list_soal_truefalse', 'jumlah_objektif', 'jumlah_subjektif', 'jumlah_penjodohan', 'jumlah_truefalse'));
            // }
        // }
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
        // ========== UPDATE SOAL ==========
        $soal=$request->input('summernote-soal');
        $soal = str_replace(['…'],['...'],$soal);
        $soal = str_replace(['–'],['-'],$soal);
        $dom_soal = new \DomDocument();
        @$dom_soal->loadHtml($soal, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images_dom_soal = $dom_soal->getElementsByTagName('img');

        foreach($images_dom_soal as $k => $img){
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $image_name= "/img/bank_soal/" . time().rand(0,999).$k.'.png';
            $path = public_path() . $image_name;

            file_put_contents($path, $data);
            
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $soal = $dom_soal->saveHTML();

        
        // ========== UPDATE JAWABAN ==========
        $jawaban = $request->input('summernote-jawaban');
        $jawaban = str_replace(['…'],['...'],$jawaban);
        $jawaban = str_replace(['–'],['-'],$jawaban);
        $dom_jawaban = new \DomDocument();
        @$dom_jawaban->loadHtml($jawaban, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images_dom_jawaban = $dom_jawaban->getElementsByTagName('img');

        foreach($images_dom_jawaban as $k_jawaban => $img_jawaban){
            $data_jawaban = $img_jawaban->getAttribute('src');

            list($type_jawaban, $data_jawaban) = explode(';', $data_jawaban);
            list(, $data_jawaban)      = explode(',', $data_jawaban);
            $data_jawaban = base64_decode($data_jawaban);

            $image_name_jawaban= "/img/bank_soal/" . time().rand(0,999).$k_jawaban.'.png';
            $path_jawaban = public_path() . $image_name_jawaban;

            file_put_contents($path_jawaban, $data_jawaban);
            
            $img_jawaban->removeAttribute('src');
            $img_jawaban->setAttribute('src', $image_name_jawaban);
        }

        $jawaban = $dom_jawaban->saveHTML();


        // ========== UPDATE PEMBAHASAN OBJEKTIF ==========
        $pembahasan_objektif=$request->input('pembahasan_objektif');
        $pembahasan_objektif = str_replace(['…'],['...'],$pembahasan_objektif);
        $pembahasan_objektif = str_replace(['–'],['-'],$pembahasan_objektif);
        $dom_pembahasan_objektif = new \DomDocument();
        @$dom_pembahasan_objektif->loadHtml($pembahasan_objektif, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images_pembahasan_objektif = $dom_pembahasan_objektif->getElementsByTagName('img');

        foreach($images_pembahasan_objektif as $k => $img){
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $image_name= "/img/bank_soal/" . time().rand(0,999).$k.'.png';
            $path = public_path() . $image_name;

            file_put_contents($path, $data);
            
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $pembahasan_objektif = $dom_pembahasan_objektif->saveHTML();


        // ========== UPDATE PEMBAHASAN SUBJEKTIF PENJODOHAN ==========
        $pembahasan_subjektif_penjodohan=$request->input('pembahasan_subjektif_penjodohan');
        $pembahasan_subjektif_penjodohan = str_replace(['…'],['...'],$pembahasan_subjektif_penjodohan);
        $pembahasan_subjektif_penjodohan = str_replace(['–'],['-'],$pembahasan_subjektif_penjodohan);
        $dom_pembahasan_subjektif_penjodohan = new \DomDocument();
        @$dom_pembahasan_subjektif_penjodohan->loadHtml($pembahasan_subjektif_penjodohan, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images_pembahasan_subjektif_penjodohan = $dom_pembahasan_subjektif_penjodohan->getElementsByTagName('img');

        foreach($images_pembahasan_subjektif_penjodohan as $k => $img){
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $image_name= "/img/bank_soal/" . time().rand(0,999).$k.'.png';
            $path = public_path() . $image_name;

            file_put_contents($path, $data);
            
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $pembahasan_subjektif_penjodohan = $dom_pembahasan_subjektif_penjodohan->saveHTML();


        // ========== UPDATE PEMBAHASAN TRUE FALSE ==========
        $pembahasan_true_false=$request->input('pembahasan_true_false');
        $pembahasan_true_false = str_replace(['…'],['...'],$pembahasan_true_false);
        $pembahasan_true_false = str_replace(['–'],['-'],$pembahasan_true_false);
        $dom_pembahasan_true_false = new \DomDocument();
        @$dom_pembahasan_true_false->loadHtml($pembahasan_true_false, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images_pembahasan_true_false = $dom_pembahasan_true_false->getElementsByTagName('img');

        foreach($images_pembahasan_true_false as $k => $img){
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);

            $image_name= "/img/bank_soal/" . time().rand(0,999).$k.'.png';
            $path = public_path() . $image_name;

            file_put_contents($path, $data);
            
            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $pembahasan_true_false = $dom_pembahasan_true_false->saveHTML();



        

        // return$request;
        $bankSoal = BankSoal::create([
            'user_id' => Auth::user()->id,
            'master_kelas_id' => $request->input('kelas'),
            'master_mapel_id' => $request->input('mapel'),
            'tipe_soal' => $request->input('tipe'),
            'soal' => $soal,
        ]); 

            // return$request;

        if($request->filled('summernote-jawaban')){ 
            $bankSoal->update([
                'jawaban' => $jawaban,
                'pembahasan' => $pembahasan_subjektif_penjodohan,
            ]); 

        }elseif($request->filled('radioJawaban')){
            $radioJawaban = $request->input('radioJawaban');
            $bankSoal->update([
                'jawaban' => $radioJawaban,
                'pembahasan' => $pembahasan_true_false,
            ]); 

        }elseif($request->filled('jawaban_pilihan')){
            $jawaban_pilihan = $request->input('jawaban_pilihan');
            $jawaban_pilihan = str_replace(['…'],['...'],$jawaban_pilihan);
            $jawaban_pilihan = str_replace(['–'],['-'],$jawaban_pilihan);
            $status = $request->input('cb');

            for($count = 0; $count < count($jawaban_pilihan); $count++){

                if(!empty($jawaban_pilihan[$count])){
                    // ========== UPDATE JAWABAN pilihan ganda ==========
                    $dom_jawaban_pilihan = new \DomDocument();
                    @$dom_jawaban_pilihan->loadHtml($jawaban_pilihan[$count], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
                    $images_jawaban_pilihan = $dom_jawaban_pilihan->getElementsByTagName('img');

                    foreach($images_jawaban_pilihan as $k => $img){
                        $data = $img->getAttribute('src');

                        list($type, $data) = explode(';', $data);
                        list(, $data)      = explode(',', $data);
                        $data = base64_decode($data);

                        $image_name= "/img/bank_soal/" . time().rand(0,999).$k.'.png';
                        $path = public_path() . $image_name;

                        file_put_contents($path, $data);
                        
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $image_name);
                    }

                    $jawaban_pilihan[$count] = $dom_jawaban_pilihan->saveHTML();

                }
                else if(empty($jawaban[$count])){
                    $jawaban_pilihan[$count] = '0';
                }
                elseif(empty($status[$count+1])){
                    $status[$count+1] = '0';
                }
                // echo $count.') '.$jawaban[$count]. $status[$count+1].'<br><br><br>';
                $bankSoal->update([
                    'jawaban' => null,
                    'pembahasan' => $pembahasan_objektif,
                ]); 

                Jawaban::create([
                    'banksoal_id' =>  $bankSoal->id,
                    'jawaban' => $jawaban_pilihan[$count],
                    'status' => $status[$count+1],
                ]);
            }
        }

        if($request->input('tipe')=='objektif'){
            $tipe='Pilihan Ganda';
        }
        else if($request->input('tipe')=='subjektif'){
            $tipe='Essay';
        }
        else if($request->input('tipe')=='penjodohan'){
            $tipe='Penjodohan';
        }
        else if($request->input('tipe')=='true-false'){
            $tipe='True False';
        }

        return redirect()->route('bank_soals.index')
            ->with('success','Soal '.$tipe.' berhasil disimpan!');
        
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
        $id_user = Auth::user()->id;
        
        $foto_profil = User::select('foto')
            ->where('id', '=', $id_user)
            ->get();

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $id_guru=UserGuru::where('user_id',$id_user)->first();

        $list_program_mapels = Spesialisasi::select('master_mapels.*')
            ->join('master_mapels', 'spesialisasis.master_mapel_id', '=', 'master_mapels.id')
            ->where('user_guru_id',$id_guru->id)
            ->get();

        $list_kelas = MasterKelas::orderBy('kelas','asc')->get();

        $program_mapels = BankSoal::select('master_mapels.id')
            ->join('master_mapels', 'bank_soals.master_mapel_id', '=', 'master_mapels.id')
            ->where('bank_soals.id', '=', $id)
            ->get();

        $kelas = BankSoal::select('master_kelas.id')
            ->join('master_kelas', 'bank_soals.master_kelas_id', '=', 'master_kelas.id')
            ->where('bank_soals.id', '=', $id)
            ->get();

        $soal = BankSoal::select('bank_soals.*')
            ->where('id', '=', $id)
            ->get();
            
        $jawaban = Jawaban::select('jawabans.*')
            ->where('banksoal_id', '=', $id)
            ->get();

        return view('AdminLTE/edit-banksoal', compact('foto_profil','user_admin_instansis','list_program_mapels', 'list_kelas', 'program_mapels', 'kelas', 'soal', 'jawaban', 'id'));
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
        // ========== UPDATE SOAL ==========
        $soal=$request->input('summernote-soal');
        $soal = str_replace(['…'],['...'],$soal);
        $soal = str_replace(['–'],['-'],$soal);
        $dom_soal = new \DomDocument();
        @$dom_soal->loadHtml($soal, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images_dom_soal = $dom_soal->getElementsByTagName('img');

        foreach($images_dom_soal as $k => $img){
            $data = $img->getAttribute('src');
            if (str_contains($data, 'data:image')) { 

                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);

                $image_name= "/img/bank_soal/" . time().rand(0,999).$k.'.png';
                $path = public_path() . $image_name;

                file_put_contents($path, $data);
                
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $soal = $dom_soal->saveHTML();

        
        // ========== UPDATE JAWABAN ==========
        $jawaban = $request->input('summernote-jawaban');
        $jawaban = str_replace(['…'],['...'],$jawaban);
        $jawaban = str_replace(['–'],['-'],$jawaban);
        $dom_jawaban = new \DomDocument();
        @$dom_jawaban->loadHtml($jawaban, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images_dom_jawaban = $dom_jawaban->getElementsByTagName('img');

        foreach($images_dom_jawaban as $k_jawaban => $img_jawaban){
            $data_jawaban = $img_jawaban->getAttribute('src');
            if (str_contains($data_jawaban, 'data:image')) { 

                list($type_jawaban, $data_jawaban) = explode(';', $data_jawaban);
                list(, $data_jawaban)      = explode(',', $data_jawaban);
                $data_jawaban = base64_decode($data_jawaban);

                $image_name_jawaban= "/img/bank_soal/" . time().rand(0,999).$k_jawaban.'.png';
                $path_jawaban = public_path() . $image_name_jawaban;

                file_put_contents($path_jawaban, $data_jawaban);
                
                $img_jawaban->removeAttribute('src');
                $img_jawaban->setAttribute('src', $image_name_jawaban);
            }
        }

        $jawaban = $dom_jawaban->saveHTML();


        // ========== UPDATE PEMBAHASAN OBJEKTIF ==========
        $pembahasan_objektif=$request->input('pembahasan_objektif');
        $pembahasan_objektif = str_replace(['…'],['...'],$pembahasan_objektif);
        $pembahasan_objektif = str_replace(['–'],['-'],$pembahasan_objektif);
        $dom_pembahasan_objektif = new \DomDocument();
        @$dom_pembahasan_objektif->loadHtml($pembahasan_objektif, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images_pembahasan_objektif = $dom_pembahasan_objektif->getElementsByTagName('img');

        foreach($images_pembahasan_objektif as $k => $img){
            $data = $img->getAttribute('src');
            if (str_contains($data, 'data:image')) { 

                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);

                $image_name= "/img/bank_soal/" . time().rand(0,999).$k.'.png';
                $path = public_path() . $image_name;

                file_put_contents($path, $data);
                
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $pembahasan_objektif = $dom_pembahasan_objektif->saveHTML();


        // ========== UPDATE PEMBAHASAN SUBJEKTIF PENJODOHAN ==========
        $pembahasan_subjektif_penjodohan=$request->input('pembahasan_subjektif_penjodohan');
        $pembahasan_subjektif_penjodohan = str_replace(['…'],['...'],$pembahasan_subjektif_penjodohan);
        $pembahasan_subjektif_penjodohan = str_replace(['–'],['-'],$pembahasan_subjektif_penjodohan);
        $dom_pembahasan_subjektif_penjodohan = new \DomDocument();
        @$dom_pembahasan_subjektif_penjodohan->loadHtml($pembahasan_subjektif_penjodohan, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images_pembahasan_subjektif_penjodohan = $dom_pembahasan_subjektif_penjodohan->getElementsByTagName('img');

        foreach($images_pembahasan_subjektif_penjodohan as $k => $img){
            $data = $img->getAttribute('src');
            if (str_contains($data, 'data:image')) { 

                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);

                $image_name= "/img/bank_soal/" . time().rand(0,999).$k.'.png';
                $path = public_path() . $image_name;

                file_put_contents($path, $data);
                
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $pembahasan_subjektif_penjodohan = $dom_pembahasan_subjektif_penjodohan->saveHTML();


        // ========== UPDATE PEMBAHASAN TRUE FALSE ==========
        $pembahasan_true_false=$request->input('pembahasan_true_false');
        $pembahasan_true_false = str_replace(['…'],['...'],$pembahasan_true_false);
        $pembahasan_true_false = str_replace(['–'],['-'],$pembahasan_true_false);
        $dom_pembahasan_true_false = new \DomDocument();
        @$dom_pembahasan_true_false->loadHtml($pembahasan_true_false, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
        $images_pembahasan_true_false = $dom_pembahasan_true_false->getElementsByTagName('img');

        foreach($images_pembahasan_true_false as $k => $img){
            $data = $img->getAttribute('src');
            if (str_contains($data, 'data:image')) { 

                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);

                $image_name= "/img/bank_soal/" . time().rand(0,999).$k.'.png';
                $path = public_path() . $image_name;

                file_put_contents($path, $data);
                
                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $pembahasan_true_false = $dom_pembahasan_true_false->saveHTML();



        //get data Blog by ID
        $bankSoal = BankSoal::find($id);
        $updateJawaban = Jawaban::where('banksoal_id',$id);

        $bankSoal->update([
            'user_id' => Auth::user()->id,
            'master_kelas_id' => $request->input('kelas'),
            'master_mapel_id' => $request->input('mapel'),
            'tipe_soal' => $request->input('tipe'),
            'soal' => $soal,
        ]); 

        if($request->filled('summernote-jawaban')){ 

            $bankSoal->update([
                'jawaban' => $jawaban,
                'pembahasan' => $pembahasan_subjektif_penjodohan,
            ]);

        }elseif($request->filled('radioJawaban')){
            $radioJawaban = $request->input('radioJawaban');
           
            $bankSoal->update([
                'jawaban' => $radioJawaban,
                'pembahasan' => $pembahasan_true_false,
            ]);
            
        }elseif($request->filled('jawaban_pilihan')){
            $jawaban_pilihan = $request->input('jawaban_pilihan');
            $jawaban_pilihan = str_replace(['…'],['...'],$jawaban_pilihan);
            $jawaban_pilihan = str_replace(['–'],['-'],$jawaban_pilihan);
            $status = $request->input('cb');
            $jwb = Jawaban::select('id')->where('banksoal_id', '=', $id)->first();

            for($count = 0; $count < count($jawaban_pilihan); $count++){
                
                if(!empty($jawaban_pilihan[$count])){
                    // ========== UPDATE PEMBAHASAN TRUE FALSE ==========
                    $dom_jawaban_pilihan = new \DomDocument();
                    @$dom_jawaban_pilihan->loadHtml($jawaban_pilihan[$count], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    
                    $images_jawaban_pilihan = $dom_jawaban_pilihan->getElementsByTagName('img');

                    foreach($images_jawaban_pilihan as $k => $img){
                        $data = $img->getAttribute('src');
                        if (str_contains($data, 'data:image')) { 

                            list($type, $data) = explode(';', $data);
                            list(, $data)      = explode(',', $data);
                            $data = base64_decode($data);

                            $image_name= "/img/bank_soal/" . time().rand(0,999).$k.'.png';
                            $path = public_path() . $image_name;

                            file_put_contents($path, $data);
                            
                            $img->removeAttribute('src');
                            $img->setAttribute('src', $image_name);
                        }
                    }

                    $jawaban_pilihan[$count] = $dom_jawaban_pilihan->saveHTML();

                }else if(empty($jawaban_pilihan[$count])){
                    $jawaban_pilihan[$count] = '0';
                }
                elseif(empty($status[$count+1])){
                    $status[$count+1] = '0';
                }
                
                $bankSoal->update([
                    'jawaban' => null,
                    'pembahasan' => $pembahasan_objektif,
                ]); 

                Jawaban::where('id',$jwb->id)->where('banksoal_id',$id)->update([
                    'banksoal_id' =>  $bankSoal->id,
                    'jawaban' => $jawaban_pilihan[$count],
                    'status' => $status[$count+1],
                ]);
                $jwb->id++;
            }
        }


        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('bank_soals.index')
            ->with('success', 'Soal '.ucwords($request->input('tipe')).' berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // return $request;
        // $bankSoal = BankSoal::find($request->id);
        // $jawaban = Jawaban::where('banksoal_id',$request->id);
        // $bankSoal->delete();
        // $jawaban->delete();
    
        // return redirect()->route('bank_soals.index')
        //                 ->with('success','Soal '.ucwords($request->input('tipe')).' berhasil dihapus!');

        // dd($request);
        $bankSoal = BankSoal::find($id);
        $jawaban = Jawaban::where('banksoal_id',$id);
        $bankSoal->delete();
        $jawaban->delete();

        $request->session()->flash('danger', 'Soal '.ucwords($request->input('tipe')).' berhasil dihapus!');
    
        return response()->json([ 'success' => true ]);
    }
}
