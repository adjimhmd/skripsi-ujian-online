<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spesialisasi extends Model
{
    use HasFactory;

    protected $table = "spesialisasis";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_guru_id',
        'master_mapel_id',
    ];

    public function users()
    {
    	return $this->belongsTo('App\UserGuru');
    }
}
