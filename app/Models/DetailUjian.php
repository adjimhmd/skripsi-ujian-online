<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUjian extends Model
{
    use HasFactory;
    
    protected $table = "detail_ujians";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'master_ruang_ujian_id',
        'user_siswa_id',
        'bank_soal_id',
        'jawaban',
        'nilai',
    ];

    public function user_siswas()
    {
    	return $this->belongsTo('App\UserSiswa');
    }
    
    public function bank_soals()
    {
    	return $this->belongsTo('App\BankSoal');
    }
}
