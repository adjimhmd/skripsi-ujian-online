<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasProgram extends Model
{
    use HasFactory;
    
    protected $table = "kelas_programs";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deskripsi',
        'master_kelas_id',
        'master_mapel_id',
        'instansi_pendidikan_id',
        'jurusan',
        'harga',
    ];
    
    public function master_mapels()
    {
    	return $this->belongsTo('App\MasterMapel');
    }
    
    public function master_kelas()
    {
    	return $this->belongsTo('App\MasterKelas');
    }
    
    public function instansi_pendidikans()
    {
    	return $this->belongsTo('App\InstansiPendidikan');
    }
    
    public function master_ruang_ujians()
    {
    	return $this->hasMany('App\MasterRuangUjian');
    }
}
