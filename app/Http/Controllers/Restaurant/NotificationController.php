<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Restaurant;

class NotificationController extends Controller
{
    public function __construct(Notification $model, Restaurant $restaurantModel)
    {
        $this->model = $model;
        $this->restaurantModel = $restaurantModel;
    }

    public function getNotificationData()
    {
        $totalNotificationCount = $this->restaurantModel->totalNotificationCount();
        $allNotificationsData = $this->restaurantModel->getAllNotificationData();
        $notificationData['totalNotificationCount'] = $totalNotificationCount;
        $notificationData['allNotificationsData'] = $allNotificationsData;
        return $notificationData;
    }
}
