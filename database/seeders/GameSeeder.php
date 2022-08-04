<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            [
                'title' => 'League of Legends',
                'thumbnail_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/LoL_icon.svg/1200px-LoL_icon.svg.png',
                'url' => 'https://www.leagueoflegends.com/es-es/'
            ],[
                'title' => 'Valorant',
                'thumbnail_url' => 'https://img.icons8.com/ios/500/valorant.png',
                'url' => 'https://playvalorant.com/es-es/'
            ],[
                'title' => 'Osu',
                'thumbnail_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1e/Osu%21_Logo_2016.svg/512px-Osu%21_Logo_2016.svg.png',
                'url' => 'https://osu.ppy.sh/home'
            ]
        ]);
    }
}
