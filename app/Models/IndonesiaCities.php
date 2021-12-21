<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaCities extends Model
{
    use HasFactory;

    protected $table = "indonesia_cities";

    public function instansi_pendidikans()
    {
    	return $this->hasMany('App\InstansiPendidikan');
    }
}
