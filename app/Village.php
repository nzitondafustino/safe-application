<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cell;
use Address;

class Village extends Model
{
    public function cell()
    {
    	return $this->belongsTo(Cell::class);
    }
     public function addresses()
    {
    	return $this->hasMany(Address::class);
    }
}
