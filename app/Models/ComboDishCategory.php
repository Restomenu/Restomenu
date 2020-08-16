<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComboDishCategory extends Model
{
    protected $guarded = ['id'];
    
    public function comboDishSubcategories()
    {
        return $this->hasMany(ComboDishSubcategory::class, "combo_dish_categories_id", "id");
    }
}
