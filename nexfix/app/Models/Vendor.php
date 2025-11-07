<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_name',
        'bio',
        'rating',
        'verified',
        'available',
        'documents',
    ];

    /**
     * Relationships
     */

    // Each vendor belongs to one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Vendor offers many services through the vendor_services table
    public function vendorServices()
    {
        return $this->hasMany(VendorService::class);
    }

    // Vendor has many reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Vendor has many subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // Vendor has many bookings through vendor_services
    public function bookings()
    {
        return $this->hasManyThrough(Booking::class, VendorService::class);
    }
}
