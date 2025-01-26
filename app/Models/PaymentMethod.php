<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Relationships
     */

    // A payment method can have many crypto wallets
    public function cryptoWallets()
    {
        return $this->hasMany(CryptoWallet::class);
    }

    // A payment method can have many merchant payment methods
    public function merchantPaymentMethods()
    {
        return $this->hasMany(MerchantPaymentMethod::class);
    }

    // A payment method can have many gift card uploads
    public function giftCardUploads()
    {
        return $this->hasMany(GiftCardUpload::class);
    }

    // A payment method can have many cash transfers
    public function cashTransfers()
    {
        return $this->hasMany(CashTransfer::class);
    }
}
