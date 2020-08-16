<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function forgotPasswordMail()
    {
        return view(
            'mails.restaurant-forget-password',
            ['token' => "token"]
        );
    }

    public function restaurantRegisterMail()
    {
        $data = [
            "data" => ["name" => "Darry mertens"]
        ];
        return view(
            'mails.restaurant-register',
            $data
        );
    }
}
