<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['logo_full_path'];


    public function getLogoFullPathAttribute($value)
    {
        if ($value) {
            return Storage::url(config("restomenu.path.storage_logo")) . $value;
        } else if (isset($this->site_logo) && $this->site_logo) {
            return Storage::url(config("restomenu.path.storage_logo")) . $this->site_logo;
        } else {
            return asset('admin/images/placeholder-image.png');
        }
    }

    public function user()
    {
        return $this->belongsTo('App\Models');
    }
}
