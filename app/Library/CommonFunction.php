<?php

namespace App\Library;

use App\Http\Controllers\Controller;
use App\Repositories\RestaurantRepository;
use Illuminate\Support\Facades\Storage;

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

    public static function generateMenuQrCode($restaurantSlug, $restaurantId)
    {
        $qrCodeUploadFolder = RestaurantRepository::getQrCodePath($restaurantId);
        $qrCodeExt = config('restomenu.constants.menu_qr_image_ext');
        $qrCodeName = $restaurantSlug . '_' . time() . '.' . $qrCodeExt;
        $qrCodeUploadPath = $qrCodeUploadFolder . $qrCodeName;

        $qrCodeSize = config('restomenu.constants.menu_qr_image_size');
        $restaurantMenuUrl = config('restomenu.urls.restaurant_menu_base_url') . $restaurantSlug;
        $restaurantMenuMargin = config('restomenu.constants.menu_qr_image_margin');
        $qrCode = \QrCode::format($qrCodeExt)->margin($restaurantMenuMargin)->size($qrCodeSize)->generate($restaurantMenuUrl);

        Storage::put($qrCodeUploadPath, $qrCode);
        return $qrCodeName;
    }

    public static function generateSlug($slugStr, $model)
    {
        $slug = str_slug($slugStr);
        $slugCount = count($model->whereRaw("slug REGEXP '^{$slug}(-[0-9]+)?$' ")->get());
        return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
    }
}
