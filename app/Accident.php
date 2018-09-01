<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use User;
use Vehicle;

class Accident extends Model
{
    //
    protected $table='accidents';
    protected $fillable = [
        'address_id', 'user_id', 'comment', 'status', 'date', 'dead', 'injury'
    ];

    protected $dateFormat = 'U';

	
	protected function getDateFormat() {
	    return 'U';
	}
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function vehicle()
	{
		 return $this->hasOne('App\Vehicle');
	}
}
