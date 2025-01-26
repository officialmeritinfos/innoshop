<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
        'attributes' => 'array',
    ];

    // Relationship: A product belongs to a category
    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    // Relationship: A product can belong to many cart items
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relationship: A product can belong to many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
