<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMapel extends Model
{
    use HasFactory;
    
    protected $table = "master_mapels";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'materi',
    ];
    
    public function kelas_programs()
    {
    	return $this->hasMany('App\KelasProgram');
    }
    
    public function bank_soals()
    {
    	return $this->hasMany('App\BankSoal');
    }

    public function spesialisasi_gurus()
    {
    	return $this->hasMany('App\UserGuru');
    }
    
    public function paket_soals()
    {
    	return $this->hasMany('App\PaketSoal');
    }
    
    public function master_materis()
    {
    	return $this->hasMany('App\MasterMateri');
    }
}
