<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Config;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['category_image_full_path'];

    // public static function boot()
    // {
    //     parent::boot();

    //     static::deleted(function ($model) {
    //         if (isset($model->image) && $model->image) {
    //             if (Storage::exists(config("restomenu.path.storage_category_img") . $model->image)) {
    //                 Storage::delete(config("restomenu.path.storage_category_img") . $model->image);
    //             }
    //         }
    //     });
    // }

    public function getCategoryImageFullPathAttribute($value)
    {
        if ($value) {
            return Storage::url(config("restomenu.path.storage_category_img")) . $value;
        } else if (isset($this->image) && $this->image) {
            return Storage::url(config("restomenu.path.storage_category_img")) . $this->image;
        } else {
            return asset('admin/images/placeholder-image.png');
        }
    }

    public function dishes()
    {
        return $this->hasMany('App\Models\Dish');
    }
}
