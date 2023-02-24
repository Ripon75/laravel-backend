<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'customer_visibility',
        'shop_user_visibility',
        'bg_color',
        'text_color'
    ];

    protected $casts = [
        'name'                 => 'string',
        'slug'                 => 'string',
        'customer_visibility'  => 'boolean',
        'shop_user_visibility' => 'boolean',
        'bg_color'             => 'string',
        'text_color'           => 'string',
        'created_at'           => 'timestamp',
        'updated_at'           => 'timestamp'
    ];
}
