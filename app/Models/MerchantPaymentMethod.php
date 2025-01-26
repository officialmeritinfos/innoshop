<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantPaymentMethod extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Relationships
     */

    // A merchant payment method belongs to a merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // A merchant payment method belongs to a payment method
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
