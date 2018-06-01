<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'email', 'mobile', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //relasi antar table
    public function Users_profile()
    {
        return $this->hasOne('App\Users_profile','id_users','id')->select('id_users','foto_profile');
    }

    // relasi
    public function Wallet()
    {
        return $this->hasOne('App\Wallet','id_users','id')->select('id_users','balance');
    }
}
