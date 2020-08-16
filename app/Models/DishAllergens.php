<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DishAllergens extends Model
{
    protected $guarded = ['id'];

    public function allergens()
    {
        return $this->belongsTo(Allergens::class, "allergen_id");
    }
}
