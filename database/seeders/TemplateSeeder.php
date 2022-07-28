<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t = new Template();
        $t->create([
            'primarybg' => '3D8DCB',
            'primarycolor' => '000000',
            'secondarybg' => 'C9E8FF',
            'secondarycolor' => '000000',
            'highlightbg' => 'B39C7B',
            'highlightcolor' => '000000',
        ]);
    }
}
