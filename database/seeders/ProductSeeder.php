<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'name'                   => "Colorful Stylish Shirt",
                'slug'                   => Str::slug("Colorful Stylish Shirt", '-'),
                'status'                 => 'active',
                'price'                  => 500,
                'promo_price'            => 450,
                'current_purchase_price' => 400,
                'avg_purchase_price'     => 400,
                'current_stock'          => 100,
                'category_id'            => 1,
                'brand_id'               => null,
                'img_src'                => 'images/products/product-1.jpg'
            ],
            [
                'name'                   => "Colorful Zins Shirt",
                'slug'                   => Str::slug("Colorful Zins Shirt", '-'),
                'status'                 => 'active',
                'price'                  => 500,
                'promo_price'            => 450,
                'current_purchase_price' => 400,
                'avg_purchase_price'     => 400,
                'current_stock'          => 100,
                'category_id'            => 1,
                'brand_id'               => null,
                'img_src'                => 'images/products/product-2.jpg'
            ],
            [
                'name'                   => "Colorful Zins Shirt",
                'slug'                   => Str::slug("Colorful Zins Shirt", '-'),
                'status'                 => 'active',
                'price'                  => 500,
                'promo_price'            => 450,
                'current_purchase_price' => 400,
                'avg_purchase_price'     => 400,
                'current_stock'          => 100,
                'category_id'            => 1,
                'brand_id'               => null,
                'img_src'                => 'images/products/product-3.jpg'
            ],
            [
                'name'                   => "Colorful Zins Shirt",
                'slug'                   => Str::slug("Colorful Zins Shirt", '-'),
                'status'                 => 'active',
                'price'                  => 500,
                'promo_price'            => 450,
                'current_purchase_price' => 400,
                'avg_purchase_price'     => 400,
                'current_stock'          => 100,
                'category_id'            => 1,
                'brand_id'               => null,
                'img_src'                => 'images/products/product-4.jpg'
            ],
            [
                'name'                   => "Colorful Stylish Shirt",
                'slug'                   => Str::slug("Colorful Stylish Shirt", '-'),
                'status'                 => 'active',
                'price'                  => 500,
                'promo_price'            => 450,
                'current_purchase_price' => 400,
                'avg_purchase_price'     => 400,
                'current_stock'          => 100,
                'category_id'            => 1,
                'brand_id'               => null,
                'img_src'                => 'images/products/product-5.jpg'
            ],
            [
                'name'                   => "Colorful Zins Shirt",
                'slug'                   => Str::slug("Colorful Zins Shirt", '-'),
                'status'                 => 'active',
                'price'                  => 500,
                'promo_price'            => 450,
                'current_purchase_price' => 400,
                'avg_purchase_price'     => 400,
                'current_stock'          => 100,
                'category_id'            => 1,
                'brand_id'               => null,
                'img_src'                => 'images/products/product-6.jpg'
            ],
            [
                'name'                   => "Colorful Zins Shirt",
                'slug'                   => Str::slug("Colorful Zins Shirt", '-'),
                'status'                 => 'active',
                'price'                  => 500,
                'promo_price'            => 450,
                'current_purchase_price' => 400,
                'avg_purchase_price'     => 400,
                'current_stock'          => 100,
                'category_id'            => 1,
                'brand_id'               => null,
                'img_src'                => 'images/products/product-7.jpg'
            ],
            [
                'name'                   => "Colorful Zins Shirt",
                'slug'                   => Str::slug("Colorful Zins Shirt", '-'),
                'status'                 => 'active',
                'price'                  => 500,
                'promo_price'            => 450,
                'current_purchase_price' => 400,
                'avg_purchase_price'     => 400,
                'current_stock'          => 100,
                'category_id'            => 1,
                'brand_id'               => null,
                'img_src'                => 'images/products/product-8.jpg'
            ],
        ];

        DB::table('products')->insert($products);
    }
}
