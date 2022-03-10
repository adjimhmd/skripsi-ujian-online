<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriKelasProgram extends Model
{
    use HasFactory;
    
    protected $table = "materi_kelas_programs";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_materi_id',
        'kelas_program_id',
        'status',
    ];

    public function master_materis()
    {
    	return $this->belongsTo('App\MasterMateri');
    }

    public function kelas_programs()
    {
    	return $this->belongsTo('App\KelasProgram');
    }
}
