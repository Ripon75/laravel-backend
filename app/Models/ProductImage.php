<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'img_src'
    ];

    protected $casts = [
        'product_id' => 'integer',
        'img_src'    => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function getImgSrcAttribute($value){
        $baseURL = config('app.url');
        $imgURL = $baseURL.'/'.$value;
        return $imgURL;
    }
}
