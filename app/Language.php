<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * Code must be all uppercase
     * @param String $value
     * @return string
     */
    function setCodeAttribute(String $value)
    {
        return $this->attributes['code'] = strtoupper($value);
    }

    /**
     * Standard ucfirst string for name column
     * @param String $value
     * @return string
     */
    function setNameAttribute(String $value)
    {
        return $this->attributes['name'] = ucfirst(strtolower($value));
    }
}
