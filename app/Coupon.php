<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public function toggleStatus()
    {
        $this->status = !$this->status;
        return $this;
    }
}
