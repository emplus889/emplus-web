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
        'id_users', 'wallet_no', 'balance',
    ];

    public function Wallet()
    {
        return $this->hasOne('App\Users','id','id_users')->select('id','name');
    }
}
