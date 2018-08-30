<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //

    protected $fillable = [
        'accident_id', 'user_id', 'type', 'mark', 'category', 'plate', 'shasis', 'status', 'amande', 'owner'
    ];
    protected $dateFormat = 'U';

	
	protected function getDateFormat() {
	    return 'U';
	}
}
