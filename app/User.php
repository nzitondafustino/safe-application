<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Accident;
use App\Station;
use App\Role;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="users";
    protected $fillable = [
        'station_id', 'name', 'email', 'password', 'phone', 'title', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dateFormat = 'U';

    
    protected function getDateFormat() {
        return 'U';
    }
    public function accidents()
    {
        return $this->hasMany(Accident::class);
    }
    public function station()
    {
        return $this->belongsTo(Station::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
        public function hasAnyRole($roles)
    {
        if(is_array($roles))
        {
            foreach ($roles as $role) 
            {
             if ($this->hasRole($role)) 
             {
                return true;
             }
            }
        }
        else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
    public function hasRole($role)
    {
       if($this->roles()->where('name',$role)->first())
       {
        return true;
       }
       return false;
    }
}
