<?php

namespace Tyondo\Biashara\Models;

use Illuminate\Database\Eloquent\Model;

class Draft_order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_number_id','order_status', 'product', 'quantity','unit_price','product_total_order','sub_total',
    ];
    /**
     * An order can have only have one order number.
     *
     * @return object
     */
    public function orderNumber()
    {
        return $this->belongsTo('Tyondo\Biashara\Models\orderNumber');
    }
}
