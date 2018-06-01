<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_users', 'no_wallet', 'balance',
    ];

    public function User()
    {
        return $this->hasOne('App\User','id','id_users')->select('id','name');
    }
}
