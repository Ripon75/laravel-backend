<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'price',
        'promo_price',
        'current_purchase_price',
        'avg_purchase_price',
        'current_stock',
        'category_id',
        'brand_id',
        'size',
        'color',
        'img_src',
        'description'
    ];

    protected $casts = [
        'name'                   => 'string',
        'slug'                   => 'string',
        'status'                 => 'string',
        'price'                  => 'decimal:2',
        'promo_price'            => 'decimal:2',
        'current_purchase_price' => 'decimal:2',
        'avg_purchase_price'     => 'decimal:2',
        'current_stock'          => 'integer',
        'category_id'            => 'integer',
        'brand_id'               => 'integer',
        'size'                   => 'string',
        'color'                  => 'string',
        'img_src'                => 'string',
        'description'            => 'string',
        'created_at'             => 'timestamp',
        'updated_at'             => 'timestamp'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getImgSrcAttribute($value){
        $baseURL = config('app.url');
        $imgURL = $baseURL.'/'.$value;
        return $imgURL;
    }
}
