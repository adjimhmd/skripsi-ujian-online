<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiUjian extends Model
{
    use HasFactory;
    
    protected $table = "nilai_ujians";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_ruang_ujian_id',
        'user_siswa_id',
        'total_nilai',
    ];

    public function master_ruang_ujians()
    {
    	return $this->belongsTo('App\MasterRuangUjian');
    }

    public function user_siswas()
    {
    	return $this->belongsTo('App\UserSiswa');
    }
}
