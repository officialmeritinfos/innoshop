<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'notes' => 'array',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    // Relationship: An order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship: An order has many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items')
            ->withPivot('price', 'discount_price', 'quantity', 'tax', 'attributes');
    }

    /**
     * Relationship with Delivery.
     * An order can have one delivery.
     */
    public function delivery()
    {
        return $this->hasOne(Delivery::class);
    }

}
