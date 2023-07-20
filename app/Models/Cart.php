<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($cart) {
            $cart->user_id = auth()->id();
        });
    }

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    /**
     * The product that belong to the cart.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * The user that belong to the cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
