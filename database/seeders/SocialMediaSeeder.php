<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocialMedia;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creates all social media available at package
        SocialMedia::create([
            'name' => 'Facebook',
            'icon' => 'images/socialmedia/facebook.png'
        ]);

        SocialMedia::create([
            'name' => 'Instagram',
            'icon' => 'images/socialmedia/instagram.png'
        ]);

        SocialMedia::create([
            'name' => 'Linkedin',
            'icon' => 'images/socialmedia/linkedin.png'
        ]);

        SocialMedia::create([
            'name' => 'Github',
            'icon' => 'images/socialmedia/github.png'
        ]);

        SocialMedia::create([
            'name' => 'Twitter',
            'icon' => 'images/socialmedia/twitter.png'
        ]);

        SocialMedia::create([
            'name' => 'Vimeo',
            'icon' => 'images/socialmedia/vimeo.png'
        ]);

        SocialMedia::create([
            'name' => 'Youtube',
            'icon' => 'images/socialmedia/youtube.png'
        ]);
    }
}
