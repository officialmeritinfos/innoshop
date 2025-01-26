<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashTransfer extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Relationships
     */

    // A cash transfer belongs to a payment method
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    // A cash transfer belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
