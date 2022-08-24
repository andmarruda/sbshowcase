<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\OrderController;

class OrderReceive extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Informations for the view
     * @var         array
     */
    public array $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(int $order_id, string $subject)
    {
        $oc = new OrderController();
        $this->data = $oc->getOrderDetails($order_id);
        $this->subject($subject);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.order-receive');
    }
}
