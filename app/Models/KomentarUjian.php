<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarUjian extends Model
{
    use HasFactory;
    
    protected $table = "komentar_ujians";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_ruang_ujian_id',
        'user_guru_id',
        'user_siswa_id',
        'komentar',
    ];

    public function master_ruang_ujians()
    {
    	return $this->belongsTo('App\MasterRuangUjian');
    }

    public function user_gurus()
    {
    	return $this->belongsTo('App\UserGuru');
    }

    public function user_siswas()
    {
    	return $this->belongsTo('App\UserSiswa');
    }
}
