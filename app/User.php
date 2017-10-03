<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Model
{
    /**
     * Gets the user info data from
     */
    function userInfo()
    {
        $this->hasOne('App\UserInfo');
    }

    /**
     * The roles that belong to the user.
     */
    public function companies()
    {
        return $this->belongsToMany('App\Company')->withPivot('valid_until')->withTimestamps();
    }
}
