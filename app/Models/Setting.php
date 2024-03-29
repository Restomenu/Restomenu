<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['logo_full_path', 'qr_code_menu_full_path'];


    public function getLogoFullPathAttribute($value)
    {
        if ($value) {
            return Storage::url(config("restomenu.path.storage_restaurant_images_root_dir") . "restaurant_" . $this->restaurant_id . '/' . config("restomenu.path.storage_logo")) . $value;
        } else if (isset($this->site_logo) && $this->site_logo) {
            return Storage::url(config("restomenu.path.storage_restaurant_images_root_dir") . "restaurant_" . $this->restaurant_id . '/' . config("restomenu.path.storage_logo")) . $this->site_logo;
        } else {
            return asset('admin/images/placeholder-image.png');
        }
    }

    public function getQrCodeMenuFullPathAttribute($value)
    {
        if ($value) {
            return Storage::url(config("restomenu.path.storage_restaurant_images_root_dir") . "restaurant_" . $this->restaurant_id . '/' . config("restomenu.path.storage_qr_code")) . $value;
        } else if (isset($this->qr_code_menu) && $this->qr_code_menu) {
            return Storage::url(config("restomenu.path.storage_restaurant_images_root_dir") . "restaurant_" . $this->restaurant_id . '/' . config("restomenu.path.storage_qr_code")) . $this->qr_code_menu;
        } else {
            return asset('admin/images/placeholder-image.png');
        }
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
