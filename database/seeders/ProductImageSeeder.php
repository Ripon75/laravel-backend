<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productImages = [
            [
                'product_id' => 1,
                'img_src'    => 'images/products/product-1.jpg',
                'is_active'  => 1
            ],
            [
                'product_id' => 1,
                'img_src'    => 'images/products/product-2.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 1,
                'img_src'    => 'images/products/product-3.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 1,
                'img_src'    => 'images/products/product-4.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 2,
                'img_src'    => 'images/products/product-1.jpg',
                'is_active'  => 1
            ],
            [
                'product_id' => 2,
                'img_src'    => 'images/products/product-2.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 2,
                'img_src'    => 'images/products/product-3.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 2,
                'img_src'    => 'images/products/product-4.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 3,
                'img_src'    => 'images/products/product-1.jpg',
                'is_active'  => 1
            ],
            [
                'product_id' => 3,
                'img_src'    => 'images/products/product-2.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 3,
                'img_src'    => 'images/products/product-3.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 3,
                'img_src'    => 'images/products/product-4.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 4,
                'img_src'    => 'images/products/product-1.jpg',
                'is_active'  => 1
            ],
            [
                'product_id' => 4,
                'img_src'    => 'images/products/product-2.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 4,
                'img_src'    => 'images/products/product-3.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 4,
                'img_src'    => 'images/products/product-4.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 5,
                'img_src'    => 'images/products/product-1.jpg',
                'is_active'  => 1
            ],
            [
                'product_id' => 5,
                'img_src'    => 'images/products/product-2.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 5,
                'img_src'    => 'images/products/product-3.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 5,
                'img_src'    => 'images/products/product-4.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 6,
                'img_src'    => 'images/products/product-1.jpg',
                'is_active'  => 1
            ],
            [
                'product_id' => 6,
                'img_src'    => 'images/products/product-2.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 6,
                'img_src'    => 'images/products/product-3.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 6,
                'img_src'    => 'images/products/product-4.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 7,
                'img_src'    => 'images/products/product-1.jpg',
                'is_active'  => 1
            ],
            [
                'product_id' => 7,
                'img_src'    => 'images/products/product-2.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 7,
                'img_src'    => 'images/products/product-3.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 7,
                'img_src'    => 'images/products/product-4.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 8,
                'img_src'    => 'images/products/product-1.jpg',
                'is_active'  => 1
            ],
            [
                'product_id' => 8,
                'img_src'    => 'images/products/product-2.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 8,
                'img_src'    => 'images/products/product-3.jpg',
                'is_active'  => 0
            ],
            [
                'product_id' => 8,
                'img_src'    => 'images/products/product-4.jpg',
                'is_active'  => 0
            ],
        ];

        DB::table('product_images')->insert($productImages);
    }
}
