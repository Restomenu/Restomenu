<?php

namespace App\Models;

use Carbon\Carbon;
use Config;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class CategoryIcon extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['icons_full_path'];

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($model) {
            if (isset($model->icon) && $model->icon) {
                if (Storage::exists(config("restomenu.path.storage_icon") . $model->icon)) {
                    Storage::delete(config("restomenu.path.storage_icon") . $model->icon);
                }
            }
        });
    }

    public function getIconsFullPathAttribute($value)
    {
        if ($value) {
            return Storage::url(config("restomenu.path.storage_icon")) . $value;
        } else if (isset($this->icon) && $this->icon) {
            return Storage::url(config("restomenu.path.storage_icon")) . $this->icon;
        } else {
            return asset('admin/images/placeholder-image.png');
        }
    }
}
