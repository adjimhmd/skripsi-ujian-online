<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSoal extends Model
{
    use HasFactory;
    
    protected $table = "bank_soals";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'master_kelas_id',
        'master_mapel_id',
        'tipe_soal',
        'soal',
        'jawaban',
        'pembahasan',
    ];

    public function users()
    {
    	return $this->belongsTo('App\User');
    }
    
    public function jawabans()
    {
    	return $this->hasMany('App\Jawaban');
    }

    public function kelas()
    {
    	return $this->belongsTo('App\MasterKelas');
    }

    public function master_mapels()
    {
    	return $this->belongsTo('App\MasterMapel');
    }
    
    public function paket_soals()
    {
    	return $this->hasMany('App\PaketSoal');
    }
}
