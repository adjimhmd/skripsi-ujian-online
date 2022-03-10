<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMateri extends Model
{
    use HasFactory;
    
    protected $table = "master_materis";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_mapel_id',
        'user_guru_id',
        'deskripsi',
        'link_gdrive',
    ];

    public function user_gurus()
    {
    	return $this->belongsTo('App\UserGuru');
    }

    public function master_mapels()
    {
    	return $this->belongsTo('App\MasterMapel');
    }
    
    public function materi_kelas_programs()
    {
    	return $this->hasMany('App\MateriKelasProgram');
    }
}
