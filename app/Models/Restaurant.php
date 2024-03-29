<?php

namespace App\Models;

use App\Notifications\RestaurantResetPassword;
use App\Notifications\RestaurantVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Notification;

class Restaurant extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new RestaurantResetPassword($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new RestaurantVerifyEmail);
    }

    public function setting()
    {
        return $this->hasOne('App\Models\Setting');
    }

    public function restaurantTime()
    {
        return $this->hasOne('App\Models\RestaurantTime');
    }

    public function QrCodeOrders()
    {
        return $this->hasMany('App\Models\QrCodeOrder');
    }

    public function totalNotificationCount()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        return Notification::where('restaurant_id', $restaurantId)->where('is_read', '0')->count();
    }

    public function getAllNotificationData()
    {
        $restaurantId = auth()->guard('restaurant')->user()->id;
        return Notification::where('restaurant_id', $restaurantId)->where('is_read', '0')->orderBy('id', 'desc')->get();
    }
}
