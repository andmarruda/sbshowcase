<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\General;

class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        General::create([
            'brand' => 'Biosono',
            'brand_image' => 'images/logo.png',
            'slogan' => 'Biosono colchões, seus melhores momentos na sua melhora hora!',
            'section' => 'Ecommerce',
            'google_analytics' => '',
            'google_optimize_script' => '',
            'highlight_img_1' => 'images/icon-entrega.png',
            'highlight_text_1' => 'Entregamos antes da hora de dormir!',
            'highlight_img_2' => 'images/icon-suporte.png',
            'highlight_text_2' => 'Atendimento de qualidade!',
        ]);
    }
}
