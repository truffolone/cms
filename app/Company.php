<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The users that belong to the company.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function city()
    {
        return $this->belongsTo('App\EchoCity');
    }

    public function country()
    {
        return $this->belongsTo('App\EchoCountry');
    }
}
