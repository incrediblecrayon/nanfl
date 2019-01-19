<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'city'
    ];

    protected $appends = [
        'title'
    ];

//    region Relations
    public function players()
    {
        return $this->hasMany('App\Models\Player');
    }
//    endregion


//    region Attributes
    public function getNameAttribute($value)
    {
        return title_case($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }

    public function getCityAttribute($value)
    {
        return title_case($value);
    }

    public function setCityAttribute($value)
    {
        $this->attributes['city'] = strtolower($value);
    }

    //Formatted Team Name.
    public function getTitleAttribute()
    {
        return title_case($this->attributes['city'] . " " . $this->attributes['name']);
    }
//    endregion
}
