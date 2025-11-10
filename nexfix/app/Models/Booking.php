<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'vendor_service_id',
        'booking_date',
        'scheduled_at',
        'address',
        'total_amount',
        'payment_method',
        'payment_status',
        'status_user',       
        'status_vendor',     
        'notes',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function vendorService()
    {
        return $this->belongsTo(VendorService::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
