<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCardUpload extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Relationships
     */

    // A gift card upload belongs to a payment method
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    // A gift card upload belongs to a merchant
    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    // A gift card upload belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mutators
     */
    public function getUploadedImagesAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setUploadedImagesAttribute($value)
    {
        $this->attributes['uploaded_images'] = json_encode($value);
    }
}
