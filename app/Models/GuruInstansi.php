<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruInstansi extends Model
{
    use HasFactory;
    
    protected $table = "guru_instansis";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'instansi_pendidikan_id',
        'user_guru_id',
        'status',
    ];
    
    public function user_gurus()
    {
    	return $this->belongsTo('App\UserGuru');
    }
    
    public function instansi_pendidikans()
    {
    	return $this->belongsTo('App\InstansiPendidikan');
    }
}
