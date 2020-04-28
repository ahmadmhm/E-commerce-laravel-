<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Information()
    {
        return $this->hasOne('App\UserInfo', 'user_id', 'id');
    }

    public function Orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function toggleSessionStatus()
    {
        $this->session_id_status = !$this->session_id_status;
        return $this;
    }

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser', 'user_id', 'id');
    }
}
