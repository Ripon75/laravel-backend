<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'area_id',
        'title',
        'name',
        'phone_number',
        'line_one',
        'line_two',
        'post_code',
    ];

    protected $casts = [
        'user_id'      => 'integer',
        'area_id'      => 'integer',
        'title'        => 'string',
        'name'         => 'string',
        'phone_number' => 'string',
        'line_one'     => 'string',
        'line_two'     => 'string',
        'post_code'    => 'string',
        'created_at'   => 'timestamp',
        'updated_at'   => 'timestamp',
    ];
}
