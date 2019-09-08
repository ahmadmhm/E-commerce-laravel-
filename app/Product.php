<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';

    protected $fillable = [
        'product_image',
    ];

    public function Category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
