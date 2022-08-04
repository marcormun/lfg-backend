<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_party')->insert([
            [
                'user_id' => 1,
                'party_id' => 1
            ],[
                'user_id' => 11,
                'party_id' => 1
            ]
        ]);
    }
}
