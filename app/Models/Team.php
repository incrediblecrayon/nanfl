<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'city'
    ];

    //Relations
    public function players()
    {
        return $this->hasMany('App\Models\Player');
    }

    //Adjusting Attributes
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
}
