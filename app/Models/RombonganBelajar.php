<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RombonganBelajar extends Model
{
    use HasFactory;
    
    protected $table = "rombongan_belajars";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kelas_program_id',
        'user_siswa_id',
        'status',
        'bukti_bayar',
    ];
    
    public function kelas_programs()
    {
    	return $this->belongsTo('App\KelasProgram');
    }
    
    public function user_siswas()
    {
    	return $this->belongsTo('App\UserSiswa');
    }
}
