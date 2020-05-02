<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $table = 'user_info';

    protected $fillable = [
        'address', 'city', 'state', 'country', 'mobile', 'pincode',
    ];

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function Country()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }
}
