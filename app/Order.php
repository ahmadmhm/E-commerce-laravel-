<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';

    public function Products(){
        return $this->hasMany(OrderProducts::class,'order_id', 'id');
    }
}
