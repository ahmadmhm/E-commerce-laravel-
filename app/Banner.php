<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'image',
    ];

    public function toggleStatus()
    {
        $this->status = !$this->status;
        return $this;
    }
}
