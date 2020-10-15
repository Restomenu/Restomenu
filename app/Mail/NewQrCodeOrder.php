<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewQrCodeOrder extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.new-qr-code-order-to-admin')->with([
            'restaurant_name' => $this->data->restaurant->setting->site_name,
            'restaurant_email' => $this->data->restaurant->email,
            'quantity' => $this->data->quantity,
            'address' => $this->data->address,
            'postcode' => $this->data->postcode,
            'city' => $this->data->city,
            'country' => $this->data->country,
            'total_cost' => $this->data->total_cost,
            'shipping_cost' => $this->data->shipping_cost,
            'sticker_cost' => $this->data->sticker_cost,
        ]);
    }
}
