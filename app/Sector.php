<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\District;
use App\Cell;
use App\Address;
use App\Accident;
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
     public function accidents()
    {
        return $this->hasMany(Accident::class);
    }
}
