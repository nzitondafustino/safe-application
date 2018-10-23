<?php

namespace App;
use Accident;

use Illuminate\Database\Eloquent\Model;

class ID extends Model
{
    const CREATED_AT='created_on';
    const UPDATED_AT='updated_on';
    protected $table="identifications";
    protected $fillable = [
        'accident_id', 'user_id', 'type', 'number', 'owner', 'category', 'status', 'amande'
    ];
	public function accident()
	{
		return $this->belongsTo('App\Accident');
	}
}
