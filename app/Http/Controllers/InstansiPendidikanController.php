<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\InstansiPendidikan;
use App\Models\Rating;
use App\Models\UserAdminInstansi;
use Auth;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;
use Illuminate\Support\Facades\Log;

class InstansiPendidikanController extends Controller
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

        $user_admin_instansis = User::select('users.*','user_admin_instansis.id as id_adm_instansi','user_admin_instansis.*','instansi_pendidikans.id as id_instansi','instansi_pendidikans.*')
            ->join('user_admin_instansis', 'users.id', '=', 'user_admin_instansis.user_id')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('users.id', '=', $id)
            ->get();

        $id_instansi = '';
        foreach ($user_admin_instansis as $user_admin_instansi){
            $id_instansi = $user_admin_instansi->id_instansi;

            $detail_alamats = Village::select(
                'indonesia_provinces.id as id_province',
                'indonesia_provinces.name as province',
                'indonesia_cities.id as id_city',
                'indonesia_cities.name as city',
                'indonesia_districts.id as id_district',
                'indonesia_districts.name as district',
                'indonesia_villages.id as id_village',
                'indonesia_villages.name as village')
                ->join('indonesia_districts', 'indonesia_villages.district_id', '=', 'indonesia_districts.id')
                ->join('indonesia_cities', 'indonesia_districts.city_id', '=', 'indonesia_cities.id')
                ->join('indonesia_provinces', 'indonesia_cities.province_id', '=', 'indonesia_provinces.id')
                ->where('indonesia_villages.id', '=', $user_admin_instansi->desa_id)
                ->get();
        }

        $id_province=NULL;
        $id_city=NULL;
        $id_district=NULL;

        foreach ($detail_alamats as $detail_alamat){
            $id_province=$detail_alamat->id_province;
            $id_city=$detail_alamat->id_city;
            $id_district=$detail_alamat->id_district;
        }
        $provinces = Province::orderBy('name')->pluck('name', 'id');

        $cities = City::select('indonesia_cities.id as id_city','indonesia_cities.name as city')
            ->join('indonesia_provinces', 'indonesia_cities.province_id', '=', 'indonesia_provinces.id')
            ->where('indonesia_provinces.id', '=', $id_province)
            ->get();
            
        $districts = District::select('indonesia_districts.id as id_district','indonesia_districts.name as district')
            ->join('indonesia_cities', 'indonesia_districts.city_id', '=', 'indonesia_cities.id')
            ->where('indonesia_cities.id', '=', $id_city)
            ->get();
            
        $villages = Village::select('indonesia_villages.id as id_village','indonesia_villages.name as village')
            ->join('indonesia_districts', 'indonesia_villages.district_id', '=', 'indonesia_districts.id')
            ->where('indonesia_districts.id', '=', $id_district)
            ->get();

        $ratings = Rating::select('ratings.*','users.name','users.foto')
            ->where('instansi_pendidikan_id',$id_instansi)
            ->join('user_siswas','ratings.user_siswa_id','user_siswas.id')
            ->join('users','user_siswas.user_id','users.id')
            ->get();

        $rating_notNull = Rating::whereNotNull('angka')
            ->where('instansi_pendidikan_id',$id_instansi)
            ->join('user_siswas','ratings.user_siswa_id','user_siswas.id')
            ->join('users','user_siswas.user_id','users.id')
            ->count();

        $poin=0;
        foreach($ratings as $r){
            $poin=$poin+$r->angka;
        }
        if($ratings->count()>0){
            $poin=$poin/$rating_notNull;
        }

            // return$user_admin_instansis;
        return view('AdminLTE/profile_instansi',['provinces' => $provinces],compact('foto_profil','id','user_admin_instansis','detail_alamats','cities','districts','villages','ratings','poin'));
    }
    
    public function show_kota(Request $request)
    {
        Log::info('Tes information.'); //muncul di ..\WebsiteSkripsi-recent\storage\logs
        $cities = City::where('province_id', $request->get('id'))->pluck('name','id');
        return response()->json($cities);
    }

    public function show_kecamatan(Request $request)
    {
        $districts = District::where('city_id', $request->get('id'))->pluck('name', 'id');
        return response()->json($districts);
    }

    public function show_desa(Request $request)
    {
        $villages = Village::where('district_id', $request->get('id'))->pluck('name', 'id');
        return response()->json($villages);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_siswa()
    {
        //
        $id = Auth::user()->id;

        $foto_profil = User::select('foto')
            ->where('id', '=', $id)
            ->get();

        $list_sekolah = InstansiPendidikan::select('instansi_pendidikans.id','instansi_pendidikans.nama as instansi','alamat','tipe','npsn','nilek','indonesia_provinces.name as provinsi','indonesia_cities.name as kota','indonesia_districts.name as kecamatan','indonesia_villages.name as desa')
            ->join('indonesia_villages', 'instansi_pendidikans.desa_id', '=', 'indonesia_villages.id')
            ->join('indonesia_districts', 'indonesia_villages.district_id', '=', 'indonesia_districts.id')
            ->join('indonesia_cities', 'indonesia_districts.city_id', '=', 'indonesia_cities.id')
            ->join('indonesia_provinces', 'indonesia_cities.province_id', '=', 'indonesia_provinces.id')
            ->where('instansi_pendidikans.tipe', '=', 'sekolah')
            ->get();

        $list_lembaga_kurus = InstansiPendidikan::select('instansi_pendidikans.id','instansi_pendidikans.nama as instansi','alamat','tipe','npsn','nilek','indonesia_provinces.name as provinsi','indonesia_cities.name as kota','indonesia_districts.name as kecamatan','indonesia_villages.name as desa')
            ->join('indonesia_villages', 'instansi_pendidikans.desa_id', '=', 'indonesia_villages.id')
            ->join('indonesia_districts', 'indonesia_villages.district_id', '=', 'indonesia_districts.id')
            ->join('indonesia_cities', 'indonesia_districts.city_id', '=', 'indonesia_cities.id')
            ->join('indonesia_provinces', 'indonesia_cities.province_id', '=', 'indonesia_provinces.id')
            ->where('instansi_pendidikans.tipe', '=', 'lembaga_kurus')
            ->get();


        $last_update = InstansiPendidikan::select('updated_at')
            ->orderBy('updated_at', 'desc')
            ->get();

        $jumlah_lembaga_kursus = InstansiPendidikan::select('*')
            ->where('instansi_pendidikans.tipe', '=', 'lembaga_kurus')
            ->count();

        $jumlah_sekolah = InstansiPendidikan::select('*')
            ->where('instansi_pendidikans.tipe', '=', 'sekolah')
            ->count();
            
        return view('AdminLTE/list_instansi', compact('foto_profil','id','list_sekolah','list_lembaga_kurus','last_update','jumlah_sekolah','jumlah_lembaga_kursus'));
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
        $npsn = UserAdminInstansi::select('nomor_induk')
            ->join('instansi_pendidikans', 'user_admin_instansis.instansi_pendidikan_id', '=', 'instansi_pendidikans.id')
            ->where('user_admin_instansis.user_id', '=', Auth::user()->id)
            ->first();

        // return$npsn->nomor_induk;

        if($request->input('nomor_induk')!=$npsn->nomor_induk){
            $request->validate([
                'nama_instansi' => ['string', 'max:75'],
                'nomor_induk' => ['unique:instansi_pendidikans', 'regex:/^[0-9]+$/'],            
                'alamat_instansi' => ['string', 'max:100'],
            ]);
        };

        $isntansi_pendidikan = InstansiPendidikan::find($id);

        $isntansi_pendidikan->update([
            'nama' => $request->input('nama_instansi'),
            'alamat' => strtolower($request->input('alamat_instansi')),
            'tipe' => $request->input('tipe'),
            'jenjang' => $request->input('jenjang'),
            'nomor_induk' => $request->input('nomor_induk'),
            'desa_id' => $request->input('desa'),
        ]); 
               
        return redirect()->route('instansi-pendidikan.index')
            ->with('success', 'Instansi Pendidikan '.ucwords($request->input('nama_instansi')).' berhasil diperbarui!');
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

    public function nonaktif_lembaga(Request $request)
    {
        //
        $isntansi_pendidikan = InstansiPendidikan::find($request->id_instansi);

        if($request->status=='1')
            $isntansi_pendidikan->update([
                'status' => '0',
            ]);
        else{
            $isntansi_pendidikan->update([
                'status' => '1',
            ]);
        } 

        return redirect()->route('list-instansi.index');

    }
}
