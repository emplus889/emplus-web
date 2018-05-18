<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'no_trans', 'no_wallet', 'type', 'note', 'amount'
    ];

    public function Wallet()
    {
        return $this->hasOne('App\Wallet','wallet_no','no_wallet')->select('id','id_users','wallet_no','balance');
    }

}
