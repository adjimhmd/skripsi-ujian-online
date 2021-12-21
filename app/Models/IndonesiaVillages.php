<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndonesiaVillages extends Model
{
    use HasFactory;

    protected $table = "indonesia_villages";

    public function instansi_pendidikans()
    {
    	return $this->hasMany('App\InstansiPendidikan');
    }
}
