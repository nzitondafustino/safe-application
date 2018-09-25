<?php

namespace App;
use User;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public function users()
    {
    	return $this->hasMany(User::class);
    }
}
