<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    protected $table = 'deliveries';
    protected $guarded=[];

    /**
     * Define a one-to-many relationship with DeliveryStage.
     */
    public function stages()
    {
        return $this->hasMany(DeliveryStage::class);
    }

    /**
     * Relationship with User.
     * A delivery belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship with Order.
     * A delivery belongs to an order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
