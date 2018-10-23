<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Province;
use App\Sector;
use App\Address;
use App\User;
use App\ID;
use App\Accident;
use App\Station;

class District extends Model
{
    public function province()
    {
    	return $this->belongsTo(Province::class);
    }
    public function sectors()
    {
    	return $this->hasMany(Sector::class);
    }
     public function accidents()
    {
    	return $this->hasMany(Accident::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function vehicles()
    {
        return $this->hasManyThrough('App\Vehicle','App\User');
    }
    public function identifications(){
        return $this->hasManyThrough('App\ID','App\User');
    }
        public function stations()
        {
        return $this->hasMany('App\Station');
    }

}
