<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'icon_src'
    ];

    protected $casts = [
        'name'       => 'string',
        'slug'       => 'string',
        'status'     => 'string',
        'icon_src'   => 'string',
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];
}
