<?php

namespace App\Http\Controllers;

use App\Mail\OrderReceive;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

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

    public function teste2()
    {
        return view('email.order-receive');
    }
}
