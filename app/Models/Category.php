<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'img_src',
        'description'
    ];

    protected $casts = [
        'name'        => 'string',
        'slug'        => 'string',
        'img_src'     => 'string',
        'description' => 'string',
        'created_at'  => 'timestamp',
        'updated_at'  => 'timestamp'
    ];
}
