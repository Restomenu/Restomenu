<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{auth()->guard('restaurant')->user()->setting->site_name}}</title>
    <link rel="stylesheet" href="{{ url('restaurant-new/css/qr_banner_2.css') }}" />
</head>

<body>

    <div class="pdf-wrapper" style="padding:1px 0 0 0;">
        <!-- <div class="pdf-wrapper" style="padding:30px 0 0 0; z-index: 1;"> -->

        <table style="margin-top:30px" class="main-table">
            <tr>
                <td>
                    <table width="100%" style="margin: 19px;border-collapse: collapse;">
                        <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" style="margin: 20px;border-collapse: collapse;">
                    <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" style="margin: 20px;border-collapse: collapse;">
                    <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" style="margin: 19px;border-collapse: collapse;">
                        <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" style="margin: 20px;border-collapse: collapse;">
                    <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" style="margin: 20px;border-collapse: collapse;">
                    <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" style="margin: 19px;border-collapse: collapse;">
                        <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" style="margin: 20px;border-collapse: collapse;">
                    <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" style="margin: 20px;border-collapse: collapse;">
                    <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" style="margin: 19px;border-collapse: collapse;">
                        <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" style="margin: 20px;border-collapse: collapse;">
                    <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%" style="margin: 20px;border-collapse: collapse;">
                    <tr class="row-color" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb">
                                SCAN ME</td>
                        </tr>
                        <tr>
                            <td text-rotate="90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCAN MIJ</td>
                            <td style="text-align:center;padding:1px"><img src="{{auth()->guard('restaurant')->user()->setting->qr_code_menu_full_path}}" alt="" style="max-width: 210px;"></td>
                            <td text-rotate="-90" class="lr" style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">SCANNEZ-MOI</td>
                        </tr>
                        <tr style="background-color: {{auth()->guard('restaurant')->user()->setting->menu_primary_color ?? '#CACC2D'}};">
                            <td colspan="3" class="tb scanner">{{config('restomenu.urls.scanner_url')}}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

    </div>

</body>

</html>