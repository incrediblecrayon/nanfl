<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'name',
        'city',
        'color_main',
        'color_accent'
    ];

    protected $appends = [
        'title',
        'short_title'
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
        $this->attributes['name'] = strip_tags(strtolower($value));
    }

    public function getCityAttribute($value)
    {
        return title_case($value);
    }

    public function setCityAttribute($value)
    {
        $this->attributes['city'] = strip_tags(strtolower($value));
    }

    //Formatted Team Name.
    public function getTitleAttribute()
    {
        return title_case($this->attributes['city'] . " " . $this->attributes['name']);
    }

    //Short Version of Team Name
    public function getShortTitleAttribute()
    {
        return title_case(substr($this->attributes['city'],0,1) . ". " . substr($this->attributes['name'],0,3));
    }
//    endregion
}
