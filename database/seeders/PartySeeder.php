<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('parties')->insert([
            [
                'name' => 'Sala1',
                'game_id' => 1,
            ],[
                'name' => 'Sala2',
                'game_id' => 1,
            ],[
                'name' => 'Sala3',
                'game_id' => 11,
            ],[
                'name' => 'Sala4',
                'game_id' => 21,
            ]
        ]);
    }
}
