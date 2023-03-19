<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            ProductColorSeeder::class,
            ProductImageSeeder::class,
            ProductSizeSeeder::class,
            AreaSeeder::class,
            AddressSeeder::class,
            StatusSeeder::class,
            PaymentGatewaySeeder::class,
        ]);
    }
}
