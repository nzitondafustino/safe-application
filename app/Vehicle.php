<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //

    const CREATED_AT='created_on';
    const UPDATED_AT='updated_on';
    protected $fillable = [
        'accident_id', 'user_id', 'type', 'mark', 'category', 'plate', 'shasis', 'status', 'amande', 'owner'
    ];
	public function accident()
	{
		return $this->belongsTo('App\Accident');
	}
}
