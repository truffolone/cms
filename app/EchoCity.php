<?php

namespace App;

use Khsing\World\Models\City;

class EchoCity extends City
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
