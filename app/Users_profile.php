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
        'id_users','id_region', 'profile_pic','identity_pic','address','gender'
    ];
}
