<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creating all payment methods exists
        PaymentMethod::create([
            'name' => 'Cartão Visa',
            'icon' => 'images/paymentmethods/visa.webp',
            'installments' => 10
        ]);

        PaymentMethod::create([
            'name' => 'Cartão Mastercard',
            'icon' => 'images/paymentmethods/master.webp',
            'installments' => 10
        ]);

        PaymentMethod::create([
            'name' => 'Boleto',
            'icon' => 'images/paymentmethods/boleto.webp',
            'installments' => 1
        ]);

        PaymentMethod::create([
            'name' => 'PIX',
            'icon' => 'images/paymentmethods/pix.webp',
            'installments' => 1
        ]);
    }
}
