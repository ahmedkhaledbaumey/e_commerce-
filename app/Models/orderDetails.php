<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', // Add 'order_id' to the fillable array
        'product_id',
        'qyt',
        'price',
    ];
}
