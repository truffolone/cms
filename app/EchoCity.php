<?php

namespace App;

use Khsing\World\Models\City;

class EchoCity extends City
{
    protected $table = 'world_cities';

    public function companies()
    {
        return $this->hasMany('App\Company');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function country()
    {
        return $this->belongsTo('App\EchoCountry', 'country_id');
    }
}
