<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model
{
    use HasFactory;
    
    protected $table = "paket_soals";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bank_soal_id',
        'master_paket_soal_id',
    ];
    
    public function bank_soals()
    {
    	return $this->belongsTo('App\BankSoal');
    }

    public function master_paket_soals()
    {
    	return $this->belongsTo('App\MasterPaketSoal');
    }
}
