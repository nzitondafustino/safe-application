<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Vehicle;
use App\ID;
use App\Address;
class Accident extends Model
{
    //
    protected $table='accidents';
    protected $fillable = [
        'address_id', 'user_id','province_id' ,'district_id','sector_id','comment', 'status', 'date', 'dead', 'injury'
    ];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function vehicles()
	{
		 return $this->hasMany('App\Vehicle');
	}
	public function identifications()
	{
		return $this->hasMany('App\ID');
	}
	 public function province()
    {
    	return $this->belongsTo(Province::class);
    }
    public function district()
    {
    	return $this->belongsTo(District::class);
    }
    public function sector()
    {
    	return $this->belongsTo(Sector::class);
    }
}
