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
        $this->belongsTo('App\User');
    }

    /**
     *  Inverse Relationship with Company
     */
    function company()
    {
        $this->belongsTo('App\Company');
    }

    /**
     * Inverse Relationship with world cities
     */
    function city()
    {
        $this->belongsTo('App\City');
    }
}
