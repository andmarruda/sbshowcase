<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Country Json in pt-BR
        $cJs = file_get_contents(base_path('lang/pt/country.json'));
        $data = json_decode($cJs, true);
        foreach($data as $country){
            Country::create([
                'country_id' => $country['country_id'],
                'country_name' => $country['country_name']
            ]);
        }
    }
}
