<?php

namespace App;
use App\District;
use App\Address;
use App\User;
use App\Accident;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function districts()
    {
    	return $this->hasMany(District::class);
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
}
