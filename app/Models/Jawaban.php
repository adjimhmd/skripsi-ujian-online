<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    
    protected $table = "jawabans";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banksoal_id',
        'jawaban',
        'status',
    ];

    public function bank_soals()
    {
    	return $this->belongsTo('App\BankSoal');
    }
    
    public function media_jawabans()
    {
    	return $this->hasMany('App\MediaJawaban');
    }
}
