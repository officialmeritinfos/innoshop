<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoWallet extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Relationships
     */

    // A crypto wallet belongs to a payment method
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
