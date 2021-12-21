<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKelas extends Model
{
    use HasFactory;
    
    protected $table = 'master_kelas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tingkat',
        'kelas',
    ];
    
    public function kelas_programs()
    {
    	return $this->hasMany('App\KelasProgram');
    }
    
    public function bank_soals()
    {
    	return $this->hasMany('App\BankSoal');
    }
    
    public function user_siswaas()
    {
    	return $this->hasMany('App\UserSiswa');
    }
    
    public function paket_soals()
    {
    	return $this->hasMany('App\PaketSoal');
    }
}
