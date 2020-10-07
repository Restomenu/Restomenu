<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;

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
        // return view(
        //     'mails.restaurant-register-to-admin',
        //     $data
        // );
    }

    public function testMail()
    {
        return View('mails.restaurant_activation_en', ['verificationUrl' => 'this is url', 'name' => 'name first']);
        // Mail::to("")->send(new TestMail());

        return "Check you inbox";
    }
}
