<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCodeOrder extends Model
{
    protected $table = 'qr_code_orders';
    protected $guarded = ['id'];   
    
    public function restaurant()
    {
        return $this->hasMany('App\Models\Restaurant','id');
    }
}
