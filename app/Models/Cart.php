<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id'
    ];

    protected $casts = [
        'user_id'    => 'integer',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];
}
