<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterPaketSoal extends Model
{
    use HasFactory;
    
    protected $table = "master_paket_soals";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_kelas_id',
        'master_mapel_id',
        'user_guru_id',
        'user_admin_instansi_id',
        'deskripsi',
    ];

    public function master_kelas()
    {
    	return $this->belongsTo('App\MasterKelas');
    }

    public function master_mapels()
    {
    	return $this->belongsTo('App\MasterMapel');
    }

    public function user_gurus()
    {
    	return $this->belongsTo('App\UserGuru');
    }
    
    public function paket_soals()
    {
    	return $this->hasMany('App\PaketSoal');
    }
    
    public function master_ruang_ujians()
    {
    	return $this->hasMany('App\MasterRuangUjian');
    }
}
