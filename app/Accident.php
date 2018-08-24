<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accident extends Model
{
    //
    protected $table = "Accident";

    protected $fillable = [
        'addressId', 'userId', 'comment', 'status', 'date', 'dead', 'injury'
    ];

    protected $dateFormat = 'U';

	
	protected function getDateFormat() {
	    return 'U';
	}
}
