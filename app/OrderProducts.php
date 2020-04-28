<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    //
    protected $table = 'orders_products';

    public function Order()
    {
        return $this->belongsTo(Order::class, 'id','order_id');
    }
}
