<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Province;
use District;
use Sector;
use Cell;
use Village;

class Address extends Model
{
    public function province()
    {
    	return $this->belongsTo(Province::class);
    }
    public function district()
    {
    	return $this->belongsTo(District::class);
    }
    public function sector()
    {
    	return $this->belongsTo(Sector::class);
    }
    public function cell()
    {
    	return $this->belongsTo(Cell::class);
    }
    public function village()
    {
    	return $this->belongsTo(Village::class);
    }
}
