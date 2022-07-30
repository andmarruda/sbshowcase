<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //City Json in pt-BR
        $cJs = file_get_contents(base_path('lang/pt/br-city.json'));
        $data = json_decode($cJs, true);
        foreach($data as $city){
            $city = City::create([
                'city_id' => $city['city_id'],
                'city_name' => $city['city_name'],
                'state_id' => $city['state_id']
            ]);
        }
    }
}
