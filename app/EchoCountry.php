<?php

namespace App;

use \Khsing\World\Models\Country;

class EchoCountry extends Country
{
    public function companies()
    {
        return $this->hasMany('App\Company');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
