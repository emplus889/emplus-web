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
        'no_wallet_origin', 'no_wallet_destination', 'type', 'note', 'debit', 'credit'
    ];

    public function Origin()
    {
        return $this->hasOne('App\Wallet','wallet_no','no_wallet_origin')->select('id','id_users','wallet_no','balance');
    }

    public function Destination()
    {
        return $this->hasOne('App\Wallet','wallet_no','no_wallet_destination')->select('id','id_users','wallet_no','balance');
    }
}
