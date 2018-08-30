<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    //

    protected $fillable = [
        'address_id', 'user_id', 'comment', 'status', 'date', 'dead', 'injury'
    ];

    protected $dateFormat = 'U';

	
	protected function getDateFormat() {
	    return 'U';
	}
}
