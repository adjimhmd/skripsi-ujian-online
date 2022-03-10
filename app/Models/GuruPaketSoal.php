<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruPaketSoal extends Model
{
    use HasFactory;
    
    protected $table = "guru_paket_soals";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_paket_soal_id',
        'user_guru_id',
    ];
    
    public function master_paket_soals()
    {
    	return $this->belongsTo('App\MasterPaketSoal');
    }
    
    public function user_gurus()
    {
    	return $this->belongsTo('App\UserGuru');
    }
}
