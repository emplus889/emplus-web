<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_users','foto_profil', 'foto_ktp',
    ];
}
