<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTahunAjaran extends Model
{
    use HasFactory;
    
    protected $table = "master_tahun_ajarans";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tahun_awal',
        'tahun_akhir',
        'semester',
    ];
    
    public function kelas_programs()
    {
    	return $this->hasMany('App\KelasProgram');
    }
}
