<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ImagesSize;

class ImagesSizeSeeder extends Seeder
{
    /**
     * Private image size datase
     * @var    array
     */
    private array $dataset = [
        ['min-width' => 0, 'max-width' => 320, 'description' => 'Many smartphones'],
        ['min-width' => 321, 'max-width' => 768, 'description' => 'Ipads, netbooks, tablets'],
        ['min-width' => 769, 'max-width' => 1024, 'description' => 'some laptops and desktops'],
        ['min-width' => 1025, 'max-width' => 1280, 'description' => 'Common 12 inch resolution'],
        ['min-width' => 1281, 'max-width' => 1366, 'description' => 'Some laptops and desktops'],
        ['min-width' => 1367, 'max-width' => 1440, 'description' => 'Common in larger laptops'],
        ['min-width' => 1441, 'max-width' => 1600, 'description' => 'some devices'],
        ['min-width' => 1601, 'max-width' => 1680, 'description' => 'some devices'],
        ['min-width' => 1681, 'max-width' => 1920, 'description' => 'some devices']
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->dataset as $sizes){
            ImagesSize::create([
                'min_width' => $sizes['min-width'],
                'max_width' => $sizes['max-width'],
                'description' => $sizes['description']
            ]);
        }
    }
}
