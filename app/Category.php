<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'category';

    public function Products(){
        return $this->hasMany(Product::class,'category_id');
    }

    public function subCategories(){
        return $this->hasMany(Category::class,'parent_id')->where('parent_id','<>',0);
    }
}
