<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //State Json in pt-BR
        $sJs = file_get_contents(base_path('lang/pt/br-state.json'));
        $data = json_decode($sJs, true);
        foreach($data as $state){
            $state = State::create([
                'state_id' => $state['state_id'],
                'state_name' => $state['state_name'],
                'state_initials' => $state['state_initials'],
                'country_id' => $state['country_id']
            ]);
        }
    }
}
