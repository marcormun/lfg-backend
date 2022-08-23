<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            [
                'message' => 'Hola que tal',
                'user_id' => 1,
                'party_id' => 1,
                'date' => '2020-01-01'
            ],[
                'message' => 'Bien y tu?',
                'user_id' => 11,
                'party_id' => 1,
                'date' => '2020-01-02'
            ],[
                'message' => 'Bien',
                'user_id' => 1,
                'party_id' => 1,
                'date' => '2020-01-02'
            ]
        ]);    
    }
}
