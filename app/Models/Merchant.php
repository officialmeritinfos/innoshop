<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relationships
     */

    // A merchant can have many payment methods via a pivot table
    public function paymentMethods()
    {
        return $this->belongsToMany(PaymentMethod::class, 'merchant_payment_methods');
    }

    // A merchant can have many gift card uploads
    public function giftCardUploads()
    {
        return $this->hasMany(GiftCardUpload::class);
    }
}
