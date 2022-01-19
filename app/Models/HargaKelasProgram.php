<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaKelasProgram extends Model
{
    use HasFactory;
    
    protected $table = "harga_kelas_programs";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kelas_program_id',
        'jumlah_bulan',
        'harga',
    ];
    
    public function kelas_programs()
    {
    	return $this->belongsTo('App\KelasProgram');
    }
    
    public function rombongan_belajars()
    {
    	return $this->hasMany('App\RombonganBelajar');
    }
}
