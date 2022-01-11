<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSiswa extends Model
{
    use HasFactory;
    
    protected $table = "user_siswas";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'no_telp',
        'master_kelas_id',
        'nisn',
        'nama_wali',
        'email_wali',
    ];

    public function users()
    {
    	return $this->belongsTo('App\User');
    }

    public function kelas()
    {
    	return $this->belongsTo('App\MasterKelas');
    }

    public function nilai_ujians()
    {
    	return $this->hasMany('App\NilaiUjian');
    }
}
