<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
 

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
            'name'         => 'Ripon Ahmed',
            'phone_number' => '01764997485',
            'email'        => 'riponahmed@gmail.com',
            'password'     => Hash::make(123456789),
        ]);
    }
}
