<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    //
    protected $fillable = [
        'user_id'
    ];


    protected $table = 'delivery_addresses';
}
