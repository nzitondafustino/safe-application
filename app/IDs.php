<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IDs extends Model
{
    //

    protected $fillable = [
        'accident_id', 'user_id', 'type', 'number', 'owner', 'category', 'status', 'amande'
    ];
    protected $dateFormat = 'U';

	
	protected function getDateFormat() {
	    return 'U';
	}
}
