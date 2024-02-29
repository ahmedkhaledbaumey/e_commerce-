<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'requiredDate',
        'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            // Set requiredDate to created_at + 3 days if not provided
            $order->requiredDate = $order->requiredDate ?? now()->addDays(3);
        });
    }
}
