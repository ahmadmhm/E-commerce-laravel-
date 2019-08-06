<?php


namespace App\Helpers;


class Helpers
{

    public static function make_category_dropdown_menu($categories){
        $menu ="<option value='' selected disabled>Select</option>";
        foreach ($categories as $category){
            if($category->parent_id == 0){
                $menu .='<option value="'.$category->id.'">'. $category->name .'</option>';
                foreach ($categories as $sub_cat){
                    if($sub_cat->parent_id == $category->id)
                        $menu .='<option value="'.$sub_cat->id.'">&nbsp;--&nbsp;'. $sub_cat->name .'</option>';
                }
            }
        }
        return $menu;
    }
}