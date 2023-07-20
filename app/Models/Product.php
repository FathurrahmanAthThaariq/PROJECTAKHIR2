<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image',
        'category_id',
    ];

    /**
     * The cart that belong to the product.
     */
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    /**
     * The order that belong to the product.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * Get the category that owns the product.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
