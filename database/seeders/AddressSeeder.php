<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            'user_id'      => 1,
            'area_id'      => 1,
            'title'        => "Home",
            'phone_number' => "+8801764997485",
            'title'        => "Home",
            'address'      => "Malibagh Dhake"
        ]);
    }
}
