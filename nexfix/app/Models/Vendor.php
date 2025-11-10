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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendorServices()
    {
        return $this->hasMany(VendorService::class);
    }

    // Many-to-many (shortcut)
    public function services()
    {
        return $this->belongsToMany(Service::class, 'vendor_services')
                    ->withPivot('price', 'available')
                    ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function bookings()
    {
        return $this->hasManyThrough(Booking::class, VendorService::class);
    }
}
