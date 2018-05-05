<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'mobile', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function Users_profile()
    {
        return $this->belongsTo('App\Users_profile','id_users','id')->select('id_users','foto_profile');
    }

    public function Wallet()
    {
        return $this->belongsTo('App\Wallet','id_users','id')->select('id_users','balance');
    }
}
