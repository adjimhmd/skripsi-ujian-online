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
        'instansi_pendidikan_id',
    ];
    
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
    
    public function harga_kelas_programs()
    {
    	return $this->hasMany('App\HargaKelasProgram');
    }
    
    public function mapel_kelas_programs()
    {
    	return $this->hasMany('App\MapelKelasProgram');
    }
    
    public function materi_kelas_programs()
    {
    	return $this->hasMany('App\MateriKelasProgram');
    }
}
