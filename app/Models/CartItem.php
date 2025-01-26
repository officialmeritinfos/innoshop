<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship: A cart item belongs to a cart
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    // Relationship: A cart item belongs to a product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

