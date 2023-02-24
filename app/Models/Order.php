<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'pg_id',
        'current_status_id',
        'current_status_at',
        'delivery_charge',
        'is_paid',
        'paid_at'
    ];

    protected $casts = [
        'user_id'           => 'integer',
        'address_id'        => 'integer',
        'pg_id'             => 'integer',
        'current_status_id' => 'integer',
        'current_status_at' => 'timestamp',
        'delivery_charge'   => 'decimal:2',
        'is_paid'           => 'boolean',
        'paid_at'           => 'timestamp',
        'created_at'        => 'timestamp',
        'updated_at'        => 'timestamp'
    ];
}
