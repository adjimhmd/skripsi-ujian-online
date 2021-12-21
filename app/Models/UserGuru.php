<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGuru extends Model
{
    use HasFactory;

    protected $table = "user_gurus";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'no_telp',
        'nuptk',
    ];

    public function users()
    {
    	return $this->belongsTo('App\User');
    }

    public function spesialisasis()
    {
    	return $this->hasMany('App\Spesialisasi');
    }

    public function master_paket_soals()
    {
    	return $this->hasMany('App\MasterPaketSoal');
    }
}
