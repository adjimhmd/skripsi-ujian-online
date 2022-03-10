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
        'master_tahun_ajaran_id',
        'kelas_program_id',
        'instansi_pendidikan_id',
        'batas',
        'durasi',
        'waktu_mulai',
        'waktu_selesai',
    ];

    public function master_paket_soals()
    {
    	return $this->belongsTo('App\MasterPaketSoal');
    }

    public function master_tahun_ajarans()
    {
    	return $this->belongsTo('App\MasterTahunAjaran');
    }

    public function kelas_programs()
    {
    	return $this->belongsTo('App\KelasProgram');
    }

    public function instansi_pendidikans()
    {
    	return $this->belongsTo('App\InstansiPendidikan');
    }

    public function detail_ujians()
    {
    	return $this->hasMany('App\DetailUjian');
    }

    public function nilai_ujians()
    {
    	return $this->hasMany('App\NilaiUjian');
    }

}
