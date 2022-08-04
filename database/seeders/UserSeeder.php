<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Http\Controllers\UserController;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creating the first user
        $uc = new UserController();
        $uc->createUser('Configuration User', 'firstuser@sysborg.com.br', 'Sbshowcase1');
    }
}
