<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterRuangUjian extends Model
{
    use HasFactory;
    
    protected $table = "master_ruang_ujians";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'deskripsi',
        'master_paket_soal_id',
        'kelas_program_id',
        'instansi_pendidikan_id',
        'durasi',
        'waktu_mulai',
        'waktu_selesai',
    ];

    public function master_paket_soals()
    {
    	return $this->belongsTo('App\MasterPaketSoal');
    }

    public function kelas_programs()
    {
    	return $this->belongsTo('App\KelasProgram');
    }

}
