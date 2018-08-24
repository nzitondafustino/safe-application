<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IDs extends Model
{
    //
    protected $table = "Identification";

    protected $fillable = [
        'accidentId', 'userId', 'type', 'number', 'owner', 'category', 'status', 'amande'
    ];
    protected $dateFormat = 'U';

	
	protected function getDateFormat() {
	    return 'U';
	}
}
