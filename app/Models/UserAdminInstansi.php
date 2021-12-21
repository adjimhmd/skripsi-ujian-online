<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdminInstansi extends Model
{
    use HasFactory;

    protected $table = "user_admin_instansis";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'instansi_pendidikan_id',
        'nik',
    ];

    public function instansi_pendidikans()
    {
    	return $this->belongsTo('App\InstansiPendidikan');
    }

    public function users()
    {
    	return $this->belongsTo('App\User');
    }
}
