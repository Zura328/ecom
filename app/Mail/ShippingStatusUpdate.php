<?php

namespace App\Mail;

use App\Models\Shipping;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShippingStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    public $delivery;

    public function __construct(Shipping $delivery)
    {
        $this->delivery = $delivery;
    }

    public function build()
    {
        return $this->view('emails.shipping-status-update')
            ->subject('Shipping Status Update');
    }
}
