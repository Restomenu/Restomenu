<?php

namespace App\Library;

use App\Http\Controllers\Controller;

class CommonFunction extends Controller
{
    public static function formatPhoneNumber($phone)
    {
        $phoneNumberPrefix = '32';
        $firstPhoneCharacter = substr($phone, 0, 1);

        if ((int) $firstPhoneCharacter === 0) {
            return $phoneNumberPrefix . substr($phone, 1);
        }
        return  $phoneNumberPrefix . $phone;
    }
}
