<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

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
