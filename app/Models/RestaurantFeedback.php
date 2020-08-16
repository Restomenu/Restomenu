<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantFeedback extends Model
{
    protected $table = 'restaurant_feedbacks';
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];
}
