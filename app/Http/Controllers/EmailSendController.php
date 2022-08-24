<?php

namespace App\Http\Controllers;

use App\Models\General;
use App\Mail\OrderAdvice;
use App\Models\NotifyEmail;
use App\Mail\OrderReceive;
use App\Models\Order;

class EmailSendController extends Controller
{
    /**
     * Email configurations
     * @var         array
     */
    private array $config = ['email' => '', 'name' => ''];

    /**
     * Email always send notification order
     * @var         string
     */
    private string $email = '';

    /**
     * Creates configuration array
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          void
     */
    public function __construct()
    {
        $general = General::find(1);
        $this->config['name'] = $general->brand;
        $this->config['email'] = $general->prefer_email;
        $this->email = $general->prefer_email;
    }

    /**
     * Sends an email to the customer with his order data
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           int $order_id
     * @param           string $customer_email
     * @return          void
     */
    public function orderDetailEmail(int $order_id, string $customer_email, string $subject)
    {
        $mailer = app()->makeWith('custom.mailer', $this->config);
        $mailer->to($customer_email)->send(new OrderReceive($order_id, $subject));
    }

    /**
     * Warning system administrator of new order
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          void
     */
    public function orderAdminAdvice()
    {
        $mailer = app()->makeWith('custom.mailer', $this->config);
        $mail = $mailer->to($this->email);
        $m = NotifyEmail::all();
        foreach($m as $email)
            $mail = $mailer->cc($email);

        $mail->send(new OrderAdvice('Novo pedido - Biosono'));
    }
}
