<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * Gets the user info data from
     */
    function userInfo()
    {
        return $this->hasOne('App\UserInfo');
    }

    /**
     * Binds to country
     */
    function country()
    {
        return $this->belongsTo('App\EchoCountry');
    }

    /**
     * Bind to city
     */
    function city()
    {
        return $this->belongsTo('App\EchoCity');
    }

    /**
     * The roles that belong to the user.
     */
    public function companies()
    {
        return $this->belongsToMany('App\Company')->withPivot('valid_until')->withTimestamps();
    }

    /**
     * load last active company
     */
    public function lastActiveCompany()
    {
        return $this->belongsToMany('App\Company')->latest()->where('valid_to IS NULL');
    }
}
