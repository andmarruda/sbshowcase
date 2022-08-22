<?php

namespace App\Http\Controllers;

use App\Mail\OrderReceive;
use App\Models\Order;

class EmailSendController extends Controller
{
    /**
     * Email configurations
     * @var         array
     */
    private array $config = ['email' => 'contato@biosonocolchoes.com.br', 'name' => 'Biosono Colchões'];

    /**
     * Sends an email to the customer with his order data
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $order_id
     * @param           string $customer_email
     * @return          void
     */
    public function orderDetailEmail(int $order_id, string $customer_email)
    {
        $mailer = app()->makeWith('custom.mailer', $this->config);
        $mailer->to($customer_email)->send(new OrderReceive($order_id));
    }
}
