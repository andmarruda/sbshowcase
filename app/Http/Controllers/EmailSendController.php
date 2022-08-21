<?php

namespace App\Http\Controllers;

use App\Mail\OrderReceive;
use App\Models\Order;
use App\Models\OrderAddress;

class EmailSendController extends Controller
{
    /**
     * Email configurations
     * @var         array
     */
    private array $config = ['email' => 'contato@biosonocolchoes.com.br', 'name' => 'Biosono Colchões'];

    /**
     * Sends an email
     * @version         1.0.0
     * @author          Anderson Arruda < andmarruda@gmail.com >
     * @param           
     * @return          
     */
    public function teste()
    {
        $mailer = app()->makeWith('custom.mailer', $this->config);
        $mailer->to('test-0jilqufrm@srv1.mail-tester.com')->send(new OrderReceive());
    }

    public function teste2(?int $id=NULL)
    {
        $order = is_null($id) ? NULL : Order::find($id);
        return view('email.order-receive', ['Order' => $order, 'OrderAddress' => $order->address()->first(), 'Products' => $order->products()->get()]);
    }
}
