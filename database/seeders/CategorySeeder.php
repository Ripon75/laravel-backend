<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name'    => "Men's dresses",
                'slug'    => Str::slug("Mens dresses", '-'),
                'img_src' => 'images/categories/cat-1.jpg'
            ],
            [
                'name'    => "Women's dresses",
                'slug'    => Str::slug("Women's dresses", '-'),
                'img_src' => 'images/categories/cat-2.jpg'
            ],
            [
                'name'    => "Baby's dresses",
                'slug'    => Str::slug("Baby's dresses", '-'),
                'img_src' => 'images/categories/cat-3.jpg'
            ],
            [
                'name'    => "Accerssories",
                'slug'    => Str::slug("Accerssories", '-'),
                'img_src' => 'images/categories/cat-4.jpg'
            ],
            [
                'name'    => "Bags",
                'slug'    => Str::slug("Bags", '-'),
                'img_src' => 'images/categories/cat-5.jpg'
            ],
            [
                'name'    => "Shoes",
                'slug'    => Str::slug("Shoes", '-'),
                'img_src' => 'images/categories/cat-6.jpg'
            ]
        ];

        DB::table('categories')->insert($categories);
    }
}
