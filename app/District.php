<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Province;
use Sector;
use Address;

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
     public function addresses()
    {
    	return $this->hasMany(Address::class);
    }
}
