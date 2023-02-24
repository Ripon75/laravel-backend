<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo_src'
    ];

    protected $casts = [
        'name'       => 'string',
        'slug'       => 'string',
        'logo_src'   => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];
}
