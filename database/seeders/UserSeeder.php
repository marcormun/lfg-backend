<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Marc',
                'username' => 'marcushion',
                'steamUsername' => 'marcushion',
                'email' => 'marc@gmail.com',
                'password' => 'root',
            ],[
                'name' => 'Alvaro',
                'username' => 'mifinuga',
                'steamUsername' => 'mifinuga',
                'email' => 'alvaro@gmail.com',
                'password' => 'root',
            ]
        ]);
    }
}