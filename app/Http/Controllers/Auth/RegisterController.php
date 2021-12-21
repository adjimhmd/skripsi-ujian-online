<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\UserGuru;
use App\Models\UserSiswa;
use App\Models\UserAdminInstansi;
use App\Models\MasterKelas;
use App\Models\MasterMapel;
use App\Models\InstansiPendidikan;
use App\Models\Spesialisasi;
use App\Models\SpesialisasiGuru;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function show_guru_form()
    {
        $list_spesialisasi = MasterMapel::orderBy('nama', 'asc')->get();
        return view('auth.register',compact('list_spesialisasi'));
    }

    public function process_guru(Request $request)
    {   
        // return$request;
        $request->validate([
            'name' => ['string', 'max:50'],
            'email' => ['string', 'email', 'max:50', 'unique:users'],
            'password' => ['string', 'confirmed'],       
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => strtolower($request->input('email')),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('guru');

        $user_guru = UserGuru::create([
            'user_id' => $user->id,
        ]);

        $spesialisasi=$request->input('spesialisasi');

        for($count = 0; $count < count($spesialisasi); $count++){

            Spesialisasi::create([
                'user_guru_id' => $user_guru->id,
                'master_mapel_id' => $spesialisasi[$count],
            ]);
        }

        $request->session()->flash('success', 'Akun guru '.ucwords($request->input('name')).' berhasil didaftarkan!');
        
        $user->sendEmailVerificationNotification();

        return redirect()->route('login');
    }

    public function show_siswa_form()
    {
        $list_kelas = MasterKelas::orderBy('kelas', 'asc')->get();
        return view('auth.register', compact('list_kelas'));
    }

    public function process_siswa(Request $request)
    {   
        // return $request;

        $request->validate([
            'name' => ['string', 'max:50'],
            'email' => ['string', 'email', 'max:50', 'unique:users'],
            'password' => ['string', 'confirmed'],       
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => strtolower($request->input('email')),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('siswa');
       
        UserSiswa::create([
            'user_id' => $user->id,
            'master_kelas_id' => $request->input('kelas'),
        ]);

        $user->sendEmailVerificationNotification();

        $request->session()->flash('success', 'Akun siswa '.ucwords($request->input('name')).' berhasil didaftarkan!');

        return redirect()->route('login');
    }

    public function show_instansi_form()
    {
        return view('auth.register');
    }
    
    public function process_instansi(Request $request)
    {   
        // return $request;
        $request->validate([
            'name' => ['string', 'max:50'],
            'email' => ['string', 'email', 'max:50', 'unique:users'],
            'password' => ['string', 'confirmed'],       
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => strtolower($request->input('email')),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('adm_instansi');
       
        $instansi = InstansiPendidikan::create([
            'tipe' => $request->input('tipe_instansi'),
        ]);
       
        UserAdminInstansi::create([
            'user_id' => $user->id,
            'instansi_pendidikan_id' => $instansi->id,
        ]);
       
        $user->sendEmailVerificationNotification();

        if(strtolower($request->input('tipe_instansi'))=='sekolah'){
            $request->session()->flash('success', 'Sekolah '.strtoupper($request->input('nama_instansi')).' berhasil didaftarkan!');
        }
        elseif(strtolower($request->input('tipe_instansi'))=='lembaga_kursus'){
            $request->session()->flash('success', 'Lembaga kursus '.strtoupper($request->input('nama_instansi')).' berhasil didaftarkan!');
        }

        return redirect()->route('login');

    }
}
