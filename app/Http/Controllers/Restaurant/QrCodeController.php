<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\RestaurantRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class QrCodeController extends Controller
{
    public function __construct(Setting $model, RestaurantRepository $restaurantRepository)
    {
        $this->moduleName = "Qr Code";
        $this->moduleRoute = url('qr-code');
        $this->moduleView = "restaurant-new.main.qr_code";
        $this->model = $model;
        $this->restaurantRepository = $restaurantRepository;

        View::share('module_name', $this->moduleName);
        View::share('module_route', $this->moduleRoute);
        View::share('moduleView', $this->moduleView);
    }

    public function index()
    {
        return view("$this->moduleView.index");
    }

    public function download()
    {
        // $restaurant = auth()->guard('restaurant')->user();

        // $qrCodePath = config("restomenu.path.storage_restaurant_images_root_dir") . "restaurant_" . $restaurant->id . '/' . config("restomenu.path.storage_qr_code") . $restaurant->setting->qr_code_menu;

        // return Storage::download($qrCodePath);

        $fileName = auth()->guard('restaurant')->user()->setting->site_name . '.pdf';
        $pdf = $this->generatePDF();
        $pdf->Output($fileName, 'D');
    }

    public function print()
    {

        //         $restaurant = auth()->guard('restaurant')->user();


        //         $qrCodePath = config("restomenu.path.storage_restaurant_images_root_dir") . "restaurant_" . $restaurant->id . '/' . config("restomenu.path.storage_qr_code") . $restaurant->setting->qr_code_menu;

        // dd($qrCodePath)
        // return view("$this->moduleView.print");
        // $fileName = 'qrcode.pdf';
        // $mpdf = new \Mpdf\Mpdf([
        //     // 'mode' => 'utf-8',
        //     // 'format' => [200,400],
        //     // 'orientation'=>'L'
        // ]);
        // $mpdf = new \Mpdf\Mpdf([
        //     // 'format' => 'A4',
        //     'mode' => 'utf-8',
        //     'format' => [110,197],
        //     'margin_left' => 0,
        //     'margin_right' => 0,
        //     'margin_top' => 0,
        //     'margin_bottom' => 0,
        //     'margin_header' => 0,
        //     'margin_footer' => 0,
        //     'autoArabic' => true,


        // ]);
        // $path = "$this->moduleView.print";
        // $viewPath = str_replace('.', '/', $path);
        // // dd($viewPath);
        // // $html = View::make("$this->moduleView.print")->render();;
        // $html = View::make($path)->render();

        // $stylesheet = '';
        // $stylesheet .= file_get_contents(public_path('/restaurant-new/css/qr_banner.css'));
        // $mpdf->use_kwt = true;
        // $mpdf->AddPage();
        // $mpdf->SetDisplayMode('fullwidth');
        // $mpdf->WriteHTML($stylesheet, 1);
        // $mpdf->WriteHTML($html);
        // $mpdf->Output($fileName, 'I');

        // return $mpdf->download('event_qrcode.pdf');

        $fileName = auth()->guard('restaurant')->user()->setting->site_name . '.pdf';
        $pdf = $this->generatePDF();
        $pdf->Output($fileName, 'I');
    }

    public function generatePDF()
    {
        $mpdf = new \Mpdf\Mpdf([
            // 'mode' => 'utf-8',
            // 'format' => [200,400],
            // 'orientation'=>'L'
        ]);
        $mpdf = new \Mpdf\Mpdf([
            // 'format' => 'A4',
            'mode' => 'utf-8',
            'format' => [90, 160],
            // 'format' => [110, 197],
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
            'autoArabic' => true,


        ]);
        $path = "$this->moduleView.print";
        $viewPath = str_replace('.', '/', $path);
        // dd($viewPath);
        // $html = View::make("$this->moduleView.print")->render();;
        $html = View::make($path)->render();

        $stylesheet = '';
        $stylesheet .= file_get_contents(public_path('/restaurant-new/css/qr_banner.css'));
        $mpdf->use_kwt = true;
        $mpdf->AddPage();
        $mpdf->SetDisplayMode('fullwidth');
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($html);

        return $mpdf;
    }
}