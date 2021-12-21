<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaDistricts extends Model
{
    use HasFactory;

    protected $table = "indonesia_districts";

    public function instansi_pendidikans()
    {
    	return $this->hasMany('App\InstansiPendidikan');
    }
}
