<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapelKelasProgram extends Model
{
    use HasFactory;
    
    protected $table = "mapel_kelas_programs";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kelas_program_id',
        'master_mapel_id',
    ];
    
    public function kelas_programs()
    {
    	return $this->belongsTo('App\KelasProgram');
    }
    
    public function master_mapels()
    {
    	return $this->belongsTo('App\MasterMapel');
    }
}
