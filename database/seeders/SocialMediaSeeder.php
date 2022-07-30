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
            'icon' => 'images/socialmedia/facebook.webp'
        ]);

        SocialMedia::create([
            'name' => 'Instagram',
            'icon' => 'images/socialmedia/instagram.webp'
        ]);

        SocialMedia::create([
            'name' => 'Linkedin',
            'icon' => 'images/socialmedia/linkedin.webp'
        ]);

        SocialMedia::create([
            'name' => 'Github',
            'icon' => 'images/socialmedia/github.webp'
        ]);

        SocialMedia::create([
            'name' => 'Twitter',
            'icon' => 'images/socialmedia/twitter.webp'
        ]);

        SocialMedia::create([
            'name' => 'Vimeo',
            'icon' => 'images/socialmedia/vimeo.webp'
        ]);

        SocialMedia::create([
            'name' => 'Youtube',
            'icon' => 'images/socialmedia/youtube.webp'
        ]);
    }
}
