<?php

namespace Tyondo\Biashara\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number_id', 'product', 'quantity','unit_price','product_total_order','sub_total',
    ];
}
