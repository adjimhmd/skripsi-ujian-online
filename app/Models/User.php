<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'foto',
        'jenis_kelamin',
        'tanggal_lahir',
        'nuptk',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_gurus()
    {
    	return $this->hasOne('App\UserGuru');
    }

    public function user_siswas()
    {
    	return $this->hasOne('App\UserSiswa');
    }

    public function user_admins()
    {
    	return $this->hasOne('App\UserAdmin');
    }

    public function bank_soals()
    {
    	return $this->hasMany('App\BankSoal');
    }
}
