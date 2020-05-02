<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $table = 'orders';

    protected $fillable = [
        'order_status',
    ];

    public function Products(){
        return $this->hasMany(OrderProducts::class,'order_id', 'id');
    }

    public function User(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function Country()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }
}
