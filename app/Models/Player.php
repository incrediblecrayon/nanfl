<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'team_id',
        'first_name',
        'last_name'
    ];

//    region Relations
    public function team()
    {
        return $this->belongsTo('App\Models\Team');
    }
//    endregion


//    region Adjusting Attributes
    public function getFirstNameAttribute($value)
    {
        return title_case($value);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtolower($value);
    }

    public function getLastNameAttribute($value)
    {
        return title_case($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strtolower($value);
    }
//    endregion
}
