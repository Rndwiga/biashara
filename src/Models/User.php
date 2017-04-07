<?php

namespace Tyondo\Biashara\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name','last_name','mobile_number',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * Users can have many orders.
     *
     * @return object
     */
    public function orders()
    {
        return $this->belongsToMany('\Tyondo\Biashara\Models\Orders')->withTimestamps();
    }
}
