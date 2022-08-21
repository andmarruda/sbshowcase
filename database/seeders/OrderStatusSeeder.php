<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creating all order statuses
        OrderStatus::create([
            'name' => 'Pendente',
            'hex_color' => '#ffc107'
        ]);

        OrderStatus::create([
            'name' => 'Confirmado',
            'hex_color' => '#17a2b8'
        ]);

        OrderStatus::create([
            'name' => 'Em rota de entrega',
            'hex_color' => '#3b54e3'
        ]);

        OrderStatus::create([
            'name' => 'Entregue',
            'hex_color' => '#28a745'
        ]);

        OrderStatus::create([
            'name' => 'Cancelado',
            'hex_color' => '#dc3545'
        ]);
    }
}
