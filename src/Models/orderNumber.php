<?php

namespace Tyondo\Biashara\Models;

use Illuminate\Database\Eloquent\Model;

class orderNumber extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number','order_status'
    ];
}
