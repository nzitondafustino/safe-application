<?php

namespace App;
use Accident;

use Illuminate\Database\Eloquent\Model;

class ID extends Model
{
    //
    protected $table="identifications";
    protected $fillable = [
        'accident_id', 'user_id', 'type', 'number', 'owner', 'category', 'status', 'amande'
    ];
    protected $dateFormat = 'U';

	
	protected function getDateFormat() {
	    return 'U';
	}
	public function accident()
	{
		return $this->belongsTo('App\Accident');
	}
}
