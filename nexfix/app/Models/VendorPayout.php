<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPayout extends Model
{
    protected $fillable = [
        'booking_id',
        'vendor_id',
        'total_amount',
        'commission_amount',
        'vendor_earning',
        'status',
        'paid_at',
    ];

    // Relationships
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
