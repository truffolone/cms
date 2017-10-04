<?php

namespace App;

use Khsing\World\Models\Country;

class EchoCountry extends Country
{
    protected $table = 'world_countries';

    public function companies()
    {
        return $this->hasMany('App\Company');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function cities()
    {
        return $this->hasMany('App\EchoCity', 'country_id');
    }
}
