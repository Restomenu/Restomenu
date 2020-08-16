<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Repositories\DishRepository;

class Dish extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['dish_image_full_path'];

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($model) {

            if (isset($model->image) && $model->image) {
                if (Storage::exists(DishRepository::getImagePath($model->restaurant_id) . $model->image)) {
                    Storage::delete(DishRepository::getImagePath($model->restaurant_id) . $model->image);
                }
            }
        });
    }

    public function getDishImageFullPathAttribute($value)
    {
        if ($value) {
            return Storage::url(DishRepository::getImagePath($this->restaurant_id)) . $value;
        } else if (isset($this->image) && $this->image) {
            return Storage::url(DishRepository::getImagePath($this->restaurant_id)) . $this->image;
        } else {
            return asset('admin/images/placeholder-image.png');
        }
    }

    public function allergens()
    {
        return $this->belongsToMany(Allergens::class);
    }

    public function dishAllergens()
    {
        return $this->hasMany(DishAllergens::class, "dish_id", "id");
    }
}
