<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $table = "Vehicle";

    protected $fillable = [
        'accidentId', 'userId', 'type', 'mark', 'category', 'plate', 'shasis', 'status', 'amande', 'owner'
    ];
    protected $dateFormat = 'U';

	
	protected function getDateFormat() {
	    return 'U';
	}
}
