<?php

namespace App;
use District;
use Address;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function districts()
    {
    	return $this->hasMany(District::class);
    }
    public function addresses()
    {
    	return $this->hasMany(Address::class);
    }
}
