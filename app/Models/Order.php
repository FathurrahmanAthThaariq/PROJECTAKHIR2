<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($order) {
            $order->user_id = auth()->id();
        });
    }

    protected $fillable = [
        'user_id',
        'code',
        'total',
        'status',
        'payment_method',
        'payment_status',
    ];

    /**
     * The user that belong to the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The order item that belong to the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
