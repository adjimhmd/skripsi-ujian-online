<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstansiPendidikan extends Model
{
    use HasFactory;

    protected $table = "instansi_pendidikans";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'alamat',
        'jenjang',
        'tipe',
        'nomor_induk',
        'desa_id',
    ];

    public function user_admins()
    {
    	return $this->hasMany('App\UserAdmin');
    }

    public function kelas()
    {
    	return $this->hasMany('App\Kelas');
    }

    public function kelas_programs()
    {
    	return $this->hasMany('App\KelasProgram');
    }

    public function indonesia_villages()
    {
    	return $this->belongsTo('App\IndonesiaVillages');
    }
}


