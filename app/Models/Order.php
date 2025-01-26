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
}
