<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use District;
use Cell;
use Address;
class Sector extends Model
{
    public function district()
    {
    	return $this->BelongsTo(District::class);
    }
    public function cells()
    {
    	return $this->hasMany(Cell::class);
    }
     public function addresses()
    {
    	return $this->hasMany(Address::class);
    }
}
