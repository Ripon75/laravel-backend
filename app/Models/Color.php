<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug'
    ];

    protected $casts = [
        'name'       => 'string',
        'slug'       => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];
}