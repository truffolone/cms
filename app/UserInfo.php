<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    /**
     * Inverse Relationship with User
     */
    function user()
    {
        return $this->belongsTo('App\User');
    }
}
