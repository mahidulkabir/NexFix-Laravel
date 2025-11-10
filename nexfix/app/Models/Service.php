<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'details',
        'service_category_id',
        'base_price',
        'image',
        'active',
    ];

    // One service belongs to one category
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    // One service can be offered by many vendors (through pivot)
    public function vendorServices()
    {
        return $this->hasMany(VendorService::class);
    }

    // Shortcut many-to-many access
    public function vendors()
    {
        return $this->belongsToMany(Vendor::class, 'vendor_services')
                    ->withPivot('price', 'available') // if your pivot has extra fields
                    ->withTimestamps();
    }
}
