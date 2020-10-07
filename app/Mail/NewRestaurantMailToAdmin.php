<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewRestaurantMailToAdmin extends Mailable
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
        return $this->view('mails.restaurant-register-to-admin')->with([
            'first_name' => $this->data->first_name,
            'last_name' => $this->data->last_name,
            'email' => $this->data->email,
            'email_billing' => $this->data->email_billing,
            'phone' => $this->data->phone,
            'phone_billing' => $this->data->phone_billing,
            'number_of_employees' => $this->data->number_of_employees,
            'VAT_number' => $this->data->VAT_number,
            'street_and_house_number' => $this->data->street_and_house_number,
            'province' => $this->data->province,
        ]);
    }
}
