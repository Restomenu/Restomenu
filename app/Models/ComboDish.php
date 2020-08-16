<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\ComboDishCategory;
use App\Repositories\ComboDishRepository;

class ComboDish extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['combo_dish_image_full_path'];

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($model) {
            if (isset($model->image) && $model->image) {
                if (Storage::exists(ComboDishRepository::getImagePath($model->restaurant_id) . $model->image)) {
                    Storage::delete(ComboDishRepository::getImagePath($model->restaurant_id) . $model->image);
                }
            }
        });
    }

    public function getComboDishImageFullPathAttribute($value)
    {
        if ($value) {
            return Storage::url(ComboDishRepository::getImagePath($this->restaurant_id)) . $value;
        } else if (isset($this->image) && $this->image) {
            return Storage::url(ComboDishRepository::getImagePath($this->restaurant_id)) . $this->image;
        } else {
            return asset('admin/images/placeholder-image.png');
        }
    }

    public function comboDishCategories()
    {
        return $this->hasMany(ComboDishCategory::class, "combo_dish_id", "id");
    }
}
