<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Village;
use Sector;
use Address;

class Cell extends Model
{
   public function villages()
   {
   	return $this->hasMany(Village::class);
   }
   public function sector()
   {
   	return $this->belongsTo(Sector::class);
   }
    public function addresses()
    {
    	return $this->hasMany(Address::class);
    }
}
